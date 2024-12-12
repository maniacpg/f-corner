<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');

Route::get('/category/{slug}/{id}', [
    'as' => 'category.product',
    'uses' => '\App\Http\Controllers\CategoryController@index'
]);
// routes/web.php
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('cart/update-cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/confirm-order', [CartController::class, 'confirmOrder'])->name('cart.confirm-order');

Route::get('/product-details/{id}', [ProductController::class, 'showDetail'])->name('product.details');

Route::get('/404-notfound', [\App\Http\Controllers\HomeController::class, 'page404'])->name('404');


Route::post('/cart/initiate-payment', [CartController::class, 'initiatePayment'])->name('cart.initiate-payment');
Route::get('/cart/return', [CartController::class, 'paymentReturn'])->name('cart.return');
Route::get('/invoices/{id}', [CartController::class, 'invoiceShow'])->name('invoicesDetail');
Route::get('/cart/get-count', [CartController::class, 'getCount'])->name('cart.getCount');



Route::prefix('user')->group(function () {
    Route::get('/login',[
        'as' => 'user.login',
        'uses' => 'App\Http\Controllers\UserController@login',
    ]);
    Route::post('/login', [
        'as' => 'user.login.post',
        'uses'=>'App\Http\Controllers\UserController@postLogin',
    ]);
    Route::post('/logout', [
        'as' => 'logout',
        'uses'=>'App\Http\Controllers\UserController@logout',
    ]);
    Route::get('/register',[
        'as' => 'user.register',
        'uses' => 'App\Http\Controllers\UserController@userRegister'
    ]);
    Route::post('/store',[
        'as' => 'user.store',
        'uses' => 'App\Http\Controllers\UserController@store'
    ]);

});


Route::get('/product', [\App\Http\Controllers\ProductController::class, 'showAllProduct'])->name('product.show');
Route::get('/products/search', [\App\Http\Controllers\ProductController::class, 'search'])->name('products.search');


Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'myOrder'])->name('orders.index');
Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');
