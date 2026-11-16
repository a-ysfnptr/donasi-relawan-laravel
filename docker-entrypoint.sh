#!/bin/bash
set -e

# Render menetapkan $PORT (default 10000). Apache harus mendengarkan port itu.
PORT="${PORT:-80}"
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Tautan storage publik (abaikan bila sudah ada)
php artisan storage:link || true

# Migrasi database Neon (hanya bila DATABASE_URL terisi). --force untuk production.
if [ -n "$DATABASE_URL" ]; then
  php artisan migrate --force || echo "PERINGATAN: migrasi gagal — periksa DATABASE_URL di dashboard Render."
else
  echo "PERINGATAN: DATABASE_URL kosong — migrasi dilewati."
fi

exec php artisan serve --host=0.0.0.0 --port=${PORT}

