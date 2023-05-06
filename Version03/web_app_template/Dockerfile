FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the four files into the container
COPY *.php *.css ./

RUN chmod 644 ./*php ./*css 

# Enable Apache mod_rewrite for friendly URLs
RUN a2enmod rewrite

# Expose port 80 for HTTP traffic
EXPOSE 80 443

# Set the default command to start Apache
CMD ["apache2-foreground"]
