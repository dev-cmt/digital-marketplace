<style>
/* ============================
   LICENSING OPTIONS
   ============================ */
.licensing { background: #0d0e12; padding: 80px 0; }
.lic-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.lic-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.07); border-radius: 20px;
    padding: 32px 28px; transition: all 0.3s;
}
.lic-card:hover { border-color: rgba(255,255,255,0.15); transform: translateY(-3px); box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
.lic-icon { width:52px; height:52px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:22px; margin-bottom:18px; }
.lic-icon-1 { background:rgba(108,99,255,0.14); color:#6c63ff; }
.lic-icon-2 { background:rgba(245,158,11,0.13); color:#f59e0b; }
.lic-icon-3 { background:rgba(236,72,153,0.12); color:#ec4899; }
.lic-name { font-family:'Outfit',sans-serif; font-size:19px; font-weight:800; color:#fff; margin-bottom:8px; }
.lic-desc { font-size:13px; color:#7b8094; line-height:1.65; margin-bottom:20px; }
.lic-features { list-style:none; display:flex; flex-direction:column; gap:9px; }
.lic-features li { display:flex; align-items:flex-start; gap:9px; font-size:13px; color:#9397a8; }
.lic-features li i { color:#43e97b; font-size:12px; margin-top:2px; flex-shrink:0; }
@media(max-width:900px){ .lic-grid { grid-template-columns:1fr; } }
</style>

<section class="licensing">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-file-contract"></i> Licensing</div>
            <h2 class="section-title">Use It Your Way</h2>
            <p class="section-subtitle">Clear, simple licensing so you always know what you can do with your purchase.</p>
        </div>
        <div class="lic-grid">
            <div class="lic-card reveal">
                <div class="lic-icon lic-icon-1"><i class="fa-solid fa-user"></i></div>
                <div class="lic-name">Personal License</div>
                <div class="lic-desc">For personal, non-commercial projects — blogs, school work, or home prints.</div>
                <ul class="lic-features">
                    <li><i class="fa-solid fa-check"></i> Personal blogs &amp; social media</li>
                    <li><i class="fa-solid fa-check"></i> Non-commercial print up to 500 copies</li>
                    <li><i class="fa-solid fa-check"></i> Digital presentations</li>
                    <li><i class="fa-solid fa-check"></i> No resale or redistribution</li>
                </ul>
            </div>
            <div class="lic-card reveal" style="animation-delay:0.1s;">
                <div class="lic-icon lic-icon-2"><i class="fa-solid fa-briefcase"></i></div>
                <div class="lic-name">Commercial License</div>
                <div class="lic-desc">For businesses and freelancers using assets in commercial projects and advertising.</div>
                <ul class="lic-features">
                    <li><i class="fa-solid fa-check"></i> Ads, marketing, &amp; promotional content</li>
                    <li><i class="fa-solid fa-check"></i> Website &amp; app design</li>
                    <li><i class="fa-solid fa-check"></i> Print up to 500,000 copies</li>
                    <li><i class="fa-solid fa-check"></i> Unlimited digital distribution</li>
                    <li><i class="fa-solid fa-check"></i> Broadcast &amp; streaming (up to 1M views)</li>
                </ul>
            </div>
            <div class="lic-card reveal" style="animation-delay:0.2s;">
                <div class="lic-icon lic-icon-3"><i class="fa-solid fa-infinity"></i></div>
                <div class="lic-name">Extended License</div>
                <div class="lic-desc">Full unrestricted rights — resell, redistribute, and use at any scale.</div>
                <ul class="lic-features">
                    <li><i class="fa-solid fa-check"></i> All commercial rights included</li>
                    <li><i class="fa-solid fa-check"></i> Resale in products (merchandise, apps)</li>
                    <li><i class="fa-solid fa-check"></i> Unlimited print runs</li>
                    <li><i class="fa-solid fa-check"></i> Unlimited broadcast &amp; streaming</li>
                    <li><i class="fa-solid fa-check"></i> Includes indemnification guarantee</li>
                </ul>
            </div>
        </div>
        <p style="text-align:center;margin-top:28px;font-size:13px;color:#4a5060;">
            Not sure which license you need? <a href="#" style="color:#6c63ff;">Read our licensing guide</a> or <a href="#" style="color:#6c63ff;">contact support</a>.
        </p>
    </div>
</section>
