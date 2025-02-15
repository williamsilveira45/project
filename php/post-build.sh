#!/bin/bash

cd /var/www/html/backend

composer install
if [ ! -f ".env" ]; then
  cp .env.example .env
  php artisan key:generate
fi

php artisan telescope:publish

#if already exists it will be ignored
php artisan vendor:publish --provider="Spatie\LaravelData\LaravelDataServiceProvider" --tag="data-config"
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

#php artisan serve --host 0.0.0.0 --port 8888
php-fpm
