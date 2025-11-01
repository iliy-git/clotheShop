FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl unzip sqlite3 nodejs npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN touch database/database.sqlite

RUN chmod -R 775 storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

CMD sh -c "php artisan migrate --force && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000"
