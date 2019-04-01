# Natives Backend

This is the backend of our project which serves as API.

## Getting Started

Steps to install and making it live.

To install dependencies for the laravel framework and other packages : 
```
composer install
```

To turn on the server for localhost:
```
php artisan serve
```

We also need to create our databases and put datas inside the table.
To do that, run:
```
php artisan migrate

php artisan db:seed

php artisan db:seed --class=BaseTableSeeder
```

## API Routes 

All routes exists in the routes/api.php
Basically, all tables have their own CRUD in the controller and routes are provided.