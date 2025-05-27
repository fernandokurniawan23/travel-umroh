# # Dockerfile
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
  git curl libpng-dev libonig-dev libxml2-dev zip unzip npm nodejs \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install

# Install JS dependencies & build Vite
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000
CMD ["php-fpm"]
# ======================================================
# Tahap 1: Composer dengan PHP 8.2
# FROM composer:2.6-php8.2 as vendor

# WORKDIR /app
# COPY composer.json composer.lock ./
# RUN composer install --no-dev --optimize-autoloader

# # Tahap 2: Laravel App
# FROM php:8.2-fpm

# RUN apt-get update && apt-get install -y \
#     git curl libpng-dev libonig-dev libxml2-dev zip unzip npm nodejs \
#     && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# COPY --from=composer:2.6-php8.2 /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www
# COPY . .
# COPY --from=vendor /app/vendor /var/www/vendor

# RUN npm install && npm run build

# RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# EXPOSE 9000
# CMD ["php-fpm"]
