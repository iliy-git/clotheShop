FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git curl unzip sqlite3 nodejs npm \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN git config --global --add safe.directory /var/www

COPY . .

RUN mkdir -p database && touch database/database.sqlite && \
    chmod -R 775 storage bootstrap/cache

RUN cp .env.example .env || echo "APP_KEY=" > .env

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN php artisan key:generate

EXPOSE 8000

CMD php artisan migrate --force && \
    php artisan db:seed && \
    php artisan serve --host=0.0.0.0 --port=8000
