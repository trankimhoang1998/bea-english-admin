#!/bin/bash
set -e

if [ -f "artisan" ]; then
  echo "Laravel đã được cài đặt. Bỏ qua."
  exit 0
fi

echo "Cài đặt Laravel (chạy với root để có quyền ghi)..."
docker compose run --rm --user root php sh -c '
  composer create-project laravel/laravel /tmp/laravel-app
  cp -rp /tmp/laravel-app/. /var/www/html/
  rm -rf /tmp/laravel-app
'

echo "Cập nhật .env..."
docker compose run --rm --user root php sh -c '
  sed -i "/^DB_/d" .env
  printf "\nDB_CONNECTION=mysql\nDB_HOST=mysql\nDB_PORT=3306\nDB_DATABASE=bea_english\nDB_USERNAME=bea_user\nDB_PASSWORD=secret\n" >> .env
'

echo "Generate app key..."
docker compose run --rm --user root php php artisan key:generate

echo "Fix permissions cho www-data..."
docker compose run --rm --user root php \
  chown -R www-data:www-data .

echo ""
echo "Done! Chạy: docker compose up -d"
echo "Laravel:    http://localhost:8080"
echo "phpMyAdmin: http://localhost:8081"
