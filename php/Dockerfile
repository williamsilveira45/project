FROM php:8.3-fpm

### SYSTEM ###

# Update + Install dependencies.
RUN apt-get -y update && apt-get -y install --no-install-recommends \
  autoconf \
  bash \
  ca-certificates \
  g++ \
  gcc \
  git \
  libc-dev \
  libc6 \
  libldb-dev \
  libpng-dev \
  libzip-dev \
  make \
  openssh-client \
  redis \
  unzip \
  wget \
  zip \
  && rm -rf /var/cache/apt/* /var/lib/apt/lists/*

### MODULES ###

# Install PHP extensions
RUN docker-php-ext-configure zip

# Install packaged PHP extensions
RUN docker-php-ext-install \
  bcmath \
  ctype \
  gd \
  opcache \
  pdo \
  mysqli \
  pdo_mysql \
  sysvmsg \
  sysvsem \
  sysvshm \
  zip

# Compile unpackaged PHP extensions
RUN pecl install apcu && docker-php-ext-enable apcu \
  && pecl install redis && docker-php-ext-enable redis \
  && pecl install xdebug && docker-php-ext-enable xdebug

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Copy php config.
COPY local.ini /usr/local/etc/php/conf.d/local.ini

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www/html

COPY post-build.sh /usr/post-build.sh
RUN chmod +x /usr/post-build.sh

EXPOSE 9000 9003
