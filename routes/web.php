<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect('login');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::match(['get', 'post'], '/orders/create', [OrderController::class, 'create']);
    Route::match(['get', 'post',], '/books/create', [BookController::class, 'create']);
    Route::match(['get', 'post'], '/users/create', [UserController::class, 'create']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/books/{id}/edit', [BookController::class, 'edit']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
});

// Siswa routes
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard']);
    Route::match(['get', 'post'], '/order/create', [SiswaController::class, 'createOrder']);
    Route::get('/history', [SiswaController::class, 'history']);
    Route::get('/return', [SiswaController::class, 'returnBook']);
    Route::post('/return/{id}', [SiswaController::class, 'processReturn'])->name('siswa.return.process');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');

