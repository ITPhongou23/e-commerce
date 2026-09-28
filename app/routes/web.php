<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

//index
Route::get('/', [ProductController::class, 'index'])->name('index');


//Detail-product
Route::get('/detail-product/{productId}', [ProductController::class, 'detailproduct'])->name('detail-product');


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




