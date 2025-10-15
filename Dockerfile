# 🐘 Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# 🔧 Installer les dépendances système et PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    wget \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo_pgsql \
    zip \
    && rm -rf /var/lib/apt/lists/*

# ⚙️ Installer la CLI Symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# 🎵 Installer Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 👑 Autoriser Composer à tourner en root (obligatoire dans Docker)
ENV COMPOSER_ALLOW_SUPERUSER=1

# 📁 Définir le dossier de travail
WORKDIR /var/www/html

# 📦 Copier les fichiers du projet
COPY . .

# 🧩 Installer les dépendances PHP/Symfony
# Le flag --no-scripts évite les erreurs liées à symfony-cmd si Flex n’est pas encore actif
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 🔁 Générer un autoload optimisé
RUN composer dump-autoload --optimize

# ✅ Créer le dossier var/ si absent et appliquer les bons droits
RUN mkdir -p var/cache var/log && chown -R www-data:www-data var

# 🔥 Activer le module rewrite pour Symfony
RUN a2enmod rewrite

# ⚙️ Copier la configuration Apache personnalisée
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# 🌍 Exposer le port HTTP
EXPOSE 80

# 🚀 Commande de démarrage par défaut
CMD ["apache2-foreground"]
