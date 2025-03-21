<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login'); 
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class);
});
