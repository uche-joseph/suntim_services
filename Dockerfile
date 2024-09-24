FROM php:7.4-apache

# Copy only the php folder contents to the container
COPY php/ /var/www/html/

# Set the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install any PHP extensions you might need
# For example, if you need MySQLi:
# RUN docker-php-ext-install mysqli

# Set permissions
RUN chown -R www-data:www-data /var/www/html