<x-frontend-layout :title="$asset->title">

<style>
/* ============================
   ASSET DETAILS PAGE
   ============================ */
.details-wrap { padding: 120px 0 80px; }
.details-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }

.preview-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); overflow: hidden; position: relative;
}
.preview-img { width: 100%; height: auto; display: block; min-height: 400px; object-fit: cover; }
.preview-actions {
    position: absolute; bottom: 20px; right: 20px;
    display: flex; gap: 12px;
}

.details-content { padding: 32px 0; }
.details-title { font-family: var(--font-heading); font-size: 36px; font-weight: 800; color: #fff; margin-bottom: 12px; }
.details-cat { font-size: 14px; font-weight: 600; color: var(--accent-1); text-transform: uppercase; margin-bottom: 24px; display: block; }
.details-desc { color: var(--text-secondary); font-size: 16px; line-height: 1.8; margin-bottom: 40px; }

.sidebar-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 32px; position: sticky; top: 100px;
}
.price-tag {
    font-size: 42px; font-weight: 800; font-family: var(--font-heading);
    color: #fff; margin-bottom: 8px; display: block;
}
.price-tag.free { color: var(--accent-1); }
.license-text { font-size: 13px; color: var(--text-muted); margin-bottom: 32px; display: block; }

.meta-info {
    display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px;
}
.meta-item {
    background: rgba(255,255,255,0.03); padding: 16px; border-radius: 12px;
    text-align: center; border: 1px solid rgba(255,255,255,0.05);
}
.meta-val { display: block; font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 4px; }
.meta-lbl { display: block; font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 600; }

.related-section { padding: 80px 0; border-top: 1px solid var(--border-color); }

@media(max-width: 1000px) {
    .details-wrap { padding: 90px 0 40px; }
    .details-layout { grid-template-columns: 1fr; gap: 30px; text-align: center; }
    .sidebar-card { position: static; padding: 24px; }
    .details-title { font-size: 28px; }
    .preview-img { min-height: 300px; }
    .details-content { display: flex; flex-direction: column; align-items: center; }
}

@media(max-width: 600px) {
    .meta-info { grid-template-columns: 1fr; }
    .price-tag { font-size: 32px; }
    .related-grid { grid-template-columns: 1fr !important; }
}
</style>

<div class="details-wrap">
    <div class="container">
        <div class="details-layout">
            <!-- Left Side: Preview & Content -->
            <div>
                <div class="preview-card">
                    @if(in_array($asset->type, ['video']))
                        <video class="preview-img" style="background: #000;" controls controlsList="nodownload" preload="metadata">
                            <source src="{{ asset($asset->preview_url ?? $asset->thumbnail) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif(in_array($asset->type, ['audio']))
                        <img class="preview-img" src="{{ asset($asset->thumbnail) }}" alt="{{ $asset->title }}" style="opacity: 0.3;">
                        <audio controls controlsList="nodownload" style="width: 100%; position: absolute; top: 50%; left: 0; padding: 0 40px; transform: translateY(-50%);">
                            <source src="{{ asset($asset->preview_url) }}" type="audio/mpeg">
                        </audio>
                    @else
                        <img class="preview-img" src="{{ asset($asset->preview_url ?? $asset->thumbnail) }}" alt="{{ $asset->title }}">
                    @endif
                    <div class="preview-actions">
                        <button class="btn btn-outline btn-sm" 
                                style="background: rgba(0,0,0,0.5); backdrop-filter: blur(8px);"
                                onclick="openPreview('{{ asset($asset->preview_url ?? $asset->thumbnail) }}', '{{ $asset->type }}')">
                            <i class="fa-solid fa-expand"></i> Preview
                        </button>
                    </div>
                </div>

                <div class="details-content">
                    <span class="details-cat">{{ $asset->category->name }}</span>
                    <h1 class="details-title">{{ $asset->title }}</h1>
                    <div class="details-desc">
                        {{ $asset->description }}
                    </div>

                    <div style="display:flex; gap:20px; align-items:center;">
                        <button class="btn btn-outline" style="gap:10px;" onclick="toggleWishlist(event, {{ $asset->id }}, this)">
                            <i class="{{ in_array($asset->id, $userWishlistIds ?? []) ? 'fa-solid' : 'fa-regular' }} fa-heart" style="{{ in_array($asset->id, $userWishlistIds ?? []) ? 'color: #ec4899;' : '' }}"></i> Add to Wishlist
                        </button>
                        <button class="btn btn-outline" style="gap:10px;" onclick="shareAsset('{{ $asset->title }}')">
                            <i class="fa-solid fa-share-nodes"></i> Share Asset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side: Purchase Sidebar -->
            <div class="details-sidebar">
                <div class="sidebar-card">
                    <span class="price-tag {{ $asset->is_free ? 'free' : '' }}">
                        {{ $asset->is_free ? 'Free' : '$' . number_format($asset->price, 2) }}
                    </span>
                    <span class="license-text">{{ $asset->license }}</span>

                    <div class="meta-info">
                        <div class="meta-item">
                            <span class="meta-val">{{ ucfirst($asset->type) }}</span>
                            <span class="meta-lbl">Type</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-val">{{ $asset->resolution ?? 'High Res' }}</span>
                            <span class="meta-lbl">Resolution</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-val" id="downloads_count">{{ number_format($asset->downloads_count) }}</span>
                            <span class="meta-lbl">Downloads</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-val">{{ number_format($asset->likes_count) }}</span>
                            <span class="meta-lbl">Likes</span>
                        </div>
                    </div>

                    @if($asset->is_free)
                    <a href="{{ route('frontend.assets.download', $asset->slug) }}" 
                       class="btn btn-primary" 
                       style="width:100%; justify-content:center; padding: 18px; font-size:16px;">
                        <i class="fa-solid fa-download"></i> Download Now
                    </a>
                    @else
                    <button class="btn btn-primary" style="width:100%; justify-content:center; padding: 18px; font-size:16px;" onclick="addToCart(event, {{ $asset->id }}, this)">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                    @endif
                    
                    <div style="margin-top:24px; text-align:center;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" style="height:20px; opacity:0.6; margin:0 8px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" style="height:15px; opacity:0.6; margin:0 8px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" style="height:20px; opacity:0.6; margin:0 8px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Assets -->
<section class="related-section">
    <div class="container text-center">
        <h2 class="section-title" style="margin-bottom:40px; justify-content:center;">Related Assets</h2>
        
        <div class="asset-grid related-grid" style="display:grid; grid-template-columns: repeat(4, 1fr); gap:24px;">
            @foreach($relatedAssets as $rel)
            <a href="{{ route('frontend.assets.show', $rel->slug) }}" class="media-card">
                <div class="media-thumb">
                    <img src="{{ $rel->thumbnail }}" alt="{{ $rel->title }}">
                    <span class="media-type-badge type-{{ $rel->type }}">{{ $rel->type }}</span>
                    <button class="wishlist-btn" onclick="toggleWishlist(event, {{ $rel->id }}, this)" title="Toggle Wishlist">
                        <i class="{{ in_array($rel->id, $userWishlistIds ?? []) ? 'fa-solid' : 'fa-regular' }} fa-heart" style="{{ in_array($rel->id, $userWishlistIds ?? []) ? 'color: #ec4899;' : '' }}"></i>
                    </button>
                </div>
                <div class="media-info">
                    <span class="media-price {{ $rel->is_free ? 'free' : '' }}">
                        {{ $rel->is_free ? 'Free' : '$' . number_format($rel->price, 2) }}
                    </span>
                    <div class="media-title">{{ $rel->title }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

</x-frontend-layout>
