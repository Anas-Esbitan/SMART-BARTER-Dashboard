<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubscriptionController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories Routes
    Route::get('category', [CategoriesController::class, 'index']);
    Route::get('add-category', [CategoriesController::class, 'create']);
    Route::post('add-category', [CategoriesController::class, 'store']);     Route::get('edit-category/{category_id}', [CategoriesController::class, 'edit']); 
    Route::put('update-category/{category_id}', [CategoriesController::class, 'update']);
    Route::delete('delete-category/{category_id}', [CategoriesController::class, 'destroy'])->name('category.destroy') ; 

    // Users CRUD Routes
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('add-user', [UserController::class, 'create'])->name('admin.add-user');
    Route::post('store-user', [UserController::class, 'store'])->name('admin.store-user');
    Route::get('edit-user/{user_id}', [UserController::class, 'edit'])->name('admin.edit-user');
    Route::put('update-user/{user_id}', [UserController::class, 'update'])->name('admin.update-user');
    Route::delete('delete-user/{user_id}', [UserController::class, 'destroy'])->name('admin.delete-user');

    // Product CRUD 
    Route::get('products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('add-product', [ProductController::class, 'create'])->name('admin.create-product');
    Route::post('store-product', [ProductController::class, 'store'])->name('admin.store-product'); 
    Route::get('edit-product/{product_id}', [ProductController::class, 'edit'])->name('admin.edit-product'); 
    Route::put('update-product/{product_id}', [ProductController::class, 'update'])->name('admin.update-product');
    Route::delete('delete-product/{product_id}', [ProductController::class, 'destroy'])->name('admin.delete-product');

    // orders CRUD =========================================================
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

    Route::get('orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('admin.orders.store');

    Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');


    Route::resource('subscriptions', SubscriptionController::class)->middleware(['auth', 'isAdmin']);

});
