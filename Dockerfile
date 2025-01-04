FROM php:8.2-apache

# Instal ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring zip gd

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Set working directory ke folder Laravel
WORKDIR /var/www/html

# Salin semua file ke container
COPY . /var/www/html

# Ubah DocumentRoot ke folder 'public'
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Berikan izin pada folder 'storage' dan 'bootstrap/cache'
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
