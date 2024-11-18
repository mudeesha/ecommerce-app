<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\CartController;

Route::prefix('home')->group(function () {
    route::get('/',[HomeController::class, 'home']);
    Route::get('/product', [HomeController::class, 'index']);
    Route::get('/product/{id}', [HomeController::class, 'showProduct']);
});

Route::prefix('cart')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Load cart page
    Route::post('/add',[CartController::class, 'store']);
    Route::get('/items', [CartController::class, 'fetch'])->name('cart.items'); // Fetch cart items via AJAX
    Route::post('/update', [CartController::class, 'update'])->name('cart.update'); // Update cart item
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove'); // Remove cart item

});

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
    // Category Routes
    Route::prefix('category')->group(function () {
        Route::get('view', [AdminCategoryController::class, 'returnView']);
        Route::get('/', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('add_category');
        Route::delete('{id}', [AdminCategoryController::class, 'destroy']);
        Route::get('{id}', [AdminCategoryController::class, 'show']);
        Route::patch('{id}', [AdminCategoryController::class, 'update']);
    });

    // Product Routes
    Route::prefix('product')->group(function () {
        Route::get('view', [AdminProductController::class, 'returnView']);
        Route::get('/', [AdminProductController::class, 'index'])->name('products.index');
        Route::post('/', [AdminProductController::class, 'store'])->name('add_product');
        Route::delete('{id}', [AdminProductController::class, 'destroy']);
        Route::get('{id}', [AdminProductController::class, 'show']);
        Route::patch('{id}', [AdminProductController::class, 'update']);
    });
});


Route::get('/abc', function () {
    return view('cart/index');
});
