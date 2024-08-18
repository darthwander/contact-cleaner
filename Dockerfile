FROM php:8.2-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    git \
    && docker-php-ext-configure gd \
    --with-freetype=/usr/include/freetype2 \
    --with-jpeg=/usr/include \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos composer.json e composer.lock
COPY ./www/composer.json ./www/composer.lock /var/www/html/

# Instalar dependências do Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts --no-plugins

# Copiar todos os arquivos do projeto
COPY ./www /var/www/html

# TODO: Resolver o problema de permissões para que não seja necessário dar permissão 777 no diretório
# Definir permissões corretas para o diretório
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html

# Expor a porta 9000
EXPOSE 9000
CMD ["php-fpm"]