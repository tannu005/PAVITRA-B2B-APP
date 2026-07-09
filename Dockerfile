FROM php:8.2-apache

# Install required PHP extensions for the database
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for nice URLs
RUN a2enmod rewrite

# Railway assigns a dynamic port via the PORT environment variable.
# We configure Apache to listen on this dynamically assigned port.
ENV PORT=8080
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Copy the application code to the container
COPY . /var/www/html/

# Update the default Apache site to point to the /public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-enabled/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE $PORT
