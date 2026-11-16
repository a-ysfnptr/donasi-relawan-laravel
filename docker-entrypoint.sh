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
a2dismod mpm_event 2>/dev/null || true
a2dismod mpm_worker 2>/dev/null || true
a2dismod mpm_prefork 2>/dev/null || true
a2enmod mpm_prefork

exec apache2-foreground
