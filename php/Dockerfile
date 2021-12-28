FROM php:8.0-fpm
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update
RUN apt-get install -y libpng-dev

RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install -j$(nproc) gd
RUN apt-get install -y libz-dev libmemcached-dev && rm -r /var/lib/apt/lists/*
RUN pecl install memcached
RUN echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-configure calendar && docker-php-ext-install calendar

CMD ["php-fpm"]
