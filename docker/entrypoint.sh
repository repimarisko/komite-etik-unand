#!/usr/bin/env sh
set -e

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

# Run pending migrations automatically on container start
if [ -f /var/www/html/artisan ]; then
    php /var/www/html/artisan migrate --force
fi

php-fpm -D
exec nginx -g "daemon off;"
