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

We also need to create our databases and put datas inside the table. To do that, run:
```
php artisan migrate
```

The seeders are separated into 2 seeders. The first seeder is used to populate the primary keys so it is only needed to be run once.
```
php artisan db:seed
```
The second seeder can be run multiple times depending on how much data you want and need.
```
php artisan db:seed --class=BaseTableSeeder
```

## API Routes 

All routes exists in the routes/api.php
Basically, all tables have their own CRUD in the controller and routes are provided.

### User Related 

These routes are based of the user and auth model to login, logout and register to the database.

```
/api/login
/api/register
/api/logout
```

Each user has their own profile based of their roles. To see these users based of the roles, it could be seen from their routes which are :
```
/api/customers
/api/suppliers
```

### Item Related

Each item has their own image, gender,type and category. With this, all items has their own classifications and can be seen in these routes: 
```
/api/items
/api/types
/api/genders
/api/categories
```

### Transaction Related

The routes below are based of the transaction, payment and cart model which links to each other to transition to process the payment.
```
/api/carts
/api/payments
/api/transactions
```

All these routes support the GET, POST, PUT, DELETE method.