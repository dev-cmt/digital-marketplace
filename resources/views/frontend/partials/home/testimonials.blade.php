<style>
/* ============================
   TESTIMONIALS
   ============================ */
.testimonials { background: #0a0b0f; padding: 80px 0; }
.testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.testi-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.07); border-radius: 20px;
    padding: 28px; transition: all 0.3s;
}
.testi-card:hover { border-color: rgba(108,99,255,0.25); transform: translateY(-3px); box-shadow: 0 20px 50px rgba(0,0,0,0.35); }
.testi-stars { display: flex; gap: 3px; margin-bottom: 14px; }
.testi-stars i { color: #f59e0b; font-size: 14px; }
.testi-text { font-size: 14px; color: #9397a8; line-height: 1.75; margin-bottom: 20px; font-style: italic; }
.testi-text::before { content: '"'; font-size: 28px; color: rgba(108,99,255,0.4); line-height: 0; vertical-align: -10px; margin-right: 4px; }
.testi-author { display: flex; align-items: center; gap: 12px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.06); }
.testi-avatar { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(108,99,255,0.3); }
.testi-author-name { font-size: 14px; font-weight: 700; color: #fff; }
.testi-author-role { font-size: 12px; color: #6b7080; }
.testi-verified { margin-left: auto; display: flex; align-items: center; gap: 5px; font-size: 11px; color: #43e97b; font-weight: 600; }
@media(max-width:900px){ .testi-grid { grid-template-columns:1fr; } }
</style>

<section class="testimonials">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-quote-left"></i> Testimonials</div>
            <h2 class="section-title">Loved by Thousands of Creatives</h2>
            <p class="section-subtitle">Hear from designers, agencies, and content creators around the world.</p>
        </div>
        <div class="testi-grid">
            @php
            $reviews = [
                ['rate'=>5,'text'=>'PixelVault has completely transformed how I source visuals for my agency. The quality is unmatched and the licensing is clear — no more legal headaches.','name'=>'Emily Hartmann','role'=>'Creative Director, Studio H','avatar'=>'https://randomuser.me/api/portraits/women/26.jpg'],
                ['rate'=>5,'text'=>'The Pro subscription pays for itself with just one project. The 4K video library alone is worth 10x the price. I recommend it to every filmmaker I know.','name'=>'Arjun Patel','role'=>'Filmmaker &amp; YouTuber','avatar'=>'https://randomuser.me/api/portraits/men/38.jpg'],
                ['rate'=>5,'text'=>'As a creator I\'ve earned over $18k in 6 months. The upload process is smooth, analytics are detailed, and payouts arrive on time — every time.','name'=>'Mei Tanaka','role'=>'Photographer, Tokyo','avatar'=>'https://randomuser.me/api/portraits/women/75.jpg'],
            ];
            @endphp
            @foreach($reviews as $r)
            <div class="testi-card reveal">
                <div class="testi-stars">
                    @for($i=0; $i<$r['rate']; $i++)<i class="fa-solid fa-star"></i>@endfor
                </div>
                <p class="testi-text">{!! $r['text'] !!}</p>
                <div class="testi-author">
                    <img class="testi-avatar" src="{{ $r['avatar'] }}" alt="{{ $r['name'] }}">
                    <div>
                        <div class="testi-author-name">{{ $r['name'] }}</div>
                        <div class="testi-author-role">{!! $r['role'] !!}</div>
                    </div>
                    <div class="testi-verified"><i class="fa-solid fa-circle-check"></i> Verified</div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Trust logos -->
        <div style="margin-top:60px;text-align:center;">
            <p style="font-size:12px;color:#4a5060;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:24px;">Trusted by teams at</p>
            <div style="display:flex;justify-content:center;align-items:center;gap:40px;flex-wrap:wrap;opacity:0.3;filter:grayscale(1);">
                @foreach(['Google','Adobe','Shopify','HubSpot','Notion'] as $brand)
                <span style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:#fff;">{{ $brand }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
