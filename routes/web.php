<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Frontend\FrontController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontController::class,'index']);
Route::get('category',[FrontController::class,'categories']);
Route::get('category/{slug}',[FrontController::class,'category']);
Route::get('category/{cat_slug}/{prd_slug}',[FrontController::class,'viewproduct']);
Route::post('add-to-cart',[CartController::class,'addToCart']);
Route::post('d_cartItem',[CartController::class,'Delete_cartItem']);
Route::post('update_cartQty',[CartController::class,'update_cart']);
Route::get('load-cart-data',[CartController::class,'cart_count']);
Route::get('product-list',[FrontController::class,'productlistajax']);

// wishlist

Route::post('add-to-wishlist',[WishlistController::class,'add']);
Route::post('d_wishItem',[WishlistController::class,'delete']);
Route::get('load-wishlist-data',[WishlistController::class,'wishlist_count']);

Route::middleware(['auth'])->group(function(){
   Route::get('cart',[CartController::class,'cart']);
   Route::get('checkout',[CheckoutController::class,'index']);
   Route::post('place-order',[CheckoutController::class,'placeorder']);
   Route::post('proceed-to-pay',[CheckoutController::class,'razorapay']);


   Route::get('my-order',[UserController::class,'index']);
   Route::get('view_order/{id}',[UserController::class,'view']);

    //    wishlist
    Route::get('wishlist',[WishlistController::class,'index']);

    //  rating
    Route::post('add-rating',[RatingController::class,'add']);

    // review
    Route::get('add-review/{slug}/user-review',[ReviewController::class,'add']);
    Route::post('add-review',[ReviewController::class,'create']);
    Route::get('edit-review/{slug}/user-review',[ReviewController::class,'edit']);
    Route::put('update-review/',[ReviewController::class,'update']);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[FrontendController::class,'index'])->name('dashbord');
    Route::get('categories',[CategoryController::class,'index'])->name('category');
    Route::get('add-category',[CategoryController::class,'add'])->name('add-category');
    Route::post('insert-category',[CategoryController::class,'insert'])->name('insert-category');
    Route::get('edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}',[CategoryController::class,'update']);
    Route::get('delete-category/{id}',[CategoryController::class,'Delete']);

    // Product
    Route::get('products',[ProductController::class,'index']);
    Route::get('add-product',[ProductController::class,'add']);
    Route::post('insert-product',[ProductController::class,'insert']);
    Route::get('edit-product/{id}',[ProductController::class,'edit']);
    Route::put('update-product/{id}',[ProductController::class,'update']);
    Route::get('delete-product/{id}',[ProductController::class,'delete']);

    // users
    Route::get('users',[DashboardController::class,'index']);
    Route::get('view-user/{id}',[DashboardController::class,'view']);

    // orders
    Route::get('orders',[OrderController::class,'index']);
    Route::get('admin/view_order/{id}',[OrderController::class,'view']);
    Route::put('update-order/{id}',[OrderController::class,'update']);
    Route::get('order-history',[OrderController::class,'order_history']);
    
});
