FROM creativitykills/nginx-php-server:2.0.0
MAINTAINER Antonio Pinto
COPY . /var/www/
RUN chmod -Rf 777 /var/www/storage/
