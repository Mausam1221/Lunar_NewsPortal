<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// Public routes
// Route::middleware(['admin:0'])->group(function () {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
// });
Route::get('/news/{id}', [HomeController::class, 'show'])->name('news.show');
// routes/web.php
Route::get('/category/{id}', [HomeController::class, 'categoryNews'])->name('category.show');

Route::get('/', [HomeController::class, 'index'])->name('home');
// Admin routes - require authentication and admin role
Route::middleware(['auth', 'admin:1'])->group(function () {
    // admin dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // News management

    Route::get('/admin/news/create', [NewsController::class, 'index'])->name('admin.create');
    Route::post('/admin/news/store', [NewsController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [NewsController::class, 'edit'])->name('admin.edit');
    Route::post('update/{id}', [NewsController::class, 'update'])->name('admin.update');
    Route::delete('delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::patch('toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('admin.toggle-status');

    // Categories
    Route::get('/admin/category/index', [CategoriesController::class, 'categories'])->name('categories.index');
    Route::get('/admin/category/add-category', [CategoriesController::class, 'addCategory'])->name('admin.category.create');
    Route::post('/admin/categories/store', [CategoriesController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'editCategory'])->name('admin.category.edit');
    Route::put('/categories/update/{id}', [CategoriesController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('admin.category.destroy');

    //User management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    //Settings
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');
});

require __DIR__.'/auth.php';