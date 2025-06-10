<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
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
    StoreHouseController,
    AdminAuthController
};
use App\Http\Controllers\Front\{
    HomeController,
    ShopController,
    AuthController,
    ForgotPasswordController,
    ResetPasswordController
};

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
    });

Route::controller(ShopController::class)
    ->prefix('shop')
    ->group(function () {
        Route::get('/', 'index')->name('shop');
        Route::get('/category/{id}', 'getCategoryProducts');
    });

Route::controller(ProductController::class)
    ->group(function () {
        Route::get('/filter-products-by-category', 'filterByCategory')->name('filter.products.by.category');
        Route::get('/filter-products-by-feature', 'filterFeaturedOrNew')->name('filter.products.type');
        Route::get('/product/show/{product}', 'show')->name('product.show');
    });

Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');

Route::middleware('guest:admin')->group(function () {
    Route::controller(AdminAuthController::class)
        ->group(function () {
            Route::get('/admin/login', 'showLoginForm')->name('loginlogin');
            Route::post('/admin/login', 'login')->name('login.attempt');
        });
});

Route::middleware('guest:web')->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::get('/login', 'showLoginForm')->name('user.login');
            Route::post('/login', 'login')->name('user.login.attempt');
            Route::get('/register', 'showRegisterForm')->name('user.register');
            Route::post('/register', 'register')->name('user.register.attempt');
        });
    Route::controller(ForgotPasswordController::class)
        ->group(function () {
            Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
            Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
        });
    Route::controller(ResetPasswordController::class)
        ->group(function () {
            Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
            Route::post('/reset-password', 'reset')->name('password.update');
        });
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::middleware('auth:admin')->prefix('admin')->as('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::resource('departments', DepartmentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class)->except('show');
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('store-house', StoreHouseController::class);
    Route::delete('images/{image}', [ProductController::class, 'destroyImage'])->name('admin.images.destroy');
    Route::resource('banners', BannerController::class);
});

// Route::resource('orders', OrderController::class);
// Route::resource('order-details', OrderDetailsController::class);
// Route::resource('shipping-addresses', ShippingAddressController::class);
// Route::resource('reviews', ReviewController::class);
// Route::resource('carts', CartController::class);
// Route::resource('settings', SettingController::class);
// Route::resource('order-logs', OrderLogController::class);
