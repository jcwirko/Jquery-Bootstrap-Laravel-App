<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/home', function() {
    return view('layouts.admin');
});

Route::middleware(['auth'])->group(function() {
    Route::get('panel-administrativo', [HomeController::class, 'index'])->name('dashboard');

    Route::get('roles/grid', [RoleController::class, 'getGrid'])->name('roles.grid');
    Route::post('roles/grid', [RoleController::class, 'storeGrid'])->name('roles.grid.store');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    //USER
    Route::resource('users', UserController::class);

    //PRODUCTS
    Route::get('products/{user_id}', [ProductController::class, 'getProductsByUser']);
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
