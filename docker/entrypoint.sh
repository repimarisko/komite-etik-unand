#!/usr/bin/env sh
set -e

DB_DATABASE=${DB_DATABASE:-komite_etik_unand}
DB_USERNAME=${DB_USERNAME:-app}
DB_PASSWORD=${DB_PASSWORD:-app}

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

# Start MySQL if it's not already running (kept in the same container)
mkdir -p /run/mysqld
chown -R mysql:mysql /run/mysqld /var/lib/mysql

if [ ! -d /var/lib/mysql/mysql ]; then
    if command -v mysql_install_db >/dev/null 2>&1; then
        mysql_install_db --user=mysql --datadir=/var/lib/mysql
    else
        mysqld --initialize-insecure --user=mysql --datadir=/var/lib/mysql
    fi
fi

mysqld --user=mysql --datadir=/var/lib/mysql --socket=/run/mysqld/mysqld.sock --pid-file=/run/mysqld/mysqld.pid &
MYSQL_PID=$!

until mysqladmin ping --silent; do
    echo "Waiting for MySQL to be ready..."
    sleep 1
done

mysql -uroot <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';
GRANT ALL PRIVILEGES ON \`${DB_DATABASE}\`.* TO '${DB_USERNAME}'@'%';
FLUSH PRIVILEGES;
SQL

php-fpm -D
exec nginx -g "daemon off;"
