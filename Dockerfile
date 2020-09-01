FROM wordpress:5.5

COPY ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

COPY ./themes/airi /var/www/html/wp-content/themes/airi
