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

Route::get('/', 'User\ProductsController@top')->name('user.products.top');

Auth::routes();

Route::group([ 'as' => 'user.', 'middleware' => 'auth:user', 'namespace' => 'User'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users', 'UserController', ['only' => ['edit', 'update', 'destroy']]);
    Route::get('/products/{product}', 'ProductsController@show')->name('products.show');
    Route::post('/cart_items/all_destroy', 'CartItemsController@allDestroy')->name('cart_items.all_destroy');
    Route::resource('/cart_items', 'CartItemsController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('/addresses', 'AddressesController', ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);
    Route::post('/orders/confirm', 'OrdersController@confirm')->name('orders.confirm');
    Route::get('/orders/thanks', 'OrdersController@thanks')->name('orders.thanks');
    Route::resource('/orders', 'OrdersController', ['only' => ['index', 'show', 'create', 'store']]);
});

Route::prefix('admin')
->group(function () {
    Route::get('/login', 'Admin\LoginController@loginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
    Route::resource('/users', 'UserController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::get('/users/{user}/order', 'UserController@order')->name('users.order');
    Route::resource('/genres', 'GenresController', ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/products/selling', 'ProductsController@onlySelling')->name('products.selling');
    Route::resource('/products', 'ProductsController');
    Route::resource('/orders', 'OrdersController', ['only' => ['index', 'show', 'update']]);
    Route::resource('/order_details', 'OrderDetailsController', ['only' => ['update']]);
});