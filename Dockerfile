FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    supervisor && \
    docker-php-ext-install pdo_mysql zip

# Crear directorio para nginx y php-fpm sockets
RUN mkdir -p /run/php && chown -R www-data:www-data /run/php

# Crear estructura de trabajo
WORKDIR /var/www/html
COPY . .

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permisos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Copiar configuraciones
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exponer el puerto esperado por Railway
EXPOSE 8080

# Comando de arranque
CMD ["/usr/bin/supervisord"]
