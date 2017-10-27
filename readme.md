# Runnning App

Once you download the app, install all the dependecies:
```
composer install
npm install
```
Create a database with name c1. Then run migrations and seed: 
```
php artisan migrate
php artisan db:seed
```
After that, you can start a php server:
```
php -S localhost:8000 -t public
```