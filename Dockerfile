FROM php:8.2-cli

WORKDIR /var/www

# install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project
COPY . .

# install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# fix permissions
RUN chmod -R 775 storage bootstrap/cache

# expose port
EXPOSE 10000

# start laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
