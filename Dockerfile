FROM php:8.1-apache

# Install additional PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli php-imagick
RUN docker-php-ext-enable imagick
RUN a2enmod rewrite
RUN service apache2 restart