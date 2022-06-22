FROM php:7.4-fpm-buster
RUN useradd -ms /bin/bash 1000 && adduser 1000 sudo
#set timezone
ARG TIMEZONE
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    nano\
    sudo \
    iproute2\
    openssh-client\
    cron \
    file \
    zip \
    vim \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libpq-dev \
    libgmp-dev \
    libxml2-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

RUN docker-php-ext-install \
    gmp pcntl soap pdo pdo_mysql zip xsl gd intl opcache exif mbstring

RUN yes | pecl install apcu xdebug \
    && echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=172.17.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "opcache.max_accelerated_files=50000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=60" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_wasted_percentage=10" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini


ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PATH "/composer/vendor/bin:$PATH"

RUN curl --silent --show-error https://getcomposer.org/installer | php -- -- \
    php -- --install-dir=/usr/bin/ --filename=composer && \
    composer global require phpunit/phpunit && \
    composer clear-cache