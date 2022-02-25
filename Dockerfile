FROM composer:latest as composer

MAINTAINER William H (Anhgelus Morhtuuzh)

WORKDIR /app

COPY ./ /app

RUN composer install

FROM php:8.1-apache

RUN a2enmod rewrite

COPY --from=composer /app /var/www/

EXPOSE 80
