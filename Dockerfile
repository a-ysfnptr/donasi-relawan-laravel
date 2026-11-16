# Render.com tidak menyediakan runtime PHP native — Laravel di-deploy via Docker.
# Image: PHP 8.3 + Apache (mod_rewrite), ekstensi pdo_pgsql untuk Neon PostgreSQL.
FROM php:8.3-apache

# Dependensi sistem + ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq-dev libzip-dev unzip git \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql zip bcmath \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer dari image resmi (tidak perlu instal manual)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Salin composer dulu agar layer dependency ter-cache
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Salin seluruh kode aplikasi
COPY . .

RUN composer dump-autoload --optimize \
    && mkdir -p storage/app/public/covers storage/app/public/proofs \
        storage/framework/cache storage/framework/sessions storage/framework/views storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Apache melayani folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT ["docker-entrypoint.sh"]
