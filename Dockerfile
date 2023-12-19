FROM arm64v8/php:8.0-fpm

# Установка зависимостей и расширений PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Копирование приложения в контейнер
COPY . /var/www/html
COPY ./php.ini /usr/local/etc/php/php.ini

# Установка рабочего каталога
WORKDIR /var/www/html

# Установка прав на папки для хранения и фреймворка
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Открытие порта 9000 для PHP-FPM
EXPOSE 9000
