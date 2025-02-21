<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/products', [ProductController::class, 'list'])->name('productList');
Route::get('/products/create', [ProductController::class, 'create'])->name('productCreate');
Route::post('/products/create', [ProductController::class, 'createPost'])->name('productCreatePost');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('productEdit');
Route::put('/products/edit/{product}', [ProductController::class, 'editPut'])->name('productEditPut');
Route::delete('/products/delete/{product}', [ProductController::class, 'delete'])->name('productDelete');
Route::get('/products/{category}', [ProductController::class, 'listByCategory'])->name('productListByCategory');

Route::get('/cart', [CartController::class, 'list'])->name('cartList');
Route::get('/cart/add/{product}', [CartController::class, 'addItem'])->name('cartAdd');
Route::delete('/cart/delete/{item}', [CartController::class, 'deleteItem'])->name('cartItemDelete');
Route::put('/cart/change/{item}/{amount}', [CartController::class, 'changeAmountItem'])->name('changeAmountItem');
Route::delete('/cart/delete/', [CartController::class, 'deleteAll'])->name('cartDeleteAll');
Route::get('/orders', [OrderController::class, 'list'])->name('orderList');