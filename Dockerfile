FROM php:8.4-cli

# 1. System dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install \
    pdo_mysql mbstring exif pcntl bcmath gd

# 2. Node.js 20 (WAJIB untuk Vite 7)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app

# 3. Copy source
COPY . .

# 4. Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Build frontend
RUN rm -rf node_modules package-lock.json \
    && npm install \
    && npm run build

# 6. Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["sh", "-c", "php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]