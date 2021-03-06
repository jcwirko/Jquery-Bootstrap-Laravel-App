<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/


Route::get('/', function() {
    return view('layouts.admin');
});

Route::get('panel-administrativo', [HomeController::class, 'index'])->name('dashboard');

//USER
Route::resource('users', UserController::class);

//PRODUCTS
Route::get('products/{user_id}', [ProductController::class, 'getProductsByUser']);
Route::resource('products', ProductController::class);

require __DIR__.'/auth.php';
