FROM php:8.0-apache
RUN docker-php-ext-install bcmath && docker-php-ext-enable bcmath && \
        docker-php-ext-install calendar && docker-php-ext-enable calendar && \
        docker-php-ext-install gd && docker-php-ext-enable gd && \
        docker-php-ext-install mcrypt && docker-php-ext-enable mcrypt && \
        docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql && \
        docker-php-ext-install mysqli && docker-php-ext-enable mysqli && \
        docker-php-ext-install soap && docker-php-ext-enable soap && \
        docker-php-ext-install sockets && docker-php-ext-enable sockets && \
        docker-php-ext-install exif && docker-php-ext-enable exif && \
        docker-php-ext-install wddx && docker-php-ext-enable wddx && \
        docker-php-ext-install wmlrpc && docker-php-ext-enable wmlrpc && \
        docker-php-ext-install zip && docker-php-ext-enable zip
RUN apt-get update && apt-get upgrade -y

FROM richarvey/nginx-php-fpm:1.9.1

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
