FROM php:7.3-fpm

USER root
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    # librabbitmq-dev \
    libssh-dev \
    libzip-dev \
    locales \
    zip \
    # jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libpcre3-dev \
    wget \
    dpkg \
    nodejs \
    npm \
    sudo \
    net-tools \
    nano
    # libmagickwand-dev --no-install-recommends \
    # && pecl install imagick \
	  # && docker-php-ext-enable imagick


RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl
# PHP  7.4 doesn't require
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache

RUN docker-php-ext-install \
  bcmath \
  sockets
# RUN pecl install amqp
# RUN docker-php-ext-enable amqp
# RUN npm install npm@latest -g


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

COPY ./fpm/pool.conf /usr/local/etc/php-fpm.d/

# Copy existing application directory contents
# COPY . /var/www

# Copy existing application directory permissions
# COPY --chown=www:www . /var/www
# Change current user to www

# CMD ["php-fpm"]
