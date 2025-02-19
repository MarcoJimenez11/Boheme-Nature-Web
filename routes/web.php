<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'loginPost'])->name('loginPost');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/shop', function () {
    return "Tienda";
})->name('shop');