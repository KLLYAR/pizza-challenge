# Use the official PHP image with the desired version as the base image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html/pizza_challenge

# Install additional dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    npm

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader


# Copy the rest of the application files to the container
COPY . .

RUN composer require laravel/ui
# RUN php artisan ui vue --auth
RUN php artisan ui:auth
RUN npm install 
# && npm run dev
# RUN php artisan migrate

# Generate the optimized autoloader
RUN composer dump-autoload --optimize

# Expose port 8000
EXPOSE 8000