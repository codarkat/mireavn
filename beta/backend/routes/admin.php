<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'backend.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'backend.pages.auth.forgot')->name('forgot-password');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [AdminController::class, 'index'])->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::view('/settings', 'backend.pages.settings')->name('settings');

        Route::prefix('article')->name('article.')->group(function () {

            Route::view('/posts', 'backend.pages.article.posts')->name('posts');
            Route::view('/add-post', 'backend.pages.article.post-add')->name('add-post');
            Route::view('/edit-post', 'backend.pages.article.post-edit')->name('edit-post');

            Route::view('/categories', 'backend.pages.article.categories')->name('categories');
            Route::view('/add-category', 'backend.pages.article.category-add')->name('add-category');
            Route::view('/edit-category', 'backend.pages.article.category-edit')->name('edit-category');

            //Categories
            Route::post('/list-categories', [AdminController::class, 'listCategories'])->name('list-categories');
            Route::post('/get-category-data', [AdminController::class, 'getCategoryData'])->name('get-category-data');
            Route::post('/delete-category', [AdminController::class, 'deleteCategory'])->name('delete-category');
        });
    });
});
