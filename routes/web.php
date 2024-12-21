<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\Admin\ProductController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubscriptionController;
Route::get('/about', function () {
    return view('userside.about');
})->name('about');
//ddddddddddddddddddd
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.dashboard');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
//dddddddddddddddddddddddddd
// مسار عرض صفحة إضافة المنتج (فورم)
Route::middleware('auth')->get('/product/create', [ProductController::class, 'create'])->name('product.create');



//=======================================================
 Route::middleware(['auth', 'user'])->get('user-profile', [UserProfileController::class, 'showProfile'])->name('user.profile');
 // Route لعرض صفحة التعديل
Route::middleware(['auth', 'user'])->get('user-profile/edit', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');

// Route لتحديث بيانات الملف الشخصي
Route::middleware(['auth', 'user'])->put('user-profile/update', [UserProfileController::class, 'updateProfile'])->name('user.profile.update');
Route::get('product/{id}', [UserProfileController::class, 'show'])->name('product.show');
 //===================================================================
Route::get('/', [PublicProductController::class, 'index'])->name('/');

Route::get('/product/{id}', [UserProductController::class, 'show'])->name('products.show');
//=================================================
Route::get('/product/{id}', function ($id) {
    $product = Product::with('images')->findOrFail($id); 
    return view('userside.product-details', compact('product'));
})->name('product.details');

Route::get('/user-chart', [MainController::class, 'chart']);

Auth::routes();
 // Dashboard Route
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

   
 Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories Routes
    Route::get('category', [CategoriesController::class, 'index']);
    Route::get('add-category', [CategoriesController::class, 'create']);
    Route::post('add-category', [CategoriesController::class, 'store']);    
    Route::get('edit-category/{category_id}', [CategoriesController::class, 'edit']); 
    Route::put('update-category/{category_id}', [CategoriesController::class, 'update']);
    Route::delete('delete-category/{category_id}', [CategoriesController::class, 'destroy'])->name('category.destroy') ; 

    // Users CRUD Routes
    //
 


    //
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