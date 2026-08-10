<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', [CatalogController::class, 'home'])->name('home');
Route::get('/products', [CatalogController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [CatalogController::class, 'show'])->name('products.show');
