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

php-fpm -D
exec nginx -g "daemon off;"
