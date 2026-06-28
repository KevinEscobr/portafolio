FROM php:8.4-fpm-alpine

# Instalar dependencias del sistema indispensables
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    oniguruma-dev \
    libxml2-dev

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath xml gd zip

# Instalar Composer globalmente desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo interno
WORKDIR /var/www/html

# Exponer el puerto nativo de PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
