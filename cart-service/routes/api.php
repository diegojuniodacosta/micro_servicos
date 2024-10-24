<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::post('carts/{cart}/add-product', [CartController::class, 'addProduct']);
Route::delete('carts/{cart}/remove-product/{product}', [CartController::class, 'removeProduct']);
Route::get('carts/{cart}', [CartController::class, 'show']);

Route::post('/cart', [CartController::class, 'addToCart']);
