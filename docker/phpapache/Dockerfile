FROM php:7.2-apache-stretch

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


RUN a2enmod rewrite
# apache configuration variable
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
