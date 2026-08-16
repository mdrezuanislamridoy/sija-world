<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes - Miswan Fashion Application (Direct Order Mode)
|--------------------------------------------------------------------------
*/

// --- Frontend & Catalog Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/product-category/{category}/{subcategory?}', [ProductController::class, 'category'])->name('category.show');
Route::get('/product/{slug}/{id?}', [ProductController::class, 'show'])->name('product.show');

// --- Cart & Direct Checkout Routes ---
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/shipping-cost', [CheckoutController::class, 'getShippingCost'])->name('checkout.shipping');
Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.order');
Route::get('/order-success/{order_number}', [CheckoutController::class, 'orderSuccess'])->name('order.success');

// --- Wishlist & Static Page Routes ---
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// --- Track Order Routes ---
Route::get('/track-order', [\App\Http\Controllers\OrderTrackController::class, 'index'])->name('track.order');
Route::post('/track-order', [\App\Http\Controllers\OrderTrackController::class, 'track'])->name('track.order.post');

// --- Redirect Legacy Auth Slugs to Home ---
Route::get('/login', function () { return redirect()->route('home'); })->name('login');
Route::get('/register', function () { return redirect()->route('home'); })->name('register');

// --- Admin Panel Routes (Protected Admin Auth & RBAC) ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Redirect /admin to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Admin Authentication Routes
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Dashboard & Management Area
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Products CRUD (Permission: manage_products)
        Route::middleware(['admin.permission:manage_products'])->group(function () {
            Route::resource('products', AdminProductController::class);
        });

        // Orders Management (Permission: manage_orders)
        Route::middleware(['admin.permission:manage_orders'])->group(function () {
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
            Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
            Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
        });

        // Categories Management (Permission: manage_categories)
        Route::middleware(['admin.permission:manage_categories'])->group(function () {
            Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
            Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
            Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
            Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
        });

        // Sliders & Banners (Permission: manage_sliders)
        Route::middleware(['admin.permission:manage_sliders'])->group(function () {
            Route::get('/sliders', [AdminSliderController::class, 'index'])->name('sliders.index');
            Route::post('/sliders', [AdminSliderController::class, 'storeSlider'])->name('sliders.store');
            Route::delete('/sliders/{id}', [AdminSliderController::class, 'destroySlider'])->name('sliders.destroy');
            Route::post('/banners', [AdminSliderController::class, 'storeBanner'])->name('banners.store');
            Route::delete('/banners/{id}', [AdminSliderController::class, 'destroyBanner'])->name('banners.destroy');
        });

        // General Settings (Permission: manage_settings)
        Route::middleware(['admin.permission:manage_settings'])->group(function () {
            Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
        });

        // Admin Staff & Page Permission Management (Permission: manage_admins)
        Route::middleware(['admin.permission:manage_admins'])->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
            Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
            Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        });
    });
});
