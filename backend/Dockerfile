FROM php:8.3-fpm

# OS dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev libpng-dev libjpeg-dev libonig-dev libzip-dev unzip git curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl mbstring pdo pdo_mysql gd zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer metadata early to leverage Docker layer caching, then install deps
# This installs vendor/ into the image. If you bind-mount source at runtime, the
# host's files will override the container filesystem (including vendor/).
COPY composer.json composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader
COPY ./ ./

WORKDIR /var/www/html

# Dev PHP settings
RUN { \
    echo "display_errors=On"; \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=32M"; \
    echo "post_max_size=32M"; \
    } > /usr/local/etc/php/conf.d/dev.ini
