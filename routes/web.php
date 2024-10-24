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

//admin.category
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('category/view', [AdminController::class, 'viewCategories'])->middleware(['auth','admin']);
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index')->middleware(['auth','admin']);
    Route::post('category', [AdminCategoryController::class, 'store'])->name('add_category')->middleware(['auth', 'admin']);
    route::delete('category/{id}', [AdminCategoryController::class, 'destroy'])->middleware(['auth','admin']);
    Route::get('/category/{id}', [AdminCategoryController::class, 'show'])->middleware(['auth','admin']);;
    Route::patch('/category/{id}', [AdminCategoryController::class, 'update'])->middleware(['auth','admin']);
});

//product
Route::get('view_product', [AdminProcuctController::class, 'viewProduct'])->middleware(['auth','admin']);
Route::get('/get_products', [AdminProcuctController::class, 'getProducts'])->name('products.index')->middleware(['auth','admin']);
Route::post('add_product', [AdminProcuctController::class, 'addProduct'])->name('add_product')->middleware(['auth', 'admin']);
route::delete('delete_product/{id}', [AdminProcuctController::class, 'deleteProduct'])->middleware(['auth','admin']);
Route::get('/get_product/{id}', [AdminProcuctController::class, 'getProduct'])->middleware(['auth','admin']);;
Route::patch('/update_product/{id}', [AdminProcuctController::class, 'updateProduct'])->middleware(['auth','admin']);

