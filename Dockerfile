# Multi-stage build for production
FROM php:8.4-fpm-alpine AS base

# Set working directory early
WORKDIR /var/www/html

# Add retry logic and use faster mirrors
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories || \
    sed -i 's/dl-cdn.alpinelinux.org/mirror.aarnet.edu.au/g' /etc/apk/repositories

# Update package list with retries
RUN apk update --no-cache || \
    (sleep 5 && apk update --no-cache) || \
    (sleep 10 && apk update --no-cache)

# Install system dependencies in smaller groups
RUN apk add --no-cache --virtual .build-deps \
    autoconf \
    g++ \
    make \
    git \
    libzip-dev \
    icu-dev

RUN apk add --no-cache \
    curl \
    mysql-client \
    nodejs \
    npm \
    zip \
    unzip \
    libzip \
    icu-libs

# Install image processing tools
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle

# Install other PHP dependencies
RUN apk add --no-cache \
    oniguruma-dev \
    libxml2-dev

# Configure and install GD extension
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# Install other PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    opcache \
    zip \
    intl

# Install Redis extension
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del pcre-dev $PHPIZE_DEPS

# Remove build dependencies to reduce image size
RUN apk del .build-deps

# Configure PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy custom PHP configs
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-interaction

# Copy package files
COPY package.json package-lock.json ./

# Install node dependencies
RUN npm ci --production=false

# Copy application files
COPY --chown=www-data:www-data . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize --no-dev

# Build frontend assets
RUN npm run build && rm -rf node_modules

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create log directory
RUN mkdir -p /var/log/php-fpm && chown -R www-data:www-data /var/log/php-fpm

EXPOSE 9000

CMD ["php-fpm"]