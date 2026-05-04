FROM php:8.2-cli

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# 安装 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 设定工作目录
WORKDIR /app

# 复制项目
COPY . .

# 安装 Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimize
RUN php artisan config:cache || true

# 开放端口
EXPOSE 10000

# 启动
CMD php -S 0.0.0.0:10000 -t public
