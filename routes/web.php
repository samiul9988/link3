<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [App\Http\Controllers\Frontend\CategoryController::class, 'show'])->name('category');
Route::get('/brand/{slug}', [App\Http\Controllers\Frontend\BrandController::class, 'show'])->name('brand');
Route::get('/product/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product');
Route::get('/products', [App\Http\Controllers\Frontend\ProductController::class, 'listing'])->name('products.listing');
Route::get('/search', [App\Http\Controllers\Frontend\SearchController::class, 'index'])->name('search');
Route::get('/search/ajax', [App\Http\Controllers\Frontend\SearchController::class, 'ajaxSearch'])->name('search.ajax');

// Cart
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/coupon', [App\Http\Controllers\Frontend\CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::post('/cart/coupon/remove', [App\Http\Controllers\Frontend\CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

// Checkout
Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout')->middleware('auth:customer');
Route::post('/checkout/place-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order/success/{order}', [App\Http\Controllers\Frontend\CheckoutController::class, 'success'])->name('order.success');

// Customer Routes
Route::middleware('auth:customer')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Frontend\CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [App\Http\Controllers\Frontend\CustomerController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\Frontend\CustomerController::class, 'orderDetail'])->name('order.detail');
    Route::post('/orders/{order}/cancel', [App\Http\Controllers\Frontend\CustomerController::class, 'cancelOrder'])->name('order.cancel');
    Route::get('/wishlist', [App\Http\Controllers\Frontend\CustomerController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/toggle', [App\Http\Controllers\Frontend\CustomerController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::get('/profile', [App\Http\Controllers\Frontend\CustomerController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [App\Http\Controllers\Frontend\CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/addresses', [App\Http\Controllers\Frontend\CustomerController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [App\Http\Controllers\Frontend\CustomerController::class, 'storeAddress'])->name('address.store');
    Route::put('/addresses/{address}', [App\Http\Controllers\Frontend\CustomerController::class, 'updateAddress'])->name('address.update');
    Route::delete('/addresses/{address}', [App\Http\Controllers\Frontend\CustomerController::class, 'deleteAddress'])->name('address.delete');
    Route::post('/change-password', [App\Http\Controllers\Frontend\CustomerController::class, 'changePassword'])->name('password.change');
    Route::post('/review', [App\Http\Controllers\Frontend\CustomerController::class, 'submitReview'])->name('review.submit');
});

// Auth Routes
Route::get('/login', [App\Http\Controllers\Frontend\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\Frontend\AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [App\Http\Controllers\Frontend\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\Frontend\AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [App\Http\Controllers\Frontend\AuthController::class, 'showForgot'])->name('forgot.password');
Route::post('/forgot-password', [App\Http\Controllers\Frontend\AuthController::class, 'sendResetLink'])->name('forgot.password.submit');
Route::get('/reset-password/{token}', [App\Http\Controllers\Frontend\AuthController::class, 'showReset'])->name('reset.password');
Route::post('/reset-password', [App\Http\Controllers\Frontend\AuthController::class, 'resetPassword'])->name('reset.password.submit');

// Social Login
Route::get('/auth/google', [App\Http\Controllers\Frontend\AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Frontend\AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [App\Http\Controllers\Frontend\AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [App\Http\Controllers\Frontend\AuthController::class, 'handleFacebookCallback']);

// Misc
Route::get('/page/{slug}', [App\Http\Controllers\Frontend\PageController::class, 'show'])->name('page');
Route::post('/newsletter', [App\Http\Controllers\Frontend\NewsletterController::class, 'subscribe'])->name('newsletter');
Route::post('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'submit'])->name('contact');
Route::get('/sitemap.xml', [App\Http\Controllers\Frontend\SitemapController::class, 'index']);

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
        Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
        Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class);
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

        Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::post('orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('orders/{order}/payment-status', [App\Http\Controllers\Admin\OrderController::class, 'updatePaymentStatus'])->name('orders.payment');
        Route::get('orders/{order}/invoice', [App\Http\Controllers\Admin\OrderController::class, 'invoice'])->name('orders.invoice');

        Route::get('customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
        Route::get('customers/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
        Route::post('customers/{customer}/status', [App\Http\Controllers\Admin\CustomerController::class, 'toggleStatus'])->name('customers.status');

        Route::get('reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
        Route::post('reviews/{review}/status', [App\Http\Controllers\Admin\ReviewController::class, 'toggleStatus'])->name('reviews.status');
        Route::delete('reviews/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::get('messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('subscribers', [App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('subscribers/export', [App\Http\Controllers\Admin\SubscriberController::class, 'export'])->name('subscribers.export');

        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
        Route::post('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('profile.password');

        Route::post('cache/clear', [App\Http\Controllers\Admin\CacheController::class, 'clear'])->name('cache.clear');
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    });
});
