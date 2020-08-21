FROM php:7.4-fpm

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    apt-get update -y && \
    curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash && \
    apt-get update && apt-get install -y \
    build-essential \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    iputils-ping \
    net-tools \
    libpng-dev \
    libssl-dev \
    libzip-dev \
    libonig-dev \
    apt-utils \
    cron \
    vim \
    nano \
    curl \
    wget \
    git \
    libxml2-dev \
    gnupg 

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    tokenizer \
    intl \
    xml \
    ctype \
    json \
    zip \
    gd

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Change current user to www
USER www

CMD ["php-fpm"]