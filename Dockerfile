FROM php:8.2-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip

# Copia el código
WORKDIR /var/www/html
COPY . .

# Instala Composer y dependencias
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Copia configuración de Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Expone el puerto que Railway espera
EXPOSE 8080

# Inicia ambos procesos
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
