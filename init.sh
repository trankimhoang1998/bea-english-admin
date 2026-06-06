#!/bin/bash
set -e

if [ -f "src/artisan" ]; then
  echo "src/ đã có Laravel. Bỏ qua cài đặt."
  exit 0
fi

echo "Tạo thư mục src/..."
mkdir -p src

echo "Cài đặt Laravel (chạy với root để có quyền ghi)..."
docker compose run --rm --user root php \
  composer create-project laravel/laravel .

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
