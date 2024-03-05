FROM php:8.2-apache

RUN docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN a2enmod rewrite
COPY . /var/www/html/
WORKDIR /var/www/html

RUN composer install