# Use PHP-Apache image as base
FROM php:7.4-apache

# Set working directory in container
WORKDIR /var/www/html

# Install PDO MySQLi extension
RUN docker-php-ext-install mysqli pdo_mysql

# Create session directory and set ownership
RUN mkdir -p /var/lib/php/sessions && chown www-data:www-data /var/lib/php/sessions

# Copy CodeIgniter app to container
COPY . /var/www/html/

# Change ownership
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update Apache config
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80
