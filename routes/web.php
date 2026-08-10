<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('/coupons', [AdminController::class, 'coupons'])->name('coupons.index');
    Route::get('/coupons/create', [AdminController::class, 'createCoupon'])->name('coupons.create');
    Route::post('/coupons', [AdminController::class, 'storeCoupon'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [AdminController::class, 'editCoupon'])->name('coupons.edit');
    Route::patch('/coupons/{coupon}', [AdminController::class, 'updateCoupon'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [AdminController::class, 'deleteCoupon'])->name('coupons.delete');
});
