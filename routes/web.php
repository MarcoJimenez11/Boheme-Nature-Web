<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderLineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
    Rutas de Usuarios
*/
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('loginPost');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('userEdit')->middleware(['auth', 'verified']);
Route::put('/user/editName/{user}', [UserController::class, 'editNamePut'])->name('userEditNamePut')->middleware(['auth', 'verified']);
Route::put('/user/editEmail/{user}', [UserController::class, 'editEmailPut'])->name('userEditEmailPut')->middleware(['auth', 'verified']);
Route::put('/user/editPassword/{user}', [UserController::class, 'editPasswordPut'])->name('userEditPasswordPut')->middleware(['auth', 'verified']);
Route::put('/user/editIsAdmin/{user}', [UserController::class, 'editIsAdminPut'])->name('userEditIsAdminPut')->middleware(['auth', 'verified']);
Route::get('/user/list', [UserController::class, 'list'])->name('userList')->middleware(['auth', 'verified']);
Route::delete('/user/delete/{user}', [UserController::class, 'delete'])->name('userDelete')->middleware(['auth', 'verified']);

/*
    Rutas de Confirmación de Registro por Email
*/
//Ruta que indica al usuario que revise su correo para verificar su cuenta
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Ruta a la que irá dirigido el enlace que se envía al correo del usuario
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


//Ruta para reenviar el correo de verificación
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', '¡Enlace de verificación enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
    Rutas de Categorías
*/
Route::get('/categories', [CategoryController::class, 'list'])->name('categoryList')->middleware(['auth', 'verified']);
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categoryCreate')->middleware(['auth', 'verified']);
Route::post('/categories/create', [CategoryController::class, 'createPost'])->name('categoryCreatePost')->middleware(['auth', 'verified']);
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categoryEdit')->middleware(['auth', 'verified']);
Route::put('/categories/edit/{category}', [CategoryController::class, 'editPut'])->name('categoryEditPut')->middleware(['auth', 'verified']);
Route::delete('/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categoryDelete')->middleware(['auth', 'verified']);

/*
    Rutas de Productos
*/
Route::get('/products', [ProductController::class, 'list'])->name('productList')->middleware(['auth', 'verified']);
Route::get('/products/create', [ProductController::class, 'create'])->name('productCreate')->middleware(['auth', 'verified']);
Route::post('/products/create', [ProductController::class, 'createPost'])->name('productCreatePost')->middleware(['auth', 'verified']);
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('productEdit')->middleware(['auth', 'verified']);
Route::put('/products/edit/{product}', [ProductController::class, 'editPut'])->name('productEditPut')->middleware(['auth', 'verified']);
Route::delete('/products/delete/{product}', [ProductController::class, 'delete'])->name('productDelete')->middleware(['auth', 'verified']);
Route::get('/products/{category}', [ProductController::class, 'listByCategory'])->name('productListByCategory');

/*
    Rutas de Carrito
*/
Route::get('/cart', [CartController::class, 'list'])->name('cartList');
Route::get('/cart/add/{product}', [CartController::class, 'addItem'])->name('cartAdd');
Route::delete('/cart/delete/{item}', [CartController::class, 'deleteItem'])->name('cartItemDelete');
Route::put('/cart/change/{item}/{amount}', [CartController::class, 'changeAmountItem'])->name('changeAmountItem');
Route::delete('/cart/delete/', [CartController::class, 'deleteAll'])->name('cartDeleteAll');

/*
    Rutas de Pedidos
*/
Route::get('/orders', [OrderController::class, 'list'])->name('orderList');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orderCreate');
Route::post('/orders/create', [OrderController::class, 'createPost'])->name('orderCreatePost');

/*
    Rutas de Lineas de Pedido
*/
Route::get('/order/lines/{order}', [OrderLineController::class, 'list'])->name('orderLineList');