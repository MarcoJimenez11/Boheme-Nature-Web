<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'loginPost'])->name('loginPost');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/categories', [CategoryController::class, 'list'])->name('categoryList');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categoryCreate');

Route::post('/categories/create', [CategoryController::class, 'createPost'])->name('categoryCreatePost');

Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categoryEdit');

Route::put('/categories/edit/{category}', [CategoryController::class, 'editPut'])->name('categoryEditPut');

Route::delete('/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categoryDelete');

Route::get('/shop', function () {
    return "Tienda";
})->name('shop');