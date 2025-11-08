<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\indexController;
use App\Http\Controllers\Admin\Main\AdminIndexController;

Route::get('/', indexController::class);

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', AdminIndexController::class);
});
