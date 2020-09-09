FROM wordpress:5.5

COPY ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

COPY ./wp-plugins/windows-azure-storage /var/www/html/wp-content/plugins/windows-azure-storage
