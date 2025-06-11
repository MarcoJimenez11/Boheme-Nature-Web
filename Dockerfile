# Etapa 1: Composer + dependencias
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-scripts

# Etapa 2: PHP + Laravel + Nginx
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    nginx \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip

# Configura directorios
WORKDIR /var/www/html

# Copia el código fuente
COPY . .

# Copia dependencias de Composer
COPY --from=vendor /app/vendor ./vendor

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copia configuración de Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Expone el puerto que Railway espera
EXPOSE 8080

# Start script
CMD service nginx start && php-fpm
