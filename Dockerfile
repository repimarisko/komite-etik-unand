# syntax=docker/dockerfile:1.7

ARG UID=1000
ARG GID=1000

FROM php:8.2-fpm AS base

ARG UID
ARG GID

# Align the www-data user/group with the host to avoid permission issues
RUN groupmod -o -g ${GID} www-data && \
    usermod -o -u ${UID} www-data


# System dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    docker.io \
    zip \
    unzip \
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

# Composer for runtime usage (artisan, installs inside dev containers)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Custom PHP config
COPY docker/php/conf.d/app.ini /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html

# ---------- Composer dependencies ----------
FROM base AS composer-install

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

COPY --from=composer-install /var/www/html /var/www/html
COPY --from=asset-builder /app/public/build /var/www/html/public/build

RUN chown -R www-data:www-data storage bootstrap/cache && \
    find storage bootstrap/cache -type d -exec chmod 775 {} \; && \
    find storage bootstrap/cache -type f -exec chmod 664 {} \;

USER www-data

CMD ["php-fpm"]
