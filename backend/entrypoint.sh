#!/bin/bash

cd /var/www

if [ ! -d "vendor" ]; then
  echo "📦 Instalando dependências do Laravel..."
  composer install --no-interaction --prefer-dist
fi

if [ ! -f ".env" ]; then
  echo "⚙️ Copiando .env..."
  cp .env.example .env
fi

if ! grep -q "APP_KEY=base64" .env; then
  echo "🔑 Gerando chave da aplicação..."
  php artisan key:generate
fi

until mysqladmin ping -h"$DB_HOST" --silent; do
  echo "Aguardando o MySQL subir..."
  sleep 2
done

echo "✅ MySQL está pronto — iniciando Laravel..."

php artisan migrate --force
php artisan db:seed --force

php artisan serve --host=0.0.0.0 --port=8000