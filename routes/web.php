<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CartController,
    OrderController,
    BannerController,
    ReviewController,
    ProductController,
    SettingController,
    CategoryController,
    OrderLogController,
    DepartmentController,
    OrderDetailsController,
    ShippingAddressController
};


Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('departments', DepartmentController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('order-details', OrderDetailsController::class);
Route::resource('shipping-addresses', ShippingAddressController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('carts', CartController::class);
Route::resource('banners', BannerController::class);
Route::resource('settings', SettingController::class);
Route::resource('order-logs', OrderLogController::class);
