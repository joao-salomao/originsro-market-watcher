### Build Stage
FROM node:12-alpine AS build-front-end-stage

WORKDIR /var/www/html

# Copy all source files
COPY . .

# Install front-end dependencies
RUN npm install

# Build front-end
RUN npm run production

# Remove unecessary files
RUN rm -rf node_modules

#######

FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    zip \
    curl \
    unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-source delete

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy files from build stage
COPY --from=build-front-end-stage /var/www/html /var/www/html

# Copy Apache VHost config file
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Setup .env file
RUN mv .env.example .env

# Move database file
RUN mv .docker/database.sqlite database/database.sqlite

# Install API dependencies
RUN composer install

# Generate Application Key
RUN php artisan key:generate

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
