FROM php:8.2-apache

# Production environment
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV COMPOSER_ALLOW_SUPERUSER=1

# Cache-busting for Render builds: tie layers to the git commit
ARG RENDER_GIT_COMMIT
LABEL org.opencontainers.image.revision=$RENDER_GIT_COMMIT

# Install system and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip wget libicu-dev libzip-dev libpq-dev \
    && docker-php-ext-install intl opcache pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# Install Symfony CLI and Composer
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony \
    && wget https://getcomposer.org/download/latest-stable/composer.phar -O /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Workdir
WORKDIR /var/www/html

# Copy project files
COPY . .

# PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Front assets (Symfony ImportMap / Asset Mapper)
RUN php bin/console importmap:install --env=prod --no-interaction
RUN php bin/console asset-map:compile --env=prod

# Prepare writable dirs
RUN mkdir -p var/cache var/log && chown -R www-data:www-data var

# Apache rewrite
RUN a2enmod rewrite

# Apache vhost
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Entry point
RUN chmod +x .docker/entrypoint.sh

EXPOSE 80

# Start command: wait DB, migrate, start Apache
CMD [".docker/entrypoint.sh"]

