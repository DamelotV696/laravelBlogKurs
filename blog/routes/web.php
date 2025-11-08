<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\indexController;
use App\Http\Controllers\Admin\Main\AdminIndexController;
use App\Http\Controllers\Admin\Category\CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController;
use App\Http\Controllers\Admin\Category\StoreController;
use App\Http\Controllers\Admin\Category\ShowController;
use App\Http\Controllers\Admin\Category\EditController;
use App\Models\Category;

Route::get('/', indexController::class);

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', AdminIndexController::class);
    Route::prefix('categories')->group(callback: function () {
        Route::get('/', CategoryIndexController::class)->name('admin.category.index');
        Route::get('/create', CreateController::class)->name('admin.category.create');
        Route::post('/', StoreController::class)->name('admin.category.store');
        Route::get('/{category}', ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', EditController::class)->name('admin.category.edit');
    });
});
