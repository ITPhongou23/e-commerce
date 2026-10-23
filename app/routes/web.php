<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

//index
Route::get('/', [ProductController::class, 'index'])->name('index');


//Detail-product
Route::get('/detail-product/{productId}', [ProductController::class, 'get_detail_product'])->name('detail-product');


//Product
Route::get('/buy/{productId}',[ProductController::class,'buyToProduct'])->name('buy-to-product');


//Buy
Route::get('/buy', [CartController::class, 'getUserBuyCart'])->name('buy');
Route::post('/buy',[CartController::class,'buyToCart'])->name('buy_to_cart');


//cart
Route::get('/cart', [CartController::class, 'getUserCart'])->name('cart');
Route::post('/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::patch('/cart/{cart}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/delete/{cartId}', [CartController::class, 'deleteToCart'])->name('delete-to-cart');


//Register
Route::get('/register', [AuthController::class,'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


//Login
Route::get('/login', [AuthController::class,'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');


//Logout
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

//Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('products', [ProductController::class, 'index_admin'])->name('products.index');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('orders', [OrderController::class, 'index_order_admin'])->name('orders.index');
});

//Order
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');
});
