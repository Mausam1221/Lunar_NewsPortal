<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Route::resource('news', NewsController::class,);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin Routes

Route::middleware(['auth'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/news/create', [NewsController::class, 'index'])->name('admin.create');
    Route::post('/admin/news/store', [NewsController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [NewsController::class, 'edit'])->name('admin.edit');
    Route::post('update/{id}', [NewsController::class, 'update'])->name('admin.update');
    Route::delete('delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});
// Route::get('/admin/dashboard', function () {
//     $user = auth()->user();
//     if($user && $user->is_admin){
//         return view('admin.dashboard');
//     } else {
//         abort(403, 'Unauthorized');
//     }
// })->middleware('auth');




// Categories
Route::get('/admin/category/index', [CategoriesController::class, 'categories'])->name('categories.index');
Route::get('/admin/category/add-category', [CategoriesController::class, 'addCategory'])->name('admin.category.create');
Route::post('/admin/categories/store', [CategoriesController::class, 'storeCategory'])->name('admin.categories.store');
// Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
// Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoriesController::class, 'editCategory'])->name('admin.category.edit');
Route::put('/categories/update/{id}', [CategoriesController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('/categories/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('admin.category.destroy');



// Users management
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});







require __DIR__.'/auth.php';
