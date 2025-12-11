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

mkdir -p /run/php
rm -f /run/php/php-fpm.pid

# Create .env from .env.example if it's missing (useful when not bind-mounting)
if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.example ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Ensure writable runtime directories (important when volumes are empty on first start)
for dir in storage/logs storage/framework/cache storage/framework/data storage/framework/sessions storage/framework/testing storage/framework/views bootstrap/cache; do
    mkdir -p "/var/www/html/${dir}"
done
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Wait for database to be reachable before running migrations
if [ -n "${DB_HOST}" ] && [ -n "${DB_PORT}" ]; then
    echo "Waiting for database at ${DB_HOST}:${DB_PORT}..."
    for i in $(seq 1 30); do
        if mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME:-root}" -p"${DB_PASSWORD:-}" --silent; then
            db_ready=1
            break
        fi
        sleep 2
    done

    if [ -z "${db_ready}" ]; then
        echo "Database is not reachable after waiting, exiting."
        exit 1
    fi
fi

if [ -n "${db_ready}" ] && [ -n "${DB_DATABASE}" ]; then
    echo "Ensuring database ${DB_DATABASE} exists..."
    db_creator_user="${DB_ROOT_USERNAME:-root}"
    db_creator_pass="${DB_ROOT_PASSWORD:-}"
    if [ -z "${db_creator_pass}" ]; then
        db_creator_user="${DB_USERNAME:-${db_creator_user}}"
        db_creator_pass="${DB_PASSWORD:-${db_creator_pass}}"
    fi
    create_db_sql="CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET ${DB_CHARSET:-utf8mb4} COLLATE ${DB_COLLATION:-utf8mb4_unicode_ci};"
    set +e
    mysql_cmd "${db_creator_user}" "${db_creator_pass}" -e "${create_db_sql}"
    create_status=$?
    set -e
    if [ "${create_status}" -ne 0 ]; then
        echo "Warning: Unable to create database automatically. Continuing startup."
    fi
fi

run_migrations=1
if [ -n "${db_ready}" ] && [ -n "${DB_DATABASE}" ] && [ -n "${DB_USERNAME}" ]; then
    set +e
    migration_table_present=$(mysql_cmd "${DB_USERNAME}" "${DB_PASSWORD}" -N -B -s -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${DB_DATABASE}' AND table_name='migrations';")
    migrations_status=$?
    set -e
    migration_table_present=$(printf "%s" "${migration_table_present}" | tr -d '[:space:]')

    if [ "${migrations_status}" -eq 0 ] && [ "${migration_table_present}" = "1" ]; then
        set +e
        executed_migrations=$(mysql_cmd "${DB_USERNAME}" "${DB_PASSWORD}" -D "${DB_DATABASE}" -N -B -s -e "SELECT COUNT(*) FROM migrations;")
        executed_status=$?
        set -e
        executed_migrations=$(printf "%s" "${executed_migrations}" | tr -d '[:space:]')

        if [ "${executed_status}" -eq 0 ]; then
            if [ -d /var/www/html/database/migrations ]; then
                available_migrations=$(find /var/www/html/database/migrations -type f -name '*.php' | wc -l | tr -d '[:space:]')
            else
                available_migrations=0
            fi

            if [ -n "${available_migrations}" ] && [ -n "${executed_migrations}" ] && [ "${executed_migrations}" -ge "${available_migrations}" ]; then
                run_migrations=0
            fi
        fi
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
        echo "Database schema already up to date; skipping automatic migrations."
    fi
fi

php-fpm -D
exec nginx -g "daemon off;"
