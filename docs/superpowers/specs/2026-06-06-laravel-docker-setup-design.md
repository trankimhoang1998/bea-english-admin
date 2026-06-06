# Design: Laravel Docker Setup — Bea English Admin

**Date:** 2026-06-06  
**Project:** Bea English Admin — Hệ thống quản lý trung tâm tiếng Anh  
**Status:** Approved

---

## Tổng quan

Setup môi trường phát triển (development only) cho project Laravel mới nhất, sử dụng Docker Compose thuần với 4 services: PHP-FPM, Nginx, MySQL, phpMyAdmin.

**Yêu cầu:** Docker Engine >= 24 với Compose plugin v2 (`docker compose`, không phải `docker-compose` v1).

---

## Cấu trúc thư mục

```
bea-english-admin/
├── docker/
│   ├── nginx/
│   │   └── default.conf        # Nginx virtual host config
│   └── php/
│       └── Dockerfile          # php:8.4-fpm-alpine + extensions + Composer
├── src/                        # Laravel source (tạo bởi init.sh)
├── docker-compose.yml
└── init.sh                     # Script cài Laravel lần đầu (chmod +x, chạy một lần)
```

---

## Services & Image Versions

| Service      | Image                         | Port host:container |
|-------------|-------------------------------|---------------------|
| `php`        | `php:8.4-fpm-alpine` (custom) | —                   |
| `nginx`      | `nginx:1.27-alpine`           | `8080:80`           |
| `mysql`      | `mysql:8.4`                   | `3306:3306`         |
| `phpmyadmin` | `phpmyadmin:5.2`              | `8081:80`           |

---

## PHP Dockerfile (`docker/php/Dockerfile`)

**Base:** `php:8.4-fpm-alpine`

**Alpine packages (apk add --no-cache):**
```
libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev icu-dev libexif-dev
```

**PHP Extensions:**
```dockerfile
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo_mysql mbstring exif bcmath gd zip intl opcache
```

**Composer:** `COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer`

**WORKDIR:** `/var/www/html`

> Không `chown` trong Dockerfile vì `/var/www/html` là bind-mount tại runtime — chown trong image layer không có tác dụng với host files. Permissions được fix trong `init.sh`.

---

## Nginx Config

**Delivery:** Bind-mount trong `docker-compose.yml` cho `nginx` service:
```yaml
volumes:
  - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
  - ./src:/var/www/html
```

> `nginx` phải mount `./src:/var/www/html` để phục vụ files từ `/var/www/html/public`. Không có mount này, static assets và PHP sẽ trả về 404.

**`docker/nginx/default.conf`:**
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

---

## `docker-compose.yml` — Chi tiết

### Volume mounts

| Service      | Host path                              | Container path                        |
|-------------|----------------------------------------|---------------------------------------|
| `php`        | `./src`                                | `/var/www/html`                       |
| `nginx`      | `./src`                                | `/var/www/html`                       |
| `nginx`      | `./docker/nginx/default.conf`          | `/etc/nginx/conf.d/default.conf`      |
| `mysql`      | `mysql_data` (named volume)            | `/var/lib/mysql`                      |

### Named volumes (khai báo ở cuối file)

```yaml
volumes:
  mysql_data:
```

### depends_on

- `php` depends_on `mysql` → condition: `service_healthy`
- `nginx` depends_on `php` → condition: `service_started`
- `phpmyadmin` depends_on `mysql` → condition: `service_healthy`

### MySQL healthcheck

```yaml
healthcheck:
  test: ["CMD", "mysqladmin", "ping", "-h", "localhost", "-u", "root", "-p$$MYSQL_ROOT_PASSWORD"]
  interval: 5s
  timeout: 20s
  retries: 10
```

---

## Biến môi trường

**MySQL:**
```
MYSQL_DATABASE=bea_english
MYSQL_USER=bea_user
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=root_secret
```

**phpMyAdmin:**
```
PMA_HOST=mysql
PMA_USER=bea_user
PMA_PASSWORD=secret
```

**Laravel `.env` — giá trị cần ghi đè (sed chạy bên trong container — luôn là Linux):**
```
DB_HOST=mysql          # KHÔNG phải 127.0.0.1
DB_DATABASE=bea_english
DB_USERNAME=bea_user
DB_PASSWORD=secret
```
> `DB_CONNECTION=mysql` và `DB_PORT=3306` giữ nguyên default của Laravel, không cần ghi đè.

---

## Init Flow (`init.sh`)

**Location:** Project root (`./init.sh`), cần `chmod +x init.sh` trước khi chạy.

**Nguyên tắc:**
- Toàn bộ `sed` chạy **bên trong container** (Alpine Linux) → tránh hoàn toàn vấn đề macOS vs Linux BSD/GNU sed.
- Composer chạy với `--user root` để có quyền ghi vào `./src` (Docker tạo thư mục này với `root:root` nếu chưa tồn tại).
- Sau khi cài xong, `chown -R www-data:www-data .` để PHP-FPM (`www-data`) có quyền đọc/ghi.

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

echo "Done. Chạy: docker compose up -d"
```

---

## Lệnh hàng ngày

```bash
# Setup lần đầu
chmod +x init.sh && ./init.sh
docker compose up -d

# Khởi động / tắt
docker compose up -d
docker compose down

# Artisan (container đang chạy)
docker compose exec php php artisan migrate
docker compose exec php php artisan tinker
docker compose exec php php artisan make:controller ExampleController

# Reset database hoàn toàn
docker compose down -v
```

---

## Constraints & Decisions

| Decision | Lý do |
|----------|-------|
| `php:8.4-fpm-alpine` | Nhẹ hơn debian; đủ package cho tất cả extensions |
| `nginx:1.27-alpine`, `phpmyadmin:5.2`, `composer:2.8` | Pin version, tránh breaking changes |
| `DB_HOST=mysql` | Tên Docker service, không phải `127.0.0.1` |
| `sed` chạy trong container | Tránh macOS/Linux BSD vs GNU sed incompatibility |
| `composer create-project` chạy với `--user root` | Docker tạo `./src` với `root:root`; `www-data` không có quyền ghi |
| `chown -R www-data:www-data .` sau khi cài | PHP-FPM chạy với `www-data`, cần quyền đọc/ghi toàn bộ `src/` |
| `nginx` mount `./src:/var/www/html` | Cần thiết để phục vụ files từ `/var/www/html/public` |
| `depends_on + healthcheck` trên MySQL | Đảm bảo MySQL ready trước PHP và phpMyAdmin |
| Docker Compose v2 (`docker compose`) | `docker-compose` v1 không được hỗ trợ |
| `init.sh` thủ công, idempotent | Guard check `src/artisan`; an toàn khi chạy lại |
