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
  sed -i "s/DB_HOST=127.0.0.1/DB_HOST=mysql/" .env
  sed -i "s/DB_DATABASE=laravel/DB_DATABASE=bea_english/" .env
  sed -i "s/DB_USERNAME=root/DB_USERNAME=bea_user/" .env
  sed -i "s/DB_PASSWORD=/DB_PASSWORD=secret/" .env
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
