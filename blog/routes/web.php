<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Стартовая страница
Route::get('/', function () {
    return view('welcome');
});

// Автоматические маршруты авторизации (login, register, logout, password reset)
Auth::routes();

// Главная страница после логина
Route::get('/home', [HomeController::class, 'index'])->name('home');
