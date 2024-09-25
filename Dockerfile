FROM php:7.4-apache

# Copy only the php folder contents to the container
COPY php/ /var/www/html/

# Set the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Update Apache's default configuration to use the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Ensure Apache knows how to handle .php files
RUN echo "<FilesMatch \.php$>\n\
    SetHandler application/x-httpd-php\n\
</FilesMatch>" >> /etc/apache2/apache2.conf

# Optional: Install additional PHP extensions if needed
# For example, to install the MySQLi extension, uncomment the line below
# RUN docker-php-ext-install mysqli

# Set permissions for the web root directory
RUN chown -R www-data:www-data /var/www/html

# Make sure permissions are correct
RUN chmod -R 755 /var/www/html

# Expose port 80 for the Apache web server
EXPOSE 80
