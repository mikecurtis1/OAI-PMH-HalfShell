FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY src/ /var/www/html/

# Set Apache document root to /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Enable .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN echo "short_open_tag=On" >> /usr/local/etc/php/conf.d/short-tags.ini

RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 80