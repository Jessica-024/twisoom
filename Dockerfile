FROM php:8.2-cli

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip

# 安装 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 设置工作目录
WORKDIR /var/www

# 复制项目
COPY . .

# 安装 Laravel 依赖
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Laravel 设置
RUN php artisan key:generate || true

# 端口
EXPOSE 10000

# 启动 Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
