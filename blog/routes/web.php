<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\AdminIndexController;

Route::get('/', IndexController::class);

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', AdminIndexController::class);

    // Категории
    Route::prefix('categories')->namespace('App\\Http\\Controllers\\Admin\\Category')->group(function () {
        Route::get('/', 'CategoryIndexController')->name('admin.category.index');
        Route::get('/create', 'CreateController')->name('admin.category.create');
        Route::post('/', 'StoreController')->name('admin.category.store');
        Route::get('/{category}', 'ShowController')->name('admin.category.show');
        Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
        Route::delete('/{category}', 'DeleteController')->name('admin.category.delete');
    });

    // Теги
    Route::prefix('tags')->namespace('App\\Http\\Controllers\\Admin\\Tag')->group(function () {
        Route::get('/', 'IndexController')->name('admin.tag.index');
        Route::get('/create', 'CreateController')->name('admin.tag.create');
        Route::post('/', 'StoreController')->name('admin.tag.store');
        Route::get('/{tag}', 'ShowController')->name('admin.tag.show');
        Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
        Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
    });
});
