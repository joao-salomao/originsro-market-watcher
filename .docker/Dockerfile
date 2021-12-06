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
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-source delete

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy all source files
COPY . .

# Copy Apache VHost config file
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Setup .env file
RUN mv .env.example .env

# Create database file
RUN touch database/database.sqlite

# Install dependencies
RUN composer install

# Install front-end dependencies
RUN npm install

# Migrate database
RUN php artisan migrate --seed

# Generate Application Key
RUN php artisan key:generate

# Build front-end
RUN npm run production

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
