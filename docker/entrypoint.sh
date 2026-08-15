#!/bin/sh
set -e

cd /var/www/html

# ---------- APP_KEY ----------
# Pakai dari environment bila diset; jika kosong, generate sekali lalu simpan
# ke file agar stabil antar restart (tanpa perlu volume khusus).
KEY_FILE=/var/www/html/storage/app/.docker_app_key
if [ -n "${APP_KEY:-}" ] && [ "$APP_KEY" != "base64:" ]; then
    : # APP_KEY sudah diset via environment
elif [ -f "$KEY_FILE" ]; then
    export APP_KEY="$(cat "$KEY_FILE")"
else
    export APP_KEY="$(php artisan key:generate --show --force)"
    echo "$APP_KEY" > "$KEY_FILE"
    chown www-data:www-data "$KEY_FILE"
fi

# ---------- TUNGGU DATABASE ----------
echo "Menunggu database tersedia..."
until php artisan migrate:status --no-ansi >/dev/null 2>&1; do
    sleep 3
done

# ---------- MIGRASI ----------
echo "Menjalankan migrasi..."
php artisan migrate --force

# ---------- SEEDER (hanya saat database masih kosong) ----------
# Menghindari data duplikat pada restart berikutnya.
HAS_USER="$(php -r 'require "vendor/autoload.php"; (require "bootstrap/app.php")->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); echo \App\Models\User::query()->exists() ? "1" : "0";')"
if [ "$HAS_USER" = "0" ]; then
    echo "Database masih kosong -> menjalankan seeder..."
    php artisan db:seed --force
fi

# ---------- PERMISSION VOLUME STORAGE ----------
# Volume named (storage_public/storage_framework) dibuat sebagai root,
# jadi www-data perlu diberi hak tulis setiap container start.
chown -R www-data:www-data storage/app/public storage/framework
chmod -R 775 storage/app/public storage/framework

# ---------- STORAGE LINK ----------
[ -L public/storage ] || ln -sfn storage/app/public /var/www/html/public/storage

# ---------- CACHE VIEW ----------
php artisan view:cache || true

exec "$@"
