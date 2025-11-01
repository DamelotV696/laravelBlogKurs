<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\IndexController;

Route::get('/', IndexController::class);

Auth::routes();
