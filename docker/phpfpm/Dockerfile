FROM php:7.4-fpm-buster

ENV DEBIAN_FRONTEND noninteractive


# apt-utils avoid warning in the build process
RUN apt-get update && \
    apt-get install -y apt-utils unzip


COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions zip intl pdo_mysql

# install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php  && \
    mv composer.phar /usr/local/bin/composer


# php configuration variables
ENV PHP_DATETIME_ZONE Europe/Paris
ENV PHP_MEMORY_LIMIT  128M
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS  1
RUN echo "date.timezone = ${PHP_DATETIME_ZONE}" > /usr/local/etc/php/php.ini && \
    echo "memory_limit = ${PHP_MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini && \
    echo "opcache.validate_timestamps = ${PHP_OPCACHE_VALIDATE_TIMESTAMPS}"  >> /usr/local/etc/php/php.ini && \
    echo "short_open_tag = off" >> /usr/local/etc/php/php.ini

