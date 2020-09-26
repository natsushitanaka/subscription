FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y imagemagick libmagickwand-dev cron zlib1g-dev mariadb-client vim gcc make libzip-dev libpng-dev unzip libmcrypt-dev libjpeg-dev libfreetype6-dev \
  && docker-php-ext-install zip pdo_mysql\
  && docker-php-ext-configure gd \
  && docker-php-ext-install -j$(nproc) gd\
  && pecl install imagick \
  && docker-php-ext-enable imagick 

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

ADD crontab /var/spool/cron/crontabs/root
RUN crontab /var/spool/cron/crontabs/root

WORKDIR /var/www/src
