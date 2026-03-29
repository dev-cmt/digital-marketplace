<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;
use App\Models\Wishlist;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.pixelvault');

        // Share global data for authenticated/guest users
        View::composer('*', function ($view) {
            $userWishlistIds = [];
            if (Auth::check()) {
                $userWishlistIds = Wishlist::where('user_id', Auth::id())->pluck('asset_id')->toArray();
            }
            $view->with('userWishlistIds', $userWishlistIds);
            
            $cartId = null;
            if (Auth::check()) {
                $cartId = Auth::id();
            } elseif (Session::has('cart_token')) {
                $cartId = Session::get('cart_token');
            }
            $cartBadgeCount = $cartId ? app('cart')->session($cartId)->getTotalQuantity() : 0;
            $view->with('cartBadgeCount', $cartBadgeCount);
        });

        $settings = Setting::first() ?? null;
        View::share('settings', $settings);

        // Global Categories for Navbar/Menus
        $globalCategories = Category::where('is_active', true)->orderBy('order')->get();
        View::share('globalCategories', $globalCategories);
    }
}
