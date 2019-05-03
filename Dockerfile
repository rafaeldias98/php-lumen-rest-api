FROM php:7.3-fpm

ARG COMPOSER_ARGS=""

RUN apt-get update \
    && apt-get install -y \
    zip \
    unzip \
    autoconf \
    libzip-dev \
    git \
    libmcrypt-dev \
    mysql-client \
    && docker-php-ext-install mbstring pdo_mysql \
    && cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime \
    && echo "America/Sao_Paulo" | tee /etc/TZ /etc/timezone

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-scripts \
    --no-autoloader \
    --no-progress ${COMPOSER_ARGS}

COPY . .

RUN chown -R www-data:www-data ./ && chmod -R 775 storage
RUN composer dump-autoload --optimize
