FROM php:7.2-fpm-stretch

ENV DEBIAN_FRONTEND noninteractive

# apt-utils avoid warning in the build process
RUN apt-get update && \
    apt-get install -y apt-utils

#requirements for composer
RUN apt-get update && \
    apt-get install -y zlib1g-dev unzip && \
    docker-php-ext-install zip

# install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php  && \
    mv composer.phar /usr/local/bin/composer

# RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql

# php configuration variables
ENV PHP_DATETIME_ZONE Europe/Paris
ENV PHP_MEMORY_LIMIT  128M
RUN echo "date.timezone = ${PHP_DATETIME_ZONE}" > /usr/local/etc/php/php.ini && \
    echo "memory_limit = ${PHP_MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini && \
    echo "short_open_tag = off" >> /usr/local/etc/php/php.ini
