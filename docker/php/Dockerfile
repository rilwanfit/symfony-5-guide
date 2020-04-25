FROM php:7.4-fpm

# base packages
RUN apt-get update \
    && apt-get install -y git zip unzip \
    && docker-php-ext-install \
        mysqli \
        pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer \
 && composer global require hirak/prestissimo --no-plugins --no-scripts


WORKDIR /app