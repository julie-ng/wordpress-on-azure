FROM wordpress:5.5

# PHP Configuration, e.g. max upload size, etc.
COPY ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Pre-install Azure Storage Plugin
COPY ./wp-plugins/windows-azure-storage /var/www/html/wp-content/plugins/windows-azure-storage
