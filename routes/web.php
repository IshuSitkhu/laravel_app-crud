<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::with('user')->get();
    return view('home', compact('products'));
});

// Route::get('/', function () {
//     return view('home'); // public homepage
// });

Route::get('/', function () {
    $products = Product::with('user')->get();
    return view('home', compact('products'));
});

Route::get('/dashboard', function () {
    return redirect()->route('product.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



Route::get('/profile-guest', function (Request $request) {
    return view('profile.guest', [
        'user' => $request->user(),
    ]);
})->middleware('auth')->name('profile.guest');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', function () {
        return view('seller.dashboard');
    });
});

// Route::middleware(['auth', 'role:customer'])->group(function () {
//     Route::get('/customer/dashboard', function () {
//         return view('customer.dashboard');
//     });
// });



require __DIR__.'/auth.php';
require __DIR__.'/product.php';