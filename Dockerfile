# syntax=docker/dockerfile:1.7

ARG UID=1000
ARG GID=1000

FROM php:8.2-fpm-bullseye AS base

ARG UID
ARG GID

# Align the container user with the host to avoid permission issues on bind mounts
RUN groupmod -o -g ${GID} www-data && \
    usermod -o -u ${UID} www-data

# System dependencies, PHP extensions, and tools
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    supervisor \
    default-mysql-server \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath \
    && rm -rf /var/lib/apt/lists/*

# Composer for installing dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Custom PHP config
COPY docker/php/conf.d/app.ini /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html

# ---------- Composer dependencies ----------
FROM base AS vendor

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --no-progress --prefer-dist

COPY . .
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --optimize-autoloader

# ---------- Build frontend assets ----------
FROM node:22-alpine AS asset-builder

WORKDIR /app
COPY package*.json ./
RUN npm ci --no-progress

COPY . .
RUN npm run build

# ---------- Final image ----------
FROM base AS production

COPY --from=vendor /var/www/html /var/www/html
COPY --from=asset-builder /app/public/build /var/www/html/public/build

# Replace the default Nginx site with the app config
RUN rm -f /etc/nginx/conf.d/default.conf \
    /etc/nginx/sites-enabled/default \
    /etc/nginx/sites-available/default
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Ensure runtime directories exist with sane permissions
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/data \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/testing \
    /var/www/html/storage/framework/views \
    /var/www/html/bootstrap/cache \
    /run/php && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
CMD ["/entrypoint.sh"]
