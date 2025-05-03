<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderLogController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ShippingAddressController;

Route::get('/', function () {
    return view('welcome');
});

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
Route::resource('order_logs', OrderLogController::class);
