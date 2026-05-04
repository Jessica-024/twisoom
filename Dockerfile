FROM php:8.4-cli
# 安装系统依赖
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql gd

# 安装 Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 先复制 composer 文件（优化 cache）
COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 再复制全部项目
COPY . .

# Laravel cache（安全写法）
RUN php artisan config:clear || true

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
