<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::middleware(['auth'])->group(function () {

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

});


// Route::middleware(['auth', 'role:customer'])->group(function () {

//     Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// });