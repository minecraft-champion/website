FROM composer:latest as composer

MAINTAINER William H (Anhgelus Morhtuuzh)

WORKDIR /app

COPY ./ /app

RUN composer install

FROM nginx:latest

COPY --from=composer /app /var/www/
COPY ./config/conf.d /etc/nginx/conf.d/default.conf

EXPOSE 80
