FROM composer:2.0 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction


FROM node:18 as build-npm
WORKDIR /usr/app
COPY --from=build /app ./
RUN npm i
RUN npm run prod


FROM php:8.1-apache-buster as production 

#ENV APP_ENV=production
#ENV APP_DEBUG=false

RUN apt-get update && apt-get install -y libpq-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_pgsql
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=build-npm /usr/app /var/www/html
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.prod /var/www/html/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate:fresh --seed && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]