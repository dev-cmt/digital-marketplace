<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageSeoController;
use App\Http\Controllers\PricingPlanController;
use App\Http\Controllers\DeveloperApiController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\CheckoutController;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/cc', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'Cleared!';
});
Route::get('/sync-permissions', [AdminController::class, 'resyncPermissions'])->name('sync.permissions');


Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/page/frodly', [HomeController::class, 'pageFrodly'])->name('page.frodly'); // Not used
Route::get('/get/frodly', [HomeController::class, 'getFrodly'])->name('get.frodly');

// Static Pages
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/our-creators', [HomeController::class, 'creators'])->name('frontend.creators');
Route::get('/enterprise', [HomeController::class, 'enterprise'])->name('enterprise');

// Asset Listing and Details
Route::get('/marketplace', [\App\Http\Controllers\HomeController::class, 'assetsIndex'])->name('frontend.assets.index');
Route::get('/marketplace/category/{category_slug}', [\App\Http\Controllers\HomeController::class, 'assetsIndex'])->name('frontend.assets.category');
Route::get('/marketplace/{slug}', [\App\Http\Controllers\HomeController::class, 'assetShow'])->name('frontend.assets.show');
Route::get('/marketplace/{slug}/download', [\App\Http\Controllers\AssetController::class, 'download'])->name('frontend.assets.download');

// Admin dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/change-password', [ProfileController::class, 'editPassword'])->name('password.change');
    Route::put('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


// Cart (Open to all)
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/store', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

Route::middleware('auth')->group(function () {
    // Custom Frontend Dashboard/Profile
    Route::get('/my-profile', [\App\Http\Controllers\HomeController::class, 'myProfile'])->name('frontend.profile');

    // Developer API
    Route::get('/developer-api', [DeveloperApiController::class, 'index'])->name('developer-api.index');
    Route::post('/developer-api/generate-token', [DeveloperApiController::class, 'generateToken'])->name('developer-api.generate-token');

    // Wishlist
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');



/**----------------------------------------------------------------------------------------------
     * ----------------------------------------------------------------------------------------------
     * BACKEND TEMPLATE
     * ----------------------------------------------------------------------------------------------
     * ----------------------------------------------------------------------------------------------
     */
    Route::resource('roles', RoleController::class);

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Marketplace Management
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class)->names('categories');
    Route::resource('/assets', \App\Http\Controllers\AssetController::class)->names('assets');
    Route::resource('/creators', \App\Http\Controllers\CreatorController::class)->names('creators');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings-update', [SettingController::class, 'update'])->name('setting.update');

    // SEO settings
    Route::get('/seo-pages',[PageSeoController::class,'index'])->name('settings.seo.index');
    Route::post('/seo-pages/{page}',[PageSeoController::class,'update'])->name('settings.seo.update');
});

require __DIR__.'/auth.php';
