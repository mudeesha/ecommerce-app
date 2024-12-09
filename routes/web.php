<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\PaymentController;
Route::get('/test', function () {
    return view('test.index');
});

route::get('/',[HomeController::class, 'home']);

Route::prefix('home')->group(function () {
    Route::get('/product', [HomeController::class, 'index']);
    Route::get('/product/{id}', [HomeController::class, 'showProduct']);
});

// Route::post('/order/load', [OrderController::class, 'loadOrder'])->name('order.load');
// Route::post('/order/data', [OrderController::class, 'getOrderData'])->name('order.data');


Route::prefix('cart')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add',[CartController::class, 'store']);
    Route::get('/items', [CartController::class, 'fetch'])->name('cart.items');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');

});

// Route::prefix('order')->middleware(['auth', 'verified'])->group(function () {
//     Route::post('/', [OrderController::class, 'store'])->name('order.store');
//     Route::get('/', [OrderController::class, 'index'])->name('order.index');
//     Route::get('/items', [OrderController::class, 'fetch'])->name('order.items');
//     Route::post('/update', [OrderController::class, 'update'])->name('order.update');
//     Route::post('/remove', [OrderController::class, 'remove'])->name('order.remove');

// });
Route::post('/order/create', [OrderController::class, 'create'])->name('order.create')->middleware(['auth','user']);
Route::get('/order', [OrderController::class, 'index'])->name('order.index')->middleware(['auth','user']);
Route::get('/orders', [OrderController::class, 'orders'])->name('orders.index')->middleware(['auth','user']);

Route::post('/add-card', [PaymentController::class, 'addCard'])->name('add.card')->middleware(['auth','user']);
Route::post('/make-payment', [PaymentController::class, 'makePayment'])->name('make.payment')->middleware(['auth','user']);

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
// route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'admin']);
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
    return view('admin/index');
});

Route::controller(OrderController::class)->group(function(){

    Route::get('stripe', 'stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});

// Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
// Route::post('/order/stripe', [OrderController::class, 'stripePayment'])->name('order.stripe');
// Route::get('/stripe/callback', [OrderController::class, 'stripeCallback'])->name('stripe.callback');

