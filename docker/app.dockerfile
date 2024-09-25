FROM php:8.3-fpm

# Instalar dependencias y extensiones necesarias
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    libzip-dev \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install pdo_sqlite zip

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar el composer.lock y composer.json primero para aprovechar el cache de Docker
COPY composer.lock composer.json ./

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Composer
RUN composer install --no-autoloader --no-scripts

# Copiar el resto de la aplicación
COPY . .

# Crear el archivo SQLite vacío
RUN touch /var/www/database/database.sqlite

# Generar autoload y scripts
RUN composer dump-autoload

# Configurar permisos (ajusta según tus necesidades)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto 9000 (el puerto por defecto de PHP-FPM)
EXPOSE 9000

CMD ["php-fpm"]
