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
