FROM php:7.4-fpm

ENV XDEBUG_VERSION 3.1.2

RUN pecl install xdebug-3.1.2 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install mysqli pdo pdo_mysql

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /app