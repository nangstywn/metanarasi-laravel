#!/bin/bash
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env .env
else
    echo "env file exists"
fi
echo "Waiting for MySQL to be ready..."
sleep 15
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan db:seed
php artisan key:generate

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"