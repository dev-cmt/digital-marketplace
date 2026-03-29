<x-frontend-layout :title="'Browse ' . ($category_slug ?? 'Assets')">

<style>
/* ============================
   SHORIFART RESPONSIVE PERFECTION
   ============================ */
:root {
    --gallery-gap: 24px;
    --card-radius: 16px;
}

body { background: #0a0b10; }

.listing-wrapper { padding-bottom: 120px; }

/* 1. Optimized Hero */
.gallery-hero {
    padding: 100px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
    background: radial-gradient(circle at 50% -20%, rgba(108,99,255,0.12) 0%, transparent 60%);
}
.hero-title {
    font-family: 'Outfit', sans-serif;
    font-size: clamp(30px, 5vw, 64px);
    font-weight: 900;
    color: #fff;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}
.hero-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.5);
    max-width: 600px;
    margin: 0 auto 32px;
}

/* Big Search Bar */
.big-search-wrap {
    max-width: 680px;
    margin: 0 auto;
    position: relative;
    display: flex;
    align-items: center;
}
.big-search-icon {
    position: absolute; left: 24px; color: rgba(255,255,255,0.3); font-size: 18px;
}
.big-search-input {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.12);
    backdrop-filter: blur(20px);
    border-radius: 100px;
    padding: 20px 35px 20px 55px;
    font-size: 16px;
    color: #fff;
    transition: all 0.3s;
    outline: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}
.big-search-input:focus { border-color: var(--accent-1); background: rgba(255,255,255,0.08); }

.big-search-btn {
    position: absolute; right: 10px; top: 8px; bottom: 8px;
    background: var(--accent-gradient); border: none; border-radius: 50px;
    padding: 0 28px; color: #fff; font-weight: 700; cursor: pointer;
    transition: 0.2s;
}

/* 2. Robust Category Mosaic Tiles */
.category-mosaic {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 180px;
    gap: 16px;
    margin-bottom: 80px;
}
.mosaic-card {
    position: relative; border-radius: 20px; overflow: hidden;
    text-decoration: none; background: #16181e;
    border: 1px solid rgba(255,255,255,0.05);
}
.mosaic-main { grid-column: span 2; grid-row: span 2; }
.mosaic-img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.8s; filter: brightness(0.8);
}
.mosaic-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,11,16,0.9) 0%, transparent 60%);
    display: flex; align-items: flex-end; padding: 24px;
}
.mosaic-title { color: #fff; font-size: 18px; font-weight: 800; font-family: 'Outfit'; }

/* 3. Borderless Gallery Grid */
.borderless-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;
    justify-content: center;
}
.asset-card-wrap { position: relative; border-radius: 16px; overflow: hidden; background: #111318; }
.asset-card-media { position: relative; aspect-ratio: 4/3; }
.asset-card-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
.asset-card-wrap:hover .asset-card-media img { transform: scale(1.1); }

.asset-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.6) 20%, transparent 60%);
    opacity: 0; transition: opacity 0.4s;
    display: flex; flex-direction: column; justify-content: flex-end; padding: 20px;
}
.asset-card-wrap:hover .asset-card-overlay { opacity: 1; }

.floating-meta { 
    position: absolute; top: 15px; right: 15px; display: flex; flex-direction: column; gap: 10px; 
    transform: translateX(15px); opacity: 0; transition: all 0.4s; 
}
.asset-card-wrap:hover .floating-meta { transform: translateX(0); opacity: 1; }
.float-btn {
    width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.12);
    backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center;
    color: #fff; border: 1px solid rgba(255,255,255,0.25); transition: 0.25s;
}
.float-btn:hover { background: #fff; color: #000; transform: scale(1.15); }

/* 4. Filter Controls (Responsive perfected) */
.gallery-controls {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 40px; gap: 15px;
}
.filter-btn-trigger {
    height: 48px; display: flex; align-items: center; gap: 10px;
    background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px;
    padding: 0 26px; color: #fff; font-weight: 600; font-size: 14px; cursor: pointer; transition: 0.3s;
}
.filter-btn-trigger:hover { background: var(--accent-gradient); border-color: transparent; }

.unified-pill {
    height: 48px; display: flex; align-items: center;
    background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.12); border-radius: 50px;
    padding: 0 4px 0 20px; backdrop-filter: blur(10px);
}
.pill-count {
    font-family: 'Outfit'; font-size: 12px; font-weight: 800; text-transform: uppercase;
    color: rgba(255,255,255,0.5); border-right: 1px solid rgba(255,255,255,0.1);
    padding-right: 15px; margin-right: 15px; letter-spacing: 1px;
}
.pill-count b { color: #fff; }
.asset-price { color: var(--accent-3); font-family: 'Outfit'; font-weight: 800; font-size: 17px; }

/* 4. PREMIUM FILTER SIDEBAR V5 (NO SCROLL CLUTTER) */
.filter-sidebar {
    position: fixed; top: 15px; right: -420px; 
    width: 400px; max-width: 90%; height: calc(100vh - 30px);
    background: rgba(10, 11, 16, 0.96);
    backdrop-filter: blur(60px) saturate(220%);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 30px 0 0 30px;
    padding: 0; z-index: 10001;
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden; 
    box-shadow: -40px 0 100px rgba(0,0,0,0.9);
    display: flex; flex-direction: column;
}

/* Staggered Content Animation */
.filter-section { 
    opacity: 0; transform: translateY(15px); 
    transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
    margin-bottom: 25px; 
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.filter-sidebar.active { right: 0; }
.filter-sidebar.active .filter-section { opacity: 1; transform: translateY(0); }
.filter-sidebar.active .filter-section:nth-child(1) { transition-delay: 0.1s; }
.filter-sidebar.active .filter-section:nth-child(2) { transition-delay: 0.15s; }
.filter-sidebar.active .filter-section:nth-child(3) { transition-delay: 0.2s; }
.filter-sidebar.active .filter-section:nth-child(4) { transition-delay: 0.25s; }
.filter-sidebar.active .filter-section:nth-child(5) { transition-delay: 0.3s; }

.filter-sidebar-inner {
    padding: 60px 0 45px;
    overflow-y: auto;
    flex: 1;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
}
.filter-sidebar-inner::-webkit-scrollbar { display: none; } /* Hide Scrollbar (Chrome/Safari) */

/* Scrollable Horizontal Row for Categories */
.horizontal-scroll-row {
    display: flex; gap: 10px; overflow-x: auto; 
    padding: 0 35px 15px; margin: 0 -35px;
    scrollbar-width: none;
}
.horizontal-scroll-row::-webkit-scrollbar { display: none; }

.sidebar-padding { padding: 0 35px; }

@media(max-width: 600px) {
    .filter-sidebar {
        top: 0; right: -100%; width: 100%; max-width: 100%; height: 100vh;
        border-radius: 0;
    }
    .filter-sidebar.active { right: 0; }
    .filter-sidebar-inner { padding: 80px 0 40px; }
    .sidebar-padding { padding: 0 25px; }
    .horizontal-scroll-row { padding: 0 25px 15px; margin: 0 -25px; }
}

.filter-overlay {
    position: fixed; inset: 0; background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(10px); z-index: 10000;
    opacity: 0; visibility: hidden; transition: all 0.5s ease;
}
.filter-overlay.active { opacity: 1; visibility: visible; }

.sidebar-close {
    position: absolute; top: 25px; right: 25px; 
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
    color: #fff; display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1.5); z-index: 10;
}
.sidebar-close:hover { background: #6c63ff; border-color: #6c63ff; transform: rotate(180deg) scale(1.1); }

.filter-section:last-child { border-bottom: none; }

.filter-title { 
    font-size: 10px; font-weight: 900; color: #6c63ff; 
    text-transform: uppercase; letter-spacing: 3px; margin-bottom: 20px; 
    display: flex; align-items: center; gap: 10px;
}
.filter-title::after { content: ""; flex: 1; height: 1px; background: linear-gradient(to right, rgba(108,99,255,0.15), transparent); }

/* Compact Two-Column Formats/Resolutions */
.grid-2-col { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }

.btn-check:checked + .btn-outline {
    background: var(--accent-gradient) !important;
    border-color: transparent !important;
    background: var(--accent-1);
    border-color: var(--accent-1);
    color: #fff;
    box-shadow: 0 0 25px rgba(108, 99, 255, 0.4);
    transform: translateY(-2px);
}

.btn-outline {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.7);
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 14px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(5px);
}
.btn-outline:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.3);
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
}

.price-input-bar {
    background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 18px; padding: 6px; display: flex; align-items: center;
}
.price-input-bar:focus-within {
    border-color: var(--accent-1) !important;
    box-shadow: 0 0 20px rgba(108, 99, 255, 0.2) !important;
    transform: scale(1.02);
}

.filter-title {
    font-size: 11px;
    font-weight: 800;
    color: rgba(255, 255, 255, 0.4);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.filter-title i {
    font-size: 14px;
    color: var(--accent-1);
    opacity: 0.6;
}
.sidebar-header h3 {
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.15);
}

/* Gallery Controls */
.gallery-controls {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 40px; gap: 15px;
}

/* ============================
   RESPONSIVE OVERRIDES
   ============================ */

@media(max-width: 1200px) { .borderless-grid { grid-template-columns: repeat(3, 1fr); } }

@media(max-width: 900px) {
    .borderless-grid { grid-template-columns: repeat(2, 1fr); }
    .category-mosaic { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 150px; }
    .mosaic-main { grid-column: span 2; grid-row: span 1; }
}

@media(max-width: 600px) {
    .gallery-controls { flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .filter-btn-trigger, .unified-pill { flex: 1 1 calc(50% - 10px); min-width: 140px; }
    .pill-count { display: none; } /* Hide count label to fit sort dropdown on extra small */
    .unified-pill { padding-left: 15px; }
    
    .category-mosaic { grid-template-columns: 1fr; grid-auto-rows: 200px; margin-bottom: 40px; }
    .mosaic-main { grid-column: span 1; grid-row: span 1; }
    
    .gallery-hero { padding: 80px 0 40px; }
}

@media(max-width: 450px) {
    .borderless-grid { grid-template-columns: 1fr; }
    .filter-btn-trigger, .unified-pill { flex: 1 1 100%; }
}

.reveal-item { opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.2, 1, 0.3, 1); }
.reveal-item.active { opacity: 1; transform: translateY(0); }
</style>

<div class="gallery-hero">
    <div class="container">
        <h1 class="hero-title reveal-item">High Quality Assets<br>For Professionals</h1>
        <p class="hero-subtitle reveal-item">Unlock your creative potential with billions of professional assets from the world's leading creators.</p>
        
        <form action="{{ route('frontend.assets.index') }}" method="GET" class="big-search-wrap reveal-item">
            <i class="fa-solid fa-magnifying-glass big-search-icon"></i>
            <input type="text" name="search" value="{{ request('search') }}" class="big-search-input" placeholder="Search curated collections...">
            <button type="submit" class="big-search-btn">Search</button>
        </form>
    </div>
</div>

<div class="container px-3">
    <div class="listing-wrapper">
        
        <!-- Responsive Category Mosaic -->
        @if(!request('search') && !request('category') && !$category_slug)
        <div class="category-mosaic reveal-item">
            @php $cats = $categories->take(5); @endphp
            @if(count($cats) > 0)
                <a href="{{ route('frontend.assets.category', $cats[0]->slug) }}" class="mosaic-card mosaic-main" style="background: #1e2029;">
                    <img src="https://images.unsplash.com/photo-1493612276216-ee3925520721?auto=format&fit=crop&w=1000&q=80" class="mosaic-img" alt="{{ $cats[0]->name }}">
                    <div class="mosaic-overlay"><span class="mosaic-title">{{ $cats[0]->name }}</span></div>
                </a>
            @endif
            @foreach($cats->skip(1) as $index => $cat)
                @php 
                    $fallbacks = [
                        'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1452421822248-d4c2b47f0c81?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=500&q=80'
                    ];
                @endphp
                <a href="{{ route('frontend.assets.category', $cat->slug) }}" class="mosaic-card">
                    <img src="{{ $fallbacks[$index % 4] }}" class="mosaic-img" alt="{{ $cat->name }}">
                    <div class="mosaic-overlay"><span class="mosaic-title">{{ $cat->name }}</span></div>
                </a>
            @endforeach
        </div>
        @endif

        <!-- Perfected Gallery Controls -->
        <div class="gallery-controls">
            <button class="filter-btn-trigger" onclick="toggleSidebar()">
                <i class="fa-solid fa-sliders"></i> Filter & Refine
            </button>
            
            <div class="unified-pill">
                <span class="pill-count">
                    <b>{{ $assets->total() }}</b> Assets
                </span>
                
                <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center flex-fill">
                    @foreach(request()->except('sort', 'page') as $k => $v)
                        @if(is_array($v))
                            @foreach($v as $i => $item) <input type="hidden" name="{{ $k }}[]" value="{{ $item }}"> @endforeach
                        @else
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endif
                    @endforeach
                    <select name="sort" class="form-select form-select-sm" 
                            style="background: transparent; color: #fff; border: none; padding: 0 30px 0 10px; font-weight: 700; cursor: pointer; font-size: 13px; box-shadow: none; outline: none;" 
                            onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Releases</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Borderless Gallery Grid -->
        <div class="borderless-grid">
            @forelse($assets as $asset)
            <div class="reveal-item">
                <div class="asset-card-wrap">
                    <a href="{{ route('frontend.assets.show', $asset->slug) }}" class="asset-card-media">
                        <img src="{{ asset($asset->thumbnail) }}" alt="{{ $asset->title }}">
                        <div class="asset-card-overlay">
                            <div class="asset-title-row">
                                <div class="w-100">
                                    <div class="asset-title">{{ $asset->title }}</div>
                                    <div class="fs-12 text-white-50">{{ ucfirst($asset->type) }} &#8226; {{ $asset->resolution ?? 'High Res' }}</div>
                                </div>
                                <div class="asset-price">{{ $asset->is_free ? 'Free' : '$'.number_format($asset->price) }}</div>
                            </div>
                        </div>
                    </a>
                    <div class="floating-meta">
                        <button class="float-btn" onclick="toggleWishlist(event, {{ $asset->id }}, this)" title="Wishlist">
                            <i class="{{ in_array($asset->id, $userWishlistIds ?? []) ? 'fa-solid' : 'fa-regular' }} fa-heart" style="{{ in_array($asset->id, $userWishlistIds ?? []) ? 'color: #ec4899;' : '' }}"></i>
                        </button>
                        <button class="float-btn" onclick="openPreview('{{ asset($asset->preview_url ?? $asset->thumbnail) }}', '{{ $asset->type }}')" title="Quick Preview">
                            <i class="fa-solid fa-expand"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5 w-100 reveal-item" style="grid-column: 1/-1; padding: 100px 0 !important;">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 24px; padding: 60px 40px; max-width: 500px; margin: 0 auto; backdrop-filter: blur(10px);">
                    <div style="width: 80px; height: 80px; background: rgba(108, 99, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <i class="fa-solid fa-cloud-moon" style="font-size: 32px; color: var(--accent-1); opacity: 0.8;"></i>
                    </div>
                    <h3 style="color: #fff; font-family: 'Outfit'; font-weight: 800; margin-bottom: 12px;">No Assets Found</h3>
                    <p style="color: rgba(255,255,255,0.5); font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                        Adjust your filters or resetting results to start over.
                    </p>
                    <a href="{{ url()->current() }}" class="btn btn-primary px-5 py-3" style="border-radius: 50px; font-weight: 700;">
                        <i class="fa-solid fa-rotate-left me-2"></i> Reset All Filters
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <div class="pagination-wrap mt-5">
            {{ $assets->links() }}
        </div>
    </div>
</div>

<!-- Drawer Sidebar -->
<div class="filter-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
<aside class="filter-sidebar" id="sidebarDrawer">
    <button class="sidebar-close" onclick="toggleSidebar()"><i class="fa-solid fa-xmark"></i></button>
    
    <div class="filter-sidebar-inner">
        <div class="sidebar-header mb-5 sidebar-padding">
            <h3 class="text-white fw-900 mb-1" style="font-family: 'Outfit'; letter-spacing: -0.5px; text-shadow: 0 0 30px rgba(108, 99, 255, 0.2);">Advanced Filters</h3>
            <p class="fs-14" style="color: rgba(255,255,255,0.4);">Refine your studio search results</p>
        </div>

        <form action="{{ url()->current() }}" method="GET" id="filterForm">
            {{-- Global Persistence Loop: Ensures sort, search, etc. aren't lost when toggling filters --}}
            @foreach(request()->except(['type', 'resolution', 'min_price', 'max_price', 'free', 'category', 'page']) as $k => $v)
                @if(is_array($v))
                    @foreach($v as $i => $item) <input type="hidden" name="{{ $k }}[]" value="{{ $item }}"> @endforeach
                @else
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endif
            @endforeach
            
            {{-- Category and Search are especially critical for the query to maintain context --}}
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

            <!-- 1. Collections (Horizontal Scroll) -->
            <div class="filter-section">
                <div class="sidebar-padding">
                    <h5 class="filter-title"><i class="fa-solid fa-layer-group"></i> Collections</h5>
                </div>
                <div class="horizontal-scroll-row">
                    <a href="{{ request()->fullUrlWithQuery(['category' => null, 'page' => null]) }}" class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline' }}">All Assets</a>
                    @foreach($categories as $cat)
                    <a href="{{ request()->fullUrlWithQuery(['category' => $cat->slug, 'page' => null]) }}" class="btn btn-sm {{ (request('category') == $cat->slug || $category_slug == $cat->slug) ? 'btn-primary' : 'btn-outline' }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            <!-- 2. Format (2-Col Grid) -->
            <div class="filter-section sidebar-padding">
                <h5 class="filter-title"><i class="fa-solid fa-shapes"></i> Asset Format</h5>
                <div class="grid-2-col">
                    @php 
                        $formats = [
                            'all' => ['All', 'fa-grip-vertical'],
                            'photo' => ['Photos', 'fa-camera'],
                            'video' => ['Videos', 'fa-play-circle'],
                            'audio' => ['Audio', 'fa-microphone-lines'],
                            'vector' => ['Vectors', 'fa-pen-nib'],
                            '3d' => ['3D Assets', 'fa-cube'],
                            'templates' => ['Templates', 'fa-layer-group']
                        ];
                    @endphp
                    @foreach($formats as $val => $info)
                    <div>
                        <input type="radio" name="type" value="{{ $val == 'all' ? '' : $val }}" id="type_{{ $val }}" class="btn-check" {{ (request('type') == $val || (!request('type') && $val == 'all')) ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="btn btn-outline btn-sm w-100 d-flex align-items-center justify-content-center gap-2" for="type_{{ $val }}" style="border-radius:14px; padding: 12px; font-weight: 700;">
                            <i class="fa-solid {{ $info[1] }} fs-14 opacity-50"></i> {{ $info[0] }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 3. Resolution (2-Col Grid) -->
            <div class="filter-section sidebar-padding">
                <h5 class="filter-title"><i class="fa-solid fa-expand"></i> Resolution</h5>
                <div class="grid-2-col">
                    @foreach(['4K UHD', '8K UHD', 'Full HD', 'High Res', 'Vignette'] as $res)
                    <div>
                        <input type="radio" name="resolution" value="{{ $res }}" id="res_{{ Str::slug($res) }}" class="btn-check" {{ request('resolution') == $res ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="btn btn-outline btn-sm w-100" for="res_{{ Str::slug($res) }}" style="border-radius:50px; font-size:11px; padding: 10px; font-weight: 700;">
                            <span class="d-flex align-items-center justify-content-center gap-2">
                                @if(Str::contains($res, 'K')) <i class="fa-solid fa-bolt-lightning text-warning fs-10"></i> @else <i class="fa-solid fa-expand fs-10 opacity-50"></i> @endif
                                {{ $res }}
                            </span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. Price Constraints (Studio Style) -->
            <div class="filter-section sidebar-padding">
                <h5 class="filter-title"><i class="fa-solid fa-tag"></i> Price Constraints</h5>
                <div class="price-input-bar" style="background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 5px; display: flex; align-items: center; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control btn-sm" placeholder="Min" style="background:transparent; border:none; color:#fff; text-align:center; font-weight:700; font-size: 13px; box-shadow: none;">
                    <div style="width: 1px; height: 20px; background: rgba(255,255,255,0.15); margin: 0 5px;"></div>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control btn-sm" placeholder="Max" style="background:transparent; border:none; color:#fff; text-align:center; font-weight:700; font-size: 13px; box-shadow: none;">
                    <button type="submit" class="btn btn-primary btn-sm ms-auto" style="border-radius:14px; padding: 10px 18px; font-weight: 800; font-size: 11px;">APPLY</button>
                </div>
            </div>

            <div class="sidebar-padding mb-4">
                <div class="form-check form-switch d-flex align-items-center justify-content-between p-0" style="background: rgba(108, 99, 255, 0.05); border-radius: 16px; padding: 16px 20px !important; border: 1px solid rgba(108, 99, 255, 0.1);">
                    <label class="form-check-label text-white fw-700 fs-14" for="frSw" style="cursor:pointer;">Free Assets Only</label>
                    <input class="form-check-input mt-0" type="checkbox" name="free" id="frSw" {{ request('free') ? 'checked' : '' }} onchange="this.form.submit()" style="cursor:pointer; width: 44px; height: 22px;">
                </div>

                <a href="{{ url()->current() }}" class="btn btn-link text-danger btn-sm w-100 mt-4 fw-bold" style="text-decoration:none;">
                    <i class="fa-solid fa-rotate-left me-2"></i> Reset all filters
                </a>
            </div>
        </form>
    </div>
</aside>

<script>
function toggleSidebar() {
    const drawer = document.getElementById('sidebarDrawer');
    const overlay = document.getElementById('sidebarOverlay');
    drawer.classList.toggle('active');
    overlay.classList.toggle('active');
    document.body.style.overflow = drawer.classList.contains('active') ? 'hidden' : '';
}

document.addEventListener('DOMContentLoaded', () => {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, index * 60);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-item').forEach(el => revealObserver.observe(el));
});
</script>

</x-frontend-layout>
