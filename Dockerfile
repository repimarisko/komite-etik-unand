# syntax=docker/dockerfile:1.7

FROM php:8.2-fpm

ARG UID=1000
ARG GID=1000

# Align the www-data user/group with the host to avoid permission issues
RUN groupmod -o -g ${GID} www-data && \
    usermod -o -u ${UID} www-data

# System dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath \
    && rm -rf /var/lib/apt/lists/*

# Node.js 20.x for running Vite tooling
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && apt-get install -y nodejs && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Custom PHP config
COPY docker/php/conf.d/app.ini /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html

CMD ["php-fpm"]
