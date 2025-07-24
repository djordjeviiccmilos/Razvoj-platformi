FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath

# Instaliraj Node 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN npm install && npm run build

RUN php artisan config:clear && php artisan route:clear

CMD php artisan serve --host=0.0.0.0 --port=8080
