<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

//category
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth','admin']);
Route::get('/get_categories', [AdminController::class, 'getCategories'])->name('categories.index')->middleware(['auth','admin']);
Route::post('add_category', [AdminController::class, 'addCategory'])->name('add_category')->middleware(['auth', 'admin']);
route::delete('delete_category/{id}', [AdminController::class, 'deleteCategory'])->middleware(['auth','admin']);
Route::get('/get_category/{id}', [AdminController::class, 'get_category'])->middleware(['auth','admin']);;
Route::patch('/update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth','admin']);

//product
Route::get('view_product', [AdminController::class, 'viewProduct'])->middleware(['auth','admin']);
Route::get('/get_products', [AdminController::class, 'getProducts'])->name('products.index')->middleware(['auth','admin']);
Route::post('add_product', [AdminController::class, 'addProduct'])->name('add_product')->middleware(['auth', 'admin']);
route::delete('delete_product/{id}', [AdminController::class, 'deleteProduct'])->middleware(['auth','admin']);
Route::get('/get_product/{id}', [AdminController::class, 'getProduct'])->middleware(['auth','admin']);;
Route::patch('/update_product/{id}', [AdminController::class, 'updateProduct'])->middleware(['auth','admin']);

