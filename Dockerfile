FROM php:8.2-apache
WORKDIR /var/www/html
RUN apt-get update -y && apt-get install -y telnet libmariadb-dev
RUN docker-php-ext-install mysqli pdo_mysql

RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer