#!/bin/bash

until mysqladmin ping -h"$DB_HOST" --silent; do
  echo "Aguardando o MySQL subir..."
  sleep 2
done

php artisan migrate --force