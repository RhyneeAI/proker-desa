# syntax=docker/dockerfile:1

############### STAGE 1: BUILD FRONTEND ASSETS ###############
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

############### STAGE 2: PHP APP ###############
FROM php:8.3-fpm-alpine AS app

WORKDIR /var/www/html

# Ekstensi PHP yang dibutuhkan Laravel + pdo_mysql + zip (composer)
RUN apk add --no-cache \
        libzip-dev \
        oniguruma-dev \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        bcmath \
        pcntl \
        zip \
        opcache \
    && docker-php-ext-enable opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Konfigurasi PHP + entrypoint
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Salin aplikasi (vendor/node_modules/public/build diabaikan via .dockerignore)
COPY . .

# Install dependency PHP (tanpa dev) + build cache
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Hasil build frontend dari stage 1
COPY --from=assets /app/public/build /var/www/html/public/build

# Struktur storage + permission
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && ln -sfn storage/app/public /var/www/html/public/storage

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
