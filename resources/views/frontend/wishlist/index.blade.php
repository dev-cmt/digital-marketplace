<x-frontend-layout title="My Wishlist">

<style>
.wishlist-hero {
    padding: 100px 0 60px;
    background: radial-gradient(circle at 50% 0%, rgba(236,72,153,0.1) 0%, transparent 70%);
    text-align: center;
}
.wishlist-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 800; color: #fff; margin-bottom: 16px;
    font-family: var(--font-heading);
}
.wishlist-subtitle { color: var(--text-secondary); font-size: 16px; }

.asset-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;
}

@import url('{{ asset('css/media-cards.css') }}');

/* Re-applying standard card styles here for safety */
.media-card {
    background: #16181e; border-radius: 16px; overflow: hidden;
    border: 1px solid rgba(255,255,255,0.07); transition: all 0.3s; cursor: pointer; position: relative;
    display: block;
}
.media-card:hover { transform: translateY(-4px); border-color: rgba(255,255,255,0.15); box-shadow: 0 20px 50px rgba(0,0,0,0.45); }
.media-thumb { position: relative; aspect-ratio: 4/3; overflow: hidden; background: #1e2029; }
.media-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.media-card:hover .media-thumb img { transform: scale(1.06); }
.media-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%); opacity: 0; transition: opacity 0.3s; }
.media-card:hover .media-overlay { opacity: 1; }
.media-type-badge { position: absolute; top: 10px; left: 10px; padding: 3px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; backdrop-filter: blur(8px); z-index: 2; }
.type-photo { background: rgba(108,99,255,0.75); color: #fff; }
.type-video { background: rgba(245,158,11,0.8); color: #000; }
.media-info { padding: 14px 16px; }
.media-price { font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #43e97b; }
.media-price.free { color: #6c63ff; }
.media-title { font-size: 14px; font-weight: 600; color: #fff; margin-bottom: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.pagination-wrap { margin-top: 60px; display: flex; justify-content: center; }

@media(max-width: 1100px) { .asset-grid { grid-template-columns: repeat(3, 1fr); } }
@media(max-width: 800px) { .asset-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 480px) { .asset-grid { grid-template-columns: 1fr; } }
</style>

<div class="wishlist-hero">
    <div class="container">
        <h1 class="wishlist-title"><i class="fa-solid fa-heart" style="color:#ec4899;"></i> My Wishlist</h1>
        <p class="wishlist-subtitle">Your personally curated collection of premium assets.</p>
    </div>
</div>

<div class="container" style="padding-bottom: 120px; padding-top: 40px;">
    <div class="asset-grid">
        @forelse($wishlists as $wishlist)
        <a href="{{ route('frontend.assets.show', $wishlist->asset->slug) }}" class="media-card" id="wishlist-card-{{ $wishlist->asset->id }}">
            <div class="media-thumb">
                <img src="{{ $wishlist->asset->thumbnail }}" alt="{{ $wishlist->asset->title }}" loading="lazy">
                <div class="media-overlay"></div>
                <span class="media-type-badge type-{{ $wishlist->asset->type }}">{{ $wishlist->asset->type }}</span>
                <button class="wishlist-btn" onclick="toggleWishlist(event, {{ $wishlist->asset->id }}, this); document.getElementById('wishlist-card-{{ $wishlist->asset->id }}').remove();" title="Remove from Wishlist">
                    <i class="fa-solid fa-heart" style="color: #ec4899;"></i>
                </button>
            </div>
            <div class="media-info">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <span class="media-price {{ $wishlist->asset->is_free ? 'free' : '' }}">
                        {{ $wishlist->asset->is_free ? 'Free' : '$' . number_format($wishlist->asset->price, 2) }}
                    </span>
                    <div style="font-size:11px; color:var(--text-muted);">
                        <i class="fa-solid fa-download"></i> {{ number_format($wishlist->asset->downloads_count) }}
                    </div>
                </div>
                <div class="media-title">{{ $wishlist->asset->title }}</div>
            </div>
        </a>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
            <i class="fa-regular fa-heart" style="font-size:48px; color:var(--text-muted); margin-bottom:20px; display:block;"></i>
            <h3 style="color:#fff;">Your wishlist is empty</h3>
            <p style="color:var(--text-secondary); margin-bottom: 24px;">Start browsing and save your favorite assets to your wishlist.</p>
            <a href="{{ route('frontend.assets.index') }}" class="btn btn-primary">Browse Assets</a>
        </div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $wishlists->links() }}
    </div>
</div>

</x-frontend-layout>
