<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'index']);

Route::get('/shop', function () {
    return "Tienda";
})->name('shop');