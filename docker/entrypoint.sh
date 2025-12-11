#!/usr/bin/env sh
set -e

# Minimal helper to run mysql commands with optional password.
mysql_cmd() {
    MYSQL_CMD_USER="$1"
    MYSQL_CMD_PASS="$2"
    shift 2
    if [ -n "$MYSQL_CMD_PASS" ]; then
        MYSQL_PWD="$MYSQL_CMD_PASS" mysql -h"${DB_HOST}" -P"${DB_PORT}" -u"${MYSQL_CMD_USER}" "$@"
        unset MYSQL_PWD
    else
        mysql -h"${DB_HOST}" -P"${DB_PORT}" -u"${MYSQL_CMD_USER}" "$@"
    fi
}

# Read a key from the mounted .env file without executing it.
dotenv_get() {
    key="$1"
    if [ ! -f /var/www/html/.env ]; then
        return
    fi
    value=$(grep -E "^${key}=" /var/www/html/.env | tail -n 1 | cut -d '=' -f 2-)
    [ -z "$value" ] && return
    value=${value%$'\r'}
    case "$value" in
        \"*\")
            value=${value#\"}
            value=${value%\"}
            ;;
        \'*\')
            value=${value#\'}
            value=${value%\'}
            ;;
    esac
    printf "%s" "$value"
}

mkdir -p /run/php
rm -f /run/php/php-fpm.pid

# Create .env from .env.example if it's missing (useful when not bind-mounting)
if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.example ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Prefer the mounted .env file for DB credentials so updates are picked up without recreating containers.
if [ -f /var/www/html/.env ]; then
    dotenv_value=$(dotenv_get DB_CONNECTION)
    [ -n "${dotenv_value}" ] && DB_CONNECTION="${dotenv_value}"

    dotenv_value=$(dotenv_get DB_HOST)
    [ -n "${dotenv_value}" ] && DB_HOST="${dotenv_value}"

    dotenv_value=$(dotenv_get DB_PORT)
    [ -n "${dotenv_value}" ] && DB_PORT="${dotenv_value}"

    dotenv_value=$(dotenv_get DB_DATABASE)
    [ -n "${dotenv_value}" ] && DB_DATABASE="${dotenv_value}"

    dotenv_value=$(dotenv_get DB_USERNAME)
    [ -n "${dotenv_value}" ] && DB_USERNAME="${dotenv_value}"

    dotenv_value=$(dotenv_get DB_PASSWORD)
    [ -n "${dotenv_value}" ] && DB_PASSWORD="${dotenv_value}"
fi

# Ensure writable runtime directories (important when volumes are empty on first start)
for dir in storage/logs storage/framework/cache storage/framework/data storage/framework/sessions storage/framework/testing storage/framework/views bootstrap/cache; do
    mkdir -p "/var/www/html/${dir}"
done
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

REQUIRED_DB_HOST="${REQUIRED_DB_HOST:-10.250.30.19}"
REQUIRED_DB_USERNAME="${REQUIRED_DB_USERNAME:-docker}"
REQUIRED_DB_PASSWORD="${REQUIRED_DB_PASSWORD:-us3R@dev.2025}"
DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_PORT="${DB_PORT:-3306}"

auto_db_enabled=0
auto_db_reason="Database schema already up to date; skipping automatic migrations."
if [ "${DB_CONNECTION}" = "mysql" ] && [ -n "${DB_HOST}" ] && [ -n "${DB_PORT}" ] && [ -n "${DB_DATABASE}" ] && [ -n "${DB_USERNAME}" ] && [ -n "${DB_PASSWORD}" ]; then
    if [ "${DB_HOST}" = "${REQUIRED_DB_HOST}" ] && [ "${DB_USERNAME}" = "${REQUIRED_DB_USERNAME}" ] && [ "${DB_PASSWORD}" = "${REQUIRED_DB_PASSWORD}" ]; then
        auto_db_enabled=1
    else
        auto_db_reason="Skipping automatic database tasks because configured DB credentials do not match the required MySQL instance."
        echo "${auto_db_reason}"
    fi
else
    auto_db_reason="Skipping automatic database tasks because MySQL credentials are incomplete or DB_CONNECTION is not mysql."
    echo "${auto_db_reason}"
fi

run_migrations=0
if [ "${auto_db_enabled}" -eq 1 ]; then
    echo "Waiting for database at ${DB_HOST}:${DB_PORT}..."
    for i in $(seq 1 30); do
        if [ -n "${DB_PASSWORD}" ]; then
            MYSQL_PWD="${DB_PASSWORD}" mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" --silent && db_ready=1 || true
            unset MYSQL_PWD
        else
            mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" --silent && db_ready=1 || true
        fi
        if [ -n "${db_ready}" ]; then
            break
        fi
        sleep 2
    done

    if [ -z "${db_ready}" ]; then
        echo "Database is not reachable after waiting, exiting."
        exit 1
    fi

    if [ -n "${DB_DATABASE}" ]; then
        echo "Ensuring database ${DB_DATABASE} exists..."
        create_db_sql="CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET ${DB_CHARSET:-utf8mb4} COLLATE ${DB_COLLATION:-utf8mb4_unicode_ci};"
        set +e
        mysql_cmd "${DB_USERNAME}" "${DB_PASSWORD}" -e "${create_db_sql}"
        create_status=$?
        set -e
        if [ "${create_status}" -ne 0 ]; then
            echo "Warning: Unable to create database automatically. Continuing startup."
        fi
    fi

    migrations_check_failed=0
    pending_migrations=0

    if [ -n "${DB_DATABASE}" ]; then
        set +e
        migration_table_present=$(mysql_cmd "${DB_USERNAME}" "${DB_PASSWORD}" -N -B -s -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${DB_DATABASE}' AND table_name='migrations';")
        migrations_status=$?
        set -e
        migration_table_present=$(printf "%s" "${migration_table_present}" | tr -d '[:space:]\r')

        if [ "${migrations_status}" -ne 0 ]; then
            migrations_check_failed=1
            auto_db_reason="Skipping automatic database tasks because the migrations table metadata could not be inspected (check ${DB_USERNAME} grants)."
        elif [ "${migration_table_present}" != "1" ]; then
            pending_migrations=1
            auto_db_reason="Migrations table missing; running database migrations."
        else
            set +e
            executed_migrations=$(mysql_cmd "${DB_USERNAME}" "${DB_PASSWORD}" -D "${DB_DATABASE}" -N -B -s -e "SELECT migration FROM migrations;")
            executed_status=$?
            set -e
            executed_migrations=$(printf "%s" "${executed_migrations}" | tr -d '\r')

            if [ "${executed_status}" -ne 0 ]; then
                migrations_check_failed=1
                auto_db_reason="Skipping automatic database tasks because existing migrations could not be read (check ${DB_USERNAME} grants)."
            elif [ -z "${executed_migrations}" ]; then
                pending_migrations=1
                auto_db_reason="No recorded migrations found; running database migrations."
            else
                if [ -d /var/www/html/database/migrations ]; then
                    available_migrations=$(find /var/www/html/database/migrations -type f -name '*.php' -printf '%f\n' | sort)
                else
                    available_migrations=""
                fi

                if [ -n "${available_migrations}" ]; then
                    while IFS= read -r migration_file; do
                        [ -z "${migration_file}" ] && continue
                        migration_name=${migration_file%.php}
                        if ! printf '%s\n' "${executed_migrations}" | grep -Fxq "${migration_name}"; then
                            pending_migrations=1
                            auto_db_reason="Pending migrations detected; running database migrations."
                            break
                        fi
                    done <<EOF
${available_migrations}
EOF
                fi
            fi
        fi
    fi

    if [ "${migrations_check_failed}" -eq 0 ] && [ "${pending_migrations}" -eq 1 ]; then
        run_migrations=1
    fi
fi

# Run pending migrations automatically on container start (non-fatal if already applied)
if [ -f /var/www/html/artisan ]; then
    if [ "${run_migrations}" -eq 1 ]; then
        echo "Running database migrations..."
        if ! php /var/www/html/artisan migrate --force --no-interaction; then
            echo "Migrations encountered an error (often because tables already exist). Continuing startup."
        fi
    else
        echo "${auto_db_reason}"
    fi
fi

php-fpm -D
exec nginx -g "daemon off;"
