<style>
/* ============================
   TRENDING CONTENT GRID
   ============================ */
.trending { background: #0d0e12; padding: 80px 0; }
.trending-tabs { display: flex; gap: 8px; margin-bottom: 36px; flex-wrap: wrap; }
.trending-tab {
    padding: 9px 20px; border-radius: 50px; font-size: 13px; font-weight: 600;
    border: 1px solid rgba(255,255,255,0.1); background: transparent;
    color: #9397a8; cursor: pointer; font-family: 'Inter', sans-serif; transition: all 0.25s;
}
.trending-tab.active, .trending-tab:hover { background: linear-gradient(135deg,#6c63ff,#a855f7); border-color: transparent; color: #fff; }
.media-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
.media-card {
    background: #16181e; border-radius: 16px; overflow: hidden;
    border: 1px solid rgba(255,255,255,0.07); transition: all 0.3s; cursor: pointer;
}
.media-card:hover { transform: translateY(-4px); border-color: rgba(255,255,255,0.15); box-shadow: 0 20px 50px rgba(0,0,0,0.45); }
.media-thumb { position: relative; aspect-ratio: 4/3; overflow: hidden; background: #1e2029; }
.media-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.media-card:hover .media-thumb img { transform: scale(1.06); }
.media-overlay {
    position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
    opacity: 0; transition: opacity 0.3s;
}
.media-card:hover .media-overlay { opacity: 1; }
.media-actions {
    position: absolute; bottom: 10px; right: 10px; display: flex; gap: 8px;
    opacity: 0; transform: translateY(8px); transition: all 0.3s;
}
.media-card:hover .media-actions { opacity: 1; transform: translateY(0); }
.media-action-btn {
    width: 34px; height: 34px; border-radius: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 14px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.2s;
}
.media-action-btn:hover { background: rgba(108,99,255,0.7); border-color: transparent; }
.media-type-badge {
    position: absolute; top: 10px; left: 10px;
    padding: 3px 10px; border-radius: 6px; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.5px; backdrop-filter: blur(8px);
}
.type-photo { background: rgba(108,99,255,0.75); color: #fff; }
.type-video { background: rgba(245,158,11,0.8); color: #000; }
.type-vector { background: rgba(236,72,153,0.75); color: #fff; }
.type-audio { background: rgba(67,233,123,0.75); color: #000; }
.media-watermark { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; }
.media-watermark span { font-size: 13px; font-weight: 800; color: rgba(255,255,255,0.18); letter-spacing: 3px; text-transform: uppercase; transform: rotate(-35deg); user-select: none; }
.media-info { padding: 14px 16px; }
.media-info-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
.media-author { display: flex; align-items: center; gap: 8px; }
.media-author-avatar { width: 26px; height: 26px; border-radius: 50%; object-fit: cover; }
.media-author-name { font-size: 12px; color: #9397a8; font-weight: 500; }
.media-price { font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #43e97b; }
.media-price.free { color: #6c63ff; }
.media-title { font-size: 14px; font-weight: 600; color: #fff; margin-bottom: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.media-meta { display: flex; align-items: center; gap: 14px; font-size: 11px; color: #565b70; }
.media-meta i { margin-right: 4px; }
.trending-footer { text-align: center; margin-top: 44px; }
@media(max-width: 900px) { .media-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 480px) { .media-grid { grid-template-columns: 1fr; } }
</style>

<section class="trending">
    <div class="container">
        <div class="section-header" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;">
            <div>
                <div class="section-label"><i class="fa-solid fa-fire-flame-curved"></i> Trending Now</div>
                <h2 class="section-title">Most Popular Assets</h2>
                <p class="section-subtitle">Curated by our editors – fresh uploads daily.</p>
            </div>
            <div class="trending-tabs">
                <button class="trending-tab active" data-type="all">All</button>
                @foreach($globalCategories->take(4) as $cat)
                <button class="trending-tab" data-type="{{ strtolower($cat->name) }}">{{ $cat->name }}</button>
                @endforeach
                <button class="trending-tab" data-type="free">Free</button>
            </div>
        </div>
        <div class="media-grid">
            @foreach($trendingAssets as $item)
            <a href="{{ route('frontend.assets.show', $item->slug) }}" class="media-card reveal">
                <div class="media-thumb">
                    <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}" loading="lazy">
                    <div class="media-overlay"></div>
                    <span class="media-type-badge type-{{ $item->type }}">{{ $item->type }}</span>
                    @if($item->price === null)
                    <div class="media-watermark"><span>PixelVault</span></div>
                    @endif
                    <div class="media-actions">
                        <button class="media-action-btn" title="Preview"><i class="fa-solid fa-eye"></i></button>
                        <button class="media-action-btn" title="Wishlist"><i class="fa-regular fa-heart"></i></button>
                        <button class="media-action-btn" title="Add to Cart"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
                <div class="media-info">
                    <div class="media-info-top">
                        <div class="media-author">
                            <img class="media-author-avatar" src="https://randomuser.me/api/portraits/men/{{ rand(1, 99) }}.jpg" alt="Author">
                            <span class="media-author-name">Creator</span>
                        </div>
                        <span class="media-price {{ $item->is_free ? 'free' : '' }}">
                            {{ $item->is_free ? 'Free' : '$' . number_format($item->price, 2) }}
                        </span>
                    </div>
                    <div class="media-title">{{ $item->title }}</div>
                    <div class="media-meta">
                        <span><i class="fa-regular fa-heart"></i>{{ number_format($item->likes_count) }}</span>
                        <span><i class="fa-solid fa-download"></i>{{ number_format($item->downloads_count) }}</span>
                        <span><i class="fa-solid fa-star" style="color:#f59e0b;"></i>4.9</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="trending-footer">
            <a href="{{ route('frontend.assets.index') }}" class="btn btn-outline" style="display:inline-flex;align-items:center;gap:8px;padding:13px 28px;border-radius:12px;border:1px solid rgba(255,255,255,0.15);color:#9397a8;font-size:14px;font-weight:600;transition:all 0.2s;font-family:'Inter',sans-serif;">
                View All Assets <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.trending-tab').forEach(function(btn){
    btn.addEventListener('click', function(){
        document.querySelectorAll('.trending-tab').forEach(function(b){ b.classList.remove('active'); });
        this.classList.add('active');
    });
});
</script>
