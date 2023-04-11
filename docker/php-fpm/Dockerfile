FROM php:8.2.4-fpm
WORKDIR "/app"

# Update
RUN apt-get update

# Install ZIP
RUN apt-get install -y libzip-dev zip

# Install PHP extensions
RUN docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Cleanup
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
