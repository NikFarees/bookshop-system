FROM php:8.4-fpm

# System deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Optional: create non-root user (not strict)
RUN useradd -m -u 1000 laravel || true

# Safe to keep (but bind mount may override on Linux)
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]

