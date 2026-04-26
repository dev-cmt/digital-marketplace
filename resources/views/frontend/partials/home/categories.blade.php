<style>
/* ============================
   CATEGORIES
   ============================ */
.categories { background: #0a0b0f; padding: 80px 0; }
.cats-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px; }
.cat-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.07); border-radius: 18px;
    padding: 28px 16px; text-align: center; cursor: pointer;
    transition: all 0.3s; position: relative; overflow: hidden;
}
.cat-card::before {
    content: ''; position: absolute; inset: 0; opacity: 0; transition: opacity 0.3s;
    border-radius: 18px;
}
.cat-card:hover { transform: translateY(-5px); border-color: rgba(255,255,255,0.15); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
.cat-card:hover::before { opacity: 1; }
.cat-card.c1::before { background: linear-gradient(135deg, rgba(108,99,255,0.1),transparent); }
.cat-card.c2::before { background: linear-gradient(135deg, rgba(245,158,11,0.1),transparent); }
.cat-card.c3::before { background: linear-gradient(135deg, rgba(236,72,153,0.1),transparent); }
.cat-card.c4::before { background: linear-gradient(135deg, rgba(67,233,123,0.1),transparent); }
.cat-card.c5::before { background: linear-gradient(135deg, rgba(14,165,233,0.1),transparent); }
.cat-card.c6::before { background: linear-gradient(135deg, rgba(251,146,60,0.1),transparent); }
.cat-icon {
    width: 56px; height: 56px; border-radius: 16px; margin: 0 auto 14px;
    display: flex; align-items: center; justify-content: center; font-size: 24px;
}
.ic1 { background: rgba(108,99,255,0.15); color: #6c63ff; }
.ic2 { background: rgba(245,158,11,0.15); color: #f59e0b; }
.ic3 { background: rgba(236,72,153,0.15); color: #ec4899; }
.ic4 { background: rgba(67,233,123,0.12); color: #43e97b; }
.ic5 { background: rgba(14,165,233,0.15); color: #0ea5e9; }
.ic6 { background: rgba(251,146,60,0.15); color: #fb923c; }
.cat-name { font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 4px; }
.cat-count { font-size: 12px; color: #6b7080; }
@media(max-width: 1024px) { .cats-grid { grid-template-columns: repeat(3, 1fr); } }
@media(max-width: 600px) { .cats-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<section class="categories">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-layer-group"></i> Browse by Category</div>
            <h2 class="section-title">Explore Every Format</h2>
            <p class="section-subtitle">From stunning photography to immersive 4K video — find exactly what you need.</p>
        </div>
        <div class="cats-grid">
            @foreach($categories as $index => $category)
            <a href="{{ route('frontend.assets.category', $category->slug) }}" class="cat-card c{{ ($index % 6) + 1 }} reveal">
                <div class="cat-icon ic{{ ($index % 6) + 1 }}"><i class="{{ $category->icon }}"></i></div>
                <div class="cat-name">{{ $category->name }}</div>
                <div class="cat-count">{{ number_format($category->assets_count ?? 0) }} assets</div>
            </a>
            @endforeach
        </div>
    </div>
</section>
