<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');

Route::post('/logout', 'AuthController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::apiResources([
	'api/customers' => 'CustomerController',
	'api/categories' => 'CategoryController',
	'api/genders' => 'GenderController',
	'api/images' => 'ImageController',
	'api/items' => 'ItemController',
	'api/payments' => 'PaymentController',
	'api/roles' => 'RoleController',
	'api/suppliers' => 'SupplierController',
	'api/transactions' => 'TransactionController',
	'api/types' => 'TypeController',
]);

Route::apiResource('users','UserController')->only(['index','show']);
Route::apiResource('api/carts','CartController')->only(['index','show']);
Route::apiResource('api/wishlists','WishlistController')->only(['index','show']);

