# Usa una imagen base oficial de PHP con FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Establece el directorio de trabajo
WORKDIR /var/www

# Instalar dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el código de la aplicación Laravel al contenedor
COPY . /var/www

# Establecer los permisos correctos para Laravel (ajustar si es necesario)
RUN chown -R www-data:www-data /var/www

ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar las dependencias de Laravel
RUN composer install --no-scripts --no-dev --prefer-dist

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 8000

ENV COMPOSER_ALLOW_SUPERUSER=1

# Establecer el comando por defecto para ejecutar el servidor PHP-FPM
CMD ["php-fpm"]
