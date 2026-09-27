<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

//index
Route::get('/', [ProductController::class, 'index'])->name('index');

//show
Route::get('/detail-product/{id}', function ($id) {
    $product = Product::findOrFail($id);

    return view('products.detail_product', [
        'product' => $product,
    ]);
})->name('detail-product');

//cart
Route::patch('/cart/{cart}', [ProductController::class, 'update'])->name('cart.update');
Route::post('/add-to-cart/{productId}', [ProductController::class, 'addToCart'])->name('add-to-cart');
Route::post('/cart/delete/{cartId}', [ProductController::class, 'deleteToCart'])
    ->name('delete-to-cart');
Route::get('/cart', [ProductController::class, 'getUserCart'])->name('cart');

//Register
Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::post('/register', [
    AuthController::class, 'register']
)->name('register');

//Login
Route::get('/login', function(){return view('auth.login');})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Logout
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

