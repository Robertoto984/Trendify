<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{
    CartController,
    OrderController,
    BannerController,
    ReviewController,
    ProductController,
    SettingController,
    CategoryController,
    OrderLogController,
    DepartmentController,
    ColorController,
    OrderDetailsController,
    ShippingAddressController,
    SizeController,
    StoreHouseController
};
use App\Http\Controllers\Front\ShopController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(ShopController::class)
    ->prefix('shop')
    ->group(function () {
        Route::get('/', 'index')->name('shop');
        Route::get('/category/{id}', 'getCategoryProducts');
    });
Route::get('/filter-products', [ProductController::class, 'filterByCategory'])->name('filter.products.by.category');

Route::prefix('admin')->as('admin.')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::resource('departments', DepartmentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('store-house', StoreHouseController::class);
    Route::delete('images/{image}', [ProductController::class, 'destroyImage'])->name('admin.images.destroy');
});

Route::resource('orders', OrderController::class);
Route::resource('order-details', OrderDetailsController::class);
Route::resource('shipping-addresses', ShippingAddressController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('carts', CartController::class);
Route::resource('banners', BannerController::class);
Route::resource('settings', SettingController::class);
Route::resource('order-logs', OrderLogController::class);
