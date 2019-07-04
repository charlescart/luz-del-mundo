web: vendor/bin/heroku-php-apache2 /public/
worker: php artisan queue:restart && php artisan queue:work database --tries=3
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
