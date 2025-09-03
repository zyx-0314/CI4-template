FROM php:8.3-fpm

# System deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    libicu-dev libpng-dev libjpeg-dev libonig-dev libzip-dev unzip git curl \
    && rm -rf /var/lib/apt/lists/*

# Configure/Install PHP extensions
# - mysqli added (fixes your health check)
# - pdo_mysql already present
# - gd configured with JPEG support (common need)
RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" intl mbstring pdo pdo_mysql mysqli gd zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir BEFORE copying composer files so install runs in the right place
WORKDIR /var/www/html

# Leverage Docker layer caching for deps
COPY composer.json composer.lock* ./
# For dev you usually want dev deps; for prod use --no-dev. Keeping dev-friendly by default:
RUN composer install --prefer-dist --no-interaction --no-progress

# Copy the rest of the app
COPY ./ ./

# Dev PHP settings
RUN { \
    echo "display_errors=On"; \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=32M"; \
    echo "post_max_size=32M"; \
    } > /usr/local/etc/php/conf.d/dev.ini
