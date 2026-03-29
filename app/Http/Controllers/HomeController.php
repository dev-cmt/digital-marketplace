<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\SeoTrait;
use App\Models\Page;


class HomeController extends Controller
{
    use SeoTrait;

    public function welcome()
    {
        // SEO
        $page = Page::with('seo')->where('slug','home')->firstOrFail();
        $this->setSeo([
            'title'       => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords'    => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image'       => $page->seo->og_image ?? '',
            'canonical'   => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
        ]);

        $categories = \App\Models\Category::where('is_active', true)->orderBy('order')->get();
        $trendingAssets = \App\Models\Asset::with('category')->active()->trending()->take(8)->get();
        $featuredAssets = \App\Models\Asset::with('category')->active()->take(4)->get(); // For hero visual or elsewhere

        // Fetch top 4 creators by asset counts and total downloads
        $topCreators = \App\Models\User::has('assets')
            ->withCount('assets')
            ->withSum('assets', 'downloads_count')
            ->orderByDesc('assets_count')
            ->take(4)
            ->get();

        return view('frontend.welcome', compact('seotags', 'breadcrumbs', 'categories', 'trendingAssets', 'featuredAssets', 'topCreators'));
    }

    public function assetsIndex(Request $request, $category_slug = null)
    {
        $query = \App\Models\Asset::with('category')->active();

        // Category Filter
        if ($category_slug) {
            $category = \App\Models\Category::where('slug', $category_slug)->firstOrFail();
            $query->where('category_id', $category->id);
        } elseif ($request->has('category') && $request->category != '') {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
                $category_slug = $category->slug;
            }
        }

        // Type Filter (Multi-select)
        if ($request->has('type')) {
            $types = array_filter((array) $request->type); // Remove empty values like '' or null
            if (count($types) > 0) {
                $query->whereIn('type', $types);
            }
        }

        // Price Filter (Modern Range + Manual fallback)
        if ($request->has('price_range') && $request->price_range != '' && $request->price_range != 'all') {
            $range = explode('-', $request->price_range);
            if (count($range) == 2) {
                $query->whereBetween('price', [(int)$range[0], (int)$range[1]]);
            } elseif (str_ends_with($request->price_range, '+')) {
                $min = (int)str_replace('+', '', $request->price_range);
                $query->where('price', '>=', $min);
            }
        } else {
            if ($request->has('min_price') && $request->min_price != '') {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price') && $request->max_price != '') {
                $query->where('price', '<=', $request->max_price);
            }
        }

        // Resolution Filter (Multi-select)
        if ($request->has('resolution')) {
            $resolutions = array_filter((array) $request->resolution);
            if (count($resolutions) > 0) {
                $query->whereIn('resolution', $resolutions);
            }
        }

        // License Filter
        if ($request->has('license') && $request->license != 'all') {
            $query->where('license', $request->license);
        }

        // Free Filter
        if ($request->has('free')) {
            $query->where('is_free', true);
        }

        // Search Filter
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'popular':
                    $query->orderBy('downloads_count', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $assets = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::where('is_active', true)
            ->withCount(['assets' => function($q) {
                $q->active();
            }])
            ->orderBy('order')
            ->get();
        
        return view('frontend.assets.index', compact('assets', 'category_slug', 'categories'));
    }

    public function assetShow($slug)
    {
        $asset = \App\Models\Asset::with('category')->where('slug', $slug)->active()->firstOrFail();
        
        $relatedAssets = \App\Models\Asset::where('category_id', $asset->category_id)
            ->where('id', '!=', $asset->id)
            ->active()
            ->take(4)
            ->get();

        return view('frontend.assets.show', compact('asset', 'relatedAssets'));
    }

    public function pricing()
    {
        return view('frontend.pricing');
    }

    public function creators()
    {
        $topCreators = \App\Models\User::has('assets')
            ->withCount('assets')
            ->withSum('assets', 'downloads_count')
            ->orderByDesc('assets_count')
            ->take(12) // Show more on the dedicated page
            ->get();

        return view('frontend.creators', compact('topCreators'));
    }

    public function enterprise()
    {
        return view('frontend.enterprise');
    }

    public function myProfile()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->with('items.asset')
            ->latest()
            ->get();
            
        return view('frontend.profile.index', compact('user', 'orders'));
    }
}
