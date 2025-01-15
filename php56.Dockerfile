FROM php:5.6-fpm

# Installation de mysqli
RUN docker-php-ext-install mysqli 