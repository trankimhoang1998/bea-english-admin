# Laravel Docker Setup Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Tạo môi trường phát triển Laravel mới nhất với Docker Compose (PHP 8.4, Nginx, MySQL 8.4, phpMyAdmin) cho project Bea English Admin.

**Architecture:** 4 Docker services (php-fpm, nginx, mysql, phpmyadmin) kết nối qua Docker network mặc định. Nginx nhận request → forward PHP-FPM → Laravel → MySQL. Code sync qua bind-mount `./src:/var/www/html`. Init script chạy một lần để cài Laravel và fix permissions.

**Tech Stack:** PHP 8.4-fpm-alpine, nginx:1.27-alpine, mysql:8.4, phpmyadmin:5.2, Composer 2.8, Laravel (latest via composer create-project), Docker Compose v2.

---

## File Map

| File | Hành động | Mô tả |
|------|-----------|-------|
| `docker/php/Dockerfile` | Tạo mới | PHP 8.4-fpm-alpine + extensions + Composer 2.8 |
| `docker/nginx/default.conf` | Tạo mới | Nginx virtual host config cho Laravel |
| `docker-compose.yml` | Tạo mới | 4 services, volumes, depends_on, healthcheck |
| `init.sh` | Tạo mới | Script cài Laravel + fix permissions (chạy một lần) |

---

## Task 1: PHP Dockerfile

**Files:**
- Create: `docker/php/Dockerfile`

- [ ] **Bước 1: Tạo thư mục**

```bash
mkdir -p docker/php docker/nginx
```

- [ ] **Bước 2: Tạo `docker/php/Dockerfile`**

```dockerfile
FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libexif-dev

RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    bcmath \
    gd \
    zip \
    intl \
    opcache

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
```

- [ ] **Bước 3: Verify Dockerfile build thành công**

```bash
docker build -t bea-php-test docker/php/
```

Expected: `Successfully built <image-id>` — không có lỗi.

Nếu lỗi `apk add` hoặc extension: kiểm tra kết nối internet và tên package.

- [ ] **Bước 4: Commit**

```bash
git init
git add docker/php/Dockerfile
git commit -m "feat: add PHP 8.4-fpm-alpine Dockerfile with extensions"
```

---

## Task 2: Nginx Config

**Files:**
- Create: `docker/nginx/default.conf`

- [ ] **Bước 1: Tạo `docker/nginx/default.conf`**

```nginx
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

- [ ] **Bước 2: Commit**

```bash
git add docker/nginx/default.conf
git commit -m "feat: add Nginx virtual host config for Laravel"
```

---

## Task 3: docker-compose.yml

**Files:**
- Create: `docker-compose.yml`

- [ ] **Bước 1: Tạo `docker-compose.yml`**

```yaml
services:
  php:
    build:
      context: ./docker/php
    volumes:
      - ./src:/var/www/html
    depends_on:
      mysql:
        condition: service_healthy

  nginx:
    image: nginx:1.27-alpine
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php

  mysql:
    image: mysql:8.4
    ports:
      - "3306:3306"
    environment:
      MYSQL_DATABASE: bea_english
      MYSQL_USER: bea_user
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: root_secret
    volumes:
      - mysql_data:/var/lib/mysql
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost", "-u", "root", "-proot_secret"]
      interval: 5s
      timeout: 20s
      retries: 10

  phpmyadmin:
    image: phpmyadmin:5.2
    ports:
      - "8081:80"
    environment:
      PMA_HOST: mysql
      PMA_USER: bea_user
      PMA_PASSWORD: secret
    depends_on:
      mysql:
        condition: service_healthy

volumes:
  mysql_data:
```

> **Lưu ý:** MySQL healthcheck dùng password hardcoded `-proot_secret` (không có space giữa `-p` và password) thay vì `$$MYSQL_ROOT_PASSWORD` để tránh shell expansion issues trong YAML array form.

- [ ] **Bước 2: Verify cú pháp YAML**

```bash
docker compose config
```

Expected: In ra toàn bộ config đã merge, không có lỗi YAML.

- [ ] **Bước 3: Verify images pull được**

```bash
docker compose pull mysql phpmyadmin nginx
```

Expected: Tất cả images pull thành công.

- [ ] **Bước 4: Commit**

```bash
git add docker-compose.yml
git commit -m "feat: add docker-compose with php, nginx, mysql, phpmyadmin"
```

---

## Task 4: init.sh

**Files:**
- Create: `init.sh`

- [ ] **Bước 1: Tạo `init.sh`**

```bash
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
```

- [ ] **Bước 2: Set execute permission**

```bash
chmod +x init.sh
```

- [ ] **Bước 3: Commit**

```bash
git add init.sh
git commit -m "feat: add init.sh for first-time Laravel installation"
```

---

## Task 5: Chạy init và verify toàn bộ stack

- [ ] **Bước 1: Build image PHP**

```bash
docker compose build php
```

Expected: Build thành công, không lỗi.

- [ ] **Bước 2: Chạy init.sh**

```bash
./init.sh
```

Expected output (theo thứ tự):
```
Tạo thư mục src/...
Cài đặt Laravel (chạy với root để có quyền ghi)...
[Composer output — nhiều dòng, kết thúc bằng "Application ready!"]
Cập nhật .env...
Generate app key...
Application key set successfully.
Fix permissions cho www-data...
Done! Chạy: docker compose up -d
```

Nếu lỗi `Connection refused` ở bước Composer: MySQL chưa healthy, chờ thêm 30s rồi thử lại.

- [ ] **Bước 3: Kiểm tra .env đã được cập nhật đúng**

```bash
grep -E "^DB_" src/.env
```

Expected:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=bea_english
DB_USERNAME=bea_user
DB_PASSWORD=secret
```

- [ ] **Bước 4: Khởi động toàn bộ stack**

```bash
docker compose up -d
```

Expected: 4 containers `Started` hoặc `Running`.

- [ ] **Bước 5: Verify các services đang chạy**

```bash
docker compose ps
```

Expected: Tất cả 4 services ở trạng thái `running`.

- [ ] **Bước 6: Verify Laravel trả về trang chủ**

```bash
curl -s -o /dev/null -w "%{http_code}" http://localhost:8080
```

Expected: `200`

- [ ] **Bước 7: Verify phpMyAdmin accessible**

```bash
curl -s -o /dev/null -w "%{http_code}" http://localhost:8081
```

Expected: `200`

- [ ] **Bước 8: Verify kết nối database**

```bash
docker compose exec php php artisan migrate
```

Expected: `Migration table created successfully.` và danh sách migrations chạy thành công.

- [ ] **Bước 9: Final commit**

```bash
git add src/.env.example
git commit -m "chore: verify Laravel Docker stack working end-to-end"
```

> **Lưu ý:** Không commit `src/.env` (có thông tin nhạy cảm). Đảm bảo `src/.env` đã có trong `.gitignore` (Laravel tạo sẵn).

---

## Troubleshooting

| Triệu chứng | Nguyên nhân | Fix |
|-------------|-------------|-----|
| `curl: (7) Failed to connect to localhost port 8080` | Container chưa start | `docker compose ps` kiểm tra trạng thái |
| `502 Bad Gateway` từ Nginx | PHP-FPM chưa ready | Chờ 5-10s sau `docker compose up -d` |
| `SQLSTATE[HY000] [2002] Connection refused` | MySQL chưa healthy | `docker compose logs mysql` kiểm tra |
| `Permission denied` trong PHP | Permissions chưa fix | Chạy lại: `docker compose run --rm --user root php chown -R www-data:www-data .` |
| `composer create-project` fail — dir not empty | `src/` đã có files | Xoá `src/` và chạy lại `init.sh` |
