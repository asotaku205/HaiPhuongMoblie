<?php

use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Middleware\AdminAuth;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('auth_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'auth_register'])->name('auth_register');
//backend
Route::middleware(['admin_auth'])->prefix('admin')->group(function () {
    
    Route::get('/', [AdminController::class, 'admin_index'])->name('admin_index');
    
    Route::get('/add_category', [CategoryController::class, 'add_category'])->name('add_category');
    Route::post('/add_category', [CategoryController::class, 'save_category'])->name('save_category');
    Route::get('/category', [CategoryController::class, 'all_category'])->name('category');
    Route::get('/user', [AdminUserController::class, 'infor_user'])->name('admin_user');
});
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'admin_authlogin'])->name('admin_authlogin');
    Route::get('/logout', [AdminController::class, 'admin_logout'])->name('admin_logout');
    Route::post('/logout', [AdminController::class, 'admin_logout'])->name('admin_logout');
    
});