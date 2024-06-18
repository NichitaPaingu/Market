<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeaderLinksController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;



//Admin
Route::middleware(['auth','is_admin'])->group(function(){
    // Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/index', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product:id}/edit', 'edit');
        Route::patch('/products/{product:id}', 'update');
        Route::delete('/products/{product:id}', 'destroy');
    });

    // Categories
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories/index', 'index')->name('categories.index');
        Route::get('/categories/create', 'create');
        Route::post('/categories', 'store');
        Route::get('/categories/{category:id}/edit', 'edit');
        Route::patch('/categories/{category:id}', 'update')->name('categories.update');
        Route::delete('/categories/{category:id}', 'destroy');
    });
    
});

//Home
Route::controller(HomeController::class)->group(function(){
    Route::get('/','index');
});

//HeaderLinks
Route::controller(HeaderLinksController::class)->group(function(){
    Route::get('/pages/best-prices','bestPrices');
    Route::get('/pages/delivery','delivery');
    Route::get('/pages/payment','payment');
    Route::get('/pages/return','return');
    Route::get('/pages/contact','contact');
});

// Auth
Route::controller(SessionController::class)->group(function(){
    Route::get('/login','create')->name('login');
    Route::post('/login','store');
    Route::post('/logout','destroy')->middleware(['auth']);
});

//Login
Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('/register','create');
    Route::post('/register','store');
});

//ContactController
Route::controller(ContactController::class)->group(function(){
    Route::post('/contact/send','send')->name('contact.send');
});


// Products
Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{product:id}', 'show')->name('product.show');
});

// Categories
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/{categories:id}', 'show');
});


//Simple user
Route::middleware(['auth'])->group(function(){
    //User
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/private', [UserController::class, 'show'])->name('user.private');
        Route::get('/user/private/edit', [UserController::class, 'edit'])->name('user.private.edit');
        Route::patch('/user/private', [UserController::class, 'update'])->name('user.private.update');
    });

    //Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    //liked
    Route::controller(FavoriteController::class)->group(function(){
        Route::post('/favorites/{product}','add')->name('favorites.add');
        Route::delete('/favorites/{product}','remove')->name('favorites.remove');
        Route::get('/favorites/index','index')->name('favorites.index');
    });


    // Маршруты для корзины Cort
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart','index')->name('cart.index');
        Route::post('/cart/add/{productId}', 'add')->name('cart.add');
        Route::patch('/cart/update/{itemId}','update')->name('cart.update');
        Route::delete('/cart/remove/{itemId}','remove')->name('cart.remove');
        Route::get('/cart/total','getTotal')->name('cart.total');
    });

    // Маршруты для заказа
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/create','create')->name('order.create');
        Route::post('/order','store')->name('order.store');
        Route::get('/order/{orderId}', 'show')->name('order.show');
        Route::get('/orders/history', 'history')->name('orders.history');
    });

    Route::controller(ReviewController::class)->group(function(){
        Route::post('/reviews/{product:id}','store')->name('reviews.store');
        Route::delete('/reviews/{review:id}','destroy')->name('reviews.destroy');
    });
});


