# Use an official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    wget \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo_pgsql \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set Composer to allow superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

# Set the working directory
WORKDIR /var/www/html

# Copy the project files
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set the correct permissions
RUN chown -R www-data:www-data var

# Configure Apache
RUN a2enmod rewrite
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80
