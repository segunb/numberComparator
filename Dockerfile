FROM php:7.4-apache

RUN apt-get update \
     && apt-get install -y libzip-dev \
     && docker-php-ext-install zip

# CMD bash -c "php composer.phar install"
# CMD bash -c "./copy-bootstrap-files.sh"