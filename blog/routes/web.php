<?php

use App\Http\Controllers\Personal\Main\IndexPersonalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\AdminIndexController;
use App\Http\Controllers\Personal\Comment\DeleteCommentController;
use App\Http\Controllers\Personal\Comment\EditCommentController;
use App\Http\Controllers\Personal\Comment\IndexCommentController;
use App\Http\Controllers\Personal\Comment\UpdateCommentController;
use App\Http\Controllers\Personal\Liked\DeleteLikedController;
use App\Http\Controllers\Personal\Liked\IndexLikedController;

Route::get('/', IndexController::class)->name('main.index');

Auth::routes(['verify' => true]);

Route::prefix('personal')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', IndexPersonalController::class)->name('personal.main.index');
    Route::get('/liked', IndexLikedController::class)->name('personal.liked.index');
    Route::delete('/{post}', DeleteLikedController::class)->name('personal.delete.like');

    Route::prefix('comment')->namespace('App\\Http\\Controllers\\Personal\\Comment')->group(function () {
        Route::get('/', 'IndexController')->name('personal.comment.index');
        Route::get('/{comment}/edit', 'EditController')->name('personal.comment.edit');
        Route::match(['put', 'patch'], '/{comment}', 'UpdateController')->name('personal.update.comment');
        Route::delete('/{comment}', 'DeleteController')->name('personal.delete.comment');
    });
});



Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/', AdminIndexController::class)->name('admin.main.index');
    // Посты
    Route::prefix('posts')->namespace('App\\Http\\Controllers\\Admin\\Post')->group(function () {
        Route::get('/', 'IndexController')->name('admin.post.index');
        Route::get('/create', 'CreateController')->name('admin.post.create');
        Route::post('/', 'StoreController')->name('admin.post.store');
        Route::get('/{post}', 'ShowController')->name('admin.post.show');
        Route::get('/{post}/edit', 'EditController')->name('admin.post.edit');
        Route::match(['put', 'patch'], '/{post}', 'UpdateController')->name('admin.post.update');
        Route::delete('/{post}', 'DeleteController')->name('admin.post.delete');
    });

    // Категории
    Route::prefix('categories')->namespace('App\\Http\\Controllers\\Admin\\Category')->group(function () {
        Route::get('/', 'CategoryIndexController')->name('admin.category.index');
        Route::get('/create', 'CreateController')->name('admin.category.create');
        Route::post('/', 'StoreController')->name('admin.category.store');
        Route::get('/{category}', 'ShowController')->name('admin.category.show');
        Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
        Route::match(['put', 'patch'], '/{category}', 'UpdateController')->name('admin.category.update');
        Route::delete('/{category}', 'DeleteController')->name('admin.category.delete');
    });

    // Теги
    Route::prefix('tags')->namespace('App\\Http\\Controllers\\Admin\\Tag')->group(function () {
        Route::get('/', 'IndexController')->name('admin.tag.index');
        Route::get('/create', 'CreateController')->name('admin.tag.create');
        Route::post('/', 'StoreController')->name('admin.tag.store');
        Route::get('/{tag}', 'ShowController')->name('admin.tag.show');
        Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
        Route::match(['put', 'patch'], '/{tag}', 'UpdateController')->name('admin.tag.update');
        Route::delete('/{tag}', 'DeleteController')->name('admin.tag.delete');
    });

    // Пользователи
    Route::prefix('users')->namespace('App\\Http\\Controllers\\Admin\\User')->group(function () {
        Route::get('/', 'IndexController')->name('admin.user.index');
        Route::get('/create', 'CreateController')->name('admin.user.create');
        Route::post('/', 'StoreController')->name('admin.user.store');
        Route::get('/{user}', 'ShowController')->name('admin.user.show');
        Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
        Route::match(['put', 'patch'], '/{user}', 'UpdateController')->name('admin.user.update');
        Route::delete('/{user}', 'DeleteController')->name('admin.user.delete');
    });
});
