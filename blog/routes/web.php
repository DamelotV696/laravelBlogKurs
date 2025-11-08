<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\indexController;
use App\Http\Controllers\Admin\Main\AdminIndexController;
use App\Http\Controllers\Admin\Category\CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateIndexController;
use App\Models\Category;

Route::get('/', indexController::class);

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', AdminIndexController::class);
    Route::prefix('categories')->group(callback: function () {
        Route::get('/', CategoryIndexController::class)->name('admin.category.index');
        Route::get('/create', CreateIndexController::class)->name('admin.category.create');
    });
});
