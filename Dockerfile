FROM php:8.1-apache

MAINTAINER William H (Anhgelus Morhtuuzh)

RUN a2enmod rewrite

COPY ./ /var/www/

EXPOSE 80
