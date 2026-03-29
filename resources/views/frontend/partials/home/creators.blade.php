<style>
/* ============================
   TOP CREATORS
   ============================ */
.creators { background: #0a0b0f; padding: 80px 0; }
.creators-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.creator-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.07); border-radius: 20px;
    padding: 28px 22px; text-align: center; transition: all 0.3s; position: relative; overflow: hidden;
}
.creator-card::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(108,99,255,0.06),transparent); opacity:0; transition:opacity 0.3s; border-radius:20px; }
.creator-card:hover { transform:translateY(-5px); border-color:rgba(108,99,255,0.3); box-shadow:0 24px 60px rgba(0,0,0,0.4); }
.creator-card:hover::after { opacity:1; }
.creator-avatar-wrap { position:relative; display:inline-block; margin-bottom:16px; }
.creator-avatar { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid rgba(108,99,255,0.35); }
.creator-verified { position:absolute; bottom:2px; right:2px; width:22px; height:22px; background:linear-gradient(135deg,#6c63ff,#a855f7); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:10px; border:2px solid #16181e; }
.creator-name { font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; color:#fff; margin-bottom:4px; }
.creator-handle { font-size:12px; color:#6b7080; margin-bottom:14px; }
.creator-stats { display:flex; justify-content:center; gap:20px; margin-bottom:16px; }
.creator-stat { text-align:center; }
.creator-stat-num { font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; color:#fff; }
.creator-stat-label { font-size:11px; color:#6b7080; }
.creator-btn {
    display:block; width:100%; padding:9px; border:1px solid rgba(255,255,255,0.12);
    border-radius:10px; color:#9397a8; font-size:13px; font-weight:600; background:transparent;
    cursor:pointer; font-family:'Inter',sans-serif; transition:all 0.2s;
}
.creator-btn:hover { border-color:rgba(108,99,255,0.5); color:#6c63ff; background:rgba(108,99,255,0.07); }
.creator-earnings { position:absolute; top:14px; right:14px; background:rgba(67,233,123,0.12); border:1px solid rgba(67,233,123,0.2); border-radius:8px; padding:4px 10px; font-size:11px; font-weight:700; color:#43e97b; }
@media(max-width:900px){ .creators-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:500px){ .creators-grid { grid-template-columns:1fr; } }
</style>

<section class="creators">
    <div class="container">
        <div class="section-header" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <div class="section-label"><i class="fa-solid fa-crown"></i> Top Creators</div>
                <h2 class="section-title">Meet Our Best Sellers</h2>
                <p class="section-subtitle">Artists, photographers, and videographers earning with PixelVault.</p>
            </div>
            <a href="{{ route('frontend.creators') }}" style="padding:10px 20px;border:1px solid rgba(255,255,255,0.12);border-radius:10px;color:#9397a8;font-size:13px;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:7px;">
                View All Creators <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="creators-grid">
            @foreach($topCreators as $c)
            <div class="creator-card reveal">
                <div class="creator-earnings">${{ number_format(($c->assets_sum_downloads_count ?? 0) * 8.5) }} earned</div>
                <div class="creator-avatar-wrap">
                    @if($c->photo_path)
                        <img class="creator-avatar" src="{{ asset($c->photo_path) }}" alt="{{ $c->name }}">
                    @else
                        <img class="creator-avatar" src="https://ui-avatars.com/api/?name={{ urlencode($c->name) }}&background=6c63ff&color=fff" alt="{{ $c->name }}">
                    @endif
                    <div class="creator-verified"><i class="fa-solid fa-check"></i></div>
                </div>
                <div class="creator-name">{{ $c->name }}</div>
                <div class="creator-handle">{{ '@' . strtolower(str_replace(' ', '', $c->name)) }}</div>
                <div class="creator-stats">
                    <div class="creator-stat"><div class="creator-stat-num">{{ number_format($c->assets_count) }}</div><div class="creator-stat-label">Assets</div></div>
                    <div class="creator-stat"><div class="creator-stat-num">{{ number_format($c->assets_sum_downloads_count ?? 0) }}</div><div class="creator-stat-label">Sales</div></div>
                </div>
                <button class="creator-btn">View Portfolio</button>
            </div>
            @endforeach
        </div>
    </div>
</section>
