<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\HomeController;


use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('auth_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'auth_register'])->name('auth_register');
//backend
Route::middleware(['admin_auth'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'admin_index'])->name('admin_index');


    
    Route::get('/user', [AdminUserController::class, 'infor_user'])->name('admin_user');
    Route::get('/user/search', [AdminUserController::class, 'search'])->name('admin.user.search');




    Route::prefix('category')->group(function () {
        Route::get('/add_category', [CategoryController::class, 'add_category'])->name('add_category');
        Route::post('/add_category', [CategoryController::class, 'save_category'])->name('save_category');
        Route::get('/', [CategoryController::class, 'all_category'])->name('category');
        Route::get('/search', [CategoryController::class, 'search'])->name('category.search');
        Route::get('/edit/{id}', [CategoryController::class, 'edit_category'])->name('edit_category');
        Route::get('/update/{id}', [CategoryController::class, 'update_category'])->name('update_category');
        Route::post('/update/{id}', [CategoryController::class, 'update_category'])->name('update_category');
        Route::get('/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
        Route::post('/destroy/{id}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
    });

    Route::prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, 'add_product'])->name('add_product');
        Route::post('/save', [ProductController::class, 'save_product'])->name('save_product');
        Route::get('/', [ProductController::class, 'product_list'])->name('product');
        Route::get('/search', [ProductController::class, 'search'])->name('product.search');
        Route::get('/edit/{id}', [ProductController::class, 'edit_product'])->name('edit_product');
        Route::post('/update/{id}', [ProductController::class, 'update_product'])->name('update_product');
        Route::put('/update/{id}', [ProductController::class, 'update_product'])->name('update_product');
        Route::get('/delete/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
    });
});
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'admin_authlogin'])->name('admin_authlogin');
    Route::get('/logout', [AdminController::class, 'admin_logout'])->name('admin_logout');
    Route::post('/logout', [AdminController::class, 'admin_logout'])->name('admin_logout');
});
