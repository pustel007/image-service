FROM php:8.1-fpm

RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip 
RUN docker-php-ext-install zip gd exif

RUN apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN mkdir -p /usr/src/php/ext/imagick \
    && curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1 \
    && docker-php-ext-install imagick

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get clean \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

ADD php.conf /usr/local/etc/php-fpm.d/

WORKDIR /var/www