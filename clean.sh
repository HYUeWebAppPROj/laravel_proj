#/bin/sh
php artisan clear-compiled
php artisan optimize
#composer update
composer dump-autoload

php artisan cache:clear
php artisan view:clear
php artisan route:clear
#php artisan config:clear
php artisan route:cache
php artisan config:cache