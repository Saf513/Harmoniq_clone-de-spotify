# Utiliser l'image PHP officielle avec Apache
FROM php:7.4-apache

# Installer les dépendances pour PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copier le contenu de ./public dans /var/www/html/ (répertoire d'Apache)
COPY ./public /var/www/html/

# Exposer le port 80 pour pouvoir accéder à l'application via le navigateur
EXPOSE 80
