# 🐘 Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Set the environment to production
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV COMPOSER_ALLOW_SUPERUSER=1

# 🔧 Installer les dépendances système et PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip wget libicu-dev libzip-dev libpq-dev \
    && docker-php-ext-install intl opcache pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# ⚙️ Installer Symfony CLI et Composer
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony \
    && wget https://getcomposer.org/download/latest-stable/composer.phar -O /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# 📁 Définir le dossier de travail
WORKDIR /var/www/html

# 📦 Copier les fichiers du projet
COPY . .

# 🧩 Installer les dépendances PHP/Symfony
RUN composer install --no-dev --optimize-autoloader

# Run database migrations
RUN php bin/console doctrine:migrations:migrate --no-interaction --env=prod --no-scripts && composer dump-autoload --optimize

# 📦 Installer les assets de l'importmap
RUN php bin/console importmap:install --env=prod --no-interaction

# 📦 Compiler les assets
RUN php bin/console asset-map:compile --env=prod

# 🚀 Appliquer les migrations de base de données
# RUN php bin/console doctrine:migrations:migrate --no-interaction --env=prod # Removed from build

# ✅ Créer le dossier var/ si absent et appliquer les bons droits
RUN mkdir -p var/cache var/log && chown -R www-data:www-data var

# 🔥 Activer le module rewrite pour Symfony
RUN a2enmod rewrite

# ⚙️ Copier la configuration Apache personnalisée
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# 🌍 Exposer le port HTTP
EXPOSE 80

# 🚀 Commande de démarrage
CMD php bin/console doctrine:migrations:migrate --no-interaction --env=prod && apache2-foreground
