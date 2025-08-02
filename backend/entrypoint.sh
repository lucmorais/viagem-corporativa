#!/bin/bash

until mysqladmin ping -h"$DB_HOST" --silent; do
  echo "Aguardando o MySQL subir..."
  sleep 2
done

php artisan migrate --force
php artisan db:seed --force

php artisan serve --host=0.0.0.0 --port=8000