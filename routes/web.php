<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\AdminController;

route::get('/',[HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//admin
route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//admin.category
    Route::get('category/view', [AdminCategoryController::class, 'returnView'])->middleware(['auth','admin']);
    Route::get('category', [AdminCategoryController::class, 'index'])->name('categories.index')->middleware(['auth','admin']);
    Route::post('category', [AdminCategoryController::class, 'store'])->name('add_category')->middleware(['auth', 'admin']);
    route::delete('category/{id}', [AdminCategoryController::class, 'destroy'])->middleware(['auth','admin']);
    Route::get('/category/{id}', [AdminCategoryController::class, 'show'])->middleware(['auth','admin']);;
    Route::patch('/category/{id}', [AdminCategoryController::class, 'update'])->middleware(['auth','admin']);

//product
    Route::get('product/view', [AdminProductController::class, 'returnView'])->middleware(['auth','admin']);
    Route::get('product', [AdminProductController::class, 'index'])->name('products.index')->middleware(['auth','admin']);
    Route::post('product', [AdminProductController::class, 'store'])->name('add_product')->middleware(['auth', 'admin']);
    route::delete('product/{id}', [AdminProductController::class, 'destroy'])->middleware(['auth','admin']);
    Route::get('product/{id}', [AdminProductController::class, 'show'])->middleware(['auth','admin']);;
    Route::patch('product/{id}', [AdminProductController::class, 'update'])->middleware(['auth','admin']);
});
