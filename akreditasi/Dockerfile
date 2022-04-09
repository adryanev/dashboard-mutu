FROM yiisoftware/yii2-php:7.4-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/akreditasi/web|g' /etc/apache2/sites-available/000-default.conf
RUN usermod -u 1000 -s /bin/bash www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /app
