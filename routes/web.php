<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/orders/{order}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
});


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'dashboard'])->name('admin.index');
    Route::post('/orders{order}/update', [OrderController::class, 'update'])->name('admin.update');
    Route::post('/orders/{order}/destroy', [OrderController::class, 'destroy'])->name('admin.destroy');
});