<style>
/* ============================
   HOW IT WORKS
   ============================ */
#how-it-works { background: #0a0b0f; padding: 80px 0; position: relative; overflow: hidden; }
.hiw-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 60% at 50% 100%, rgba(108,99,255,0.07) 0%, transparent 70%); pointer-events: none; }
.hiw-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 48px; }
.hiw-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.07); border-radius: 20px;
    padding: 36px 28px; position: relative; transition: all 0.3s;
}
.hiw-card:hover { border-color: rgba(108,99,255,0.35); box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(108,99,255,0.15); transform: translateY(-4px); }
.hiw-step-num {
    font-family: 'Outfit', sans-serif; font-size: 72px; font-weight: 900;
    line-height: 1; background: linear-gradient(135deg, rgba(108,99,255,0.12), rgba(108,99,255,0.04));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    position: absolute; top: 20px; right: 24px;
}
.hiw-icon {
    width: 58px; height: 58px; border-radius: 16px; margin-bottom: 22px;
    display: flex; align-items: center; justify-content: center; font-size: 26px;
}
.hiw-icon-1 { background: rgba(108,99,255,0.15); color: #6c63ff; }
.hiw-icon-2 { background: rgba(236,72,153,0.12); color: #ec4899; }
.hiw-icon-3 { background: rgba(67,233,123,0.12); color: #43e97b; }
.hiw-title { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 10px; }
.hiw-desc { font-size: 14px; color: #7b8094; line-height: 1.7; }
.hiw-arrow { display: none; }
@media(max-width: 768px) { .hiw-grid { grid-template-columns: 1fr; } }
</style>

<section id="how-it-works">
    <div class="hiw-bg"></div>
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-circle-nodes"></i> How It Works</div>
            <h2 class="section-title">Three Steps to Your Perfect Asset</h2>
            <p class="section-subtitle">Whether you're a buyer or a creator, getting started is effortless.</p>
        </div>
        <div class="hiw-grid">
            <div class="hiw-card reveal">
                <div class="hiw-step-num">01</div>
                <div class="hiw-icon hiw-icon-1"><i class="fa-solid fa-magnifying-glass"></i></div>
                <div class="hiw-title">Discover &amp; Search</div>
                <p class="hiw-desc">Use our powerful search with filters for resolution, style, category, price range, and license type to find exactly what your project needs.</p>
            </div>
            <div class="hiw-card reveal" style="animation-delay:0.1s;">
                <div class="hiw-step-num">02</div>
                <div class="hiw-icon hiw-icon-2"><i class="fa-solid fa-credit-card"></i></div>
                <div class="hiw-title">License &amp; Purchase</div>
                <p class="hiw-desc">Choose a subscription plan or buy individual assets. Select the right license — personal, commercial, or extended — for your use case.</p>
            </div>
            <div class="hiw-card reveal" style="animation-delay:0.2s;">
                <div class="hiw-step-num">03</div>
                <div class="hiw-icon hiw-icon-3"><i class="fa-solid fa-cloud-arrow-down"></i></div>
                <div class="hiw-title">Download &amp; Create</div>
                <p class="hiw-desc">Instantly download your assets in the highest resolution available. Use them in any professional project, protected by your license certificate.</p>
            </div>
        </div>
        <!-- Creator flow -->
        <div style="margin-top:48px; background:#16181e; border:1px solid rgba(255,255,255,0.07); border-radius:20px; padding:36px 40px;">
            <div style="display:flex;align-items:center;gap:16px; margin-bottom:28px; flex-wrap:wrap;">
                <span style="background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);border-radius:50px;padding:5px 16px;color:#f59e0b;font-size:12px;font-weight:700;letter-spacing:0.8px;">FOR CREATORS</span>
                <h3 style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:#fff;">Start Earning in Minutes</h3>
            </div>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
                @foreach([['fa-cloud-arrow-up','Upload','Upload your best photos, videos, and audio through our simple upload portal.','#6c63ff'],['fa-tags','Tag & Describe','Add metadata, tags, and set your pricing and license options to maximize visibility.','#ec4899'],['fa-shield-halved','Review','Our team reviews your content to ensure quality and compliance with guidelines.','#43e97b'],['fa-sack-dollar','Earn','Get paid via Stripe or PayPal every month. Track your sales in real-time.','#f59e0b']] as $i => $s)
                <div style="text-align:center;">
                    <div style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:20px;color:{{ $s[3] }};"><i class="fa-solid {{ $s[0] }}"></i></div>
                    <div style="font-weight:700;color:#fff;font-size:14px;margin-bottom:6px;">{{ $s[1] }}</div>
                    <div style="font-size:12px;color:#6b7080;line-height:1.6;">{{ $s[2] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
