# Natives Backend

This is the backend of our project which serves as API.

## Getting Started

Steps to install and making it live.
```
composer install

php artisan serve

php artisan migrate

php artisan db:seed

php artisan db:seed --class=BaseTableSeeder
```

## Existing Routes 

All routes exists in the routes/api.php
Basically, all tables have their own CRUD in the controller and routes are provided.