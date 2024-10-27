<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CartController;

// Home (Shop page)
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Add to cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');

// View cart
Route::get('/cart', [CartController::class, 'showCart'])->name('show-cart');

Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update-quantity');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
