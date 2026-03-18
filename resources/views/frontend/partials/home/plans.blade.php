<style>
/* ============================
   PRICING PLANS
   ============================ */
.plans { background: #0d0e12; padding: 80px 0; position: relative; }
.plans-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(108,99,255,0.08) 0%, transparent 70%); pointer-events: none; }
.plans-toggle { display: flex; align-items: center; gap: 14px; justify-content: center; margin-bottom: 48px; }
.plans-toggle span { color: #9397a8; font-size: 14px; font-weight: 500; }
.toggle-switch { position: relative; width: 52px; height: 28px; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider { position: absolute; inset: 0; background: rgba(255,255,255,0.1); border-radius: 14px; cursor: pointer; transition: background 0.3s; border: 1px solid rgba(255,255,255,0.1); }
.toggle-slider:before { content: ''; position: absolute; left: 4px; top: 4px; width: 18px; height: 18px; border-radius: 50%; background: #fff; transition: transform 0.3s; }
input:checked + .toggle-slider { background: linear-gradient(135deg,#6c63ff,#a855f7); }
input:checked + .toggle-slider:before { transform: translateX(24px); }
.save-badge { background: rgba(67,233,123,0.15); border: 1px solid rgba(67,233,123,0.3); color: #43e97b; padding: 3px 10px; border-radius: 50px; font-size: 11px; font-weight: 700; }
.plans-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; position: relative; z-index: 1; }
.plan-card {
    background: #16181e; border: 1px solid rgba(255,255,255,0.08); border-radius: 24px;
    padding: 36px 32px; transition: all 0.3s; position: relative; overflow: hidden;
}
.plan-card.popular {
    background: linear-gradient(160deg, #1a1b2e, #16181e);
    border-color: rgba(108,99,255,0.5);
    box-shadow: 0 0 0 1px rgba(108,99,255,0.15), 0 30px 80px rgba(108,99,255,0.15);
    transform: scale(1.03);
}
.plan-popular-tag {
    position: absolute; top: 20px; right: 20px;
    background: linear-gradient(135deg,#6c63ff,#a855f7); color: #fff;
    padding: 4px 14px; border-radius: 50px; font-size: 11px; font-weight: 700;
    letter-spacing: 0.5px;
}
.plan-name { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 8px; }
.plan-desc { font-size: 13px; color: #7b8094; margin-bottom: 26px; line-height: 1.6; }
.plan-price-wrap { margin-bottom: 28px; }
.plan-price { font-family: 'Outfit', sans-serif; font-size: 46px; font-weight: 900; color: #fff; line-height: 1; }
.plan-price sup { font-size: 22px; vertical-align: top; margin-top: 10px; margin-right: 2px; }
.plan-price sub { font-size: 15px; color: #7b8094; font-weight: 400; }
.plan-features { list-style: none; margin-bottom: 32px; display: flex; flex-direction: column; gap: 12px; }
.plan-features li { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #9397a8; }
.plan-features li i { color: #43e97b; margin-top: 2px; font-size: 13px; flex-shrink: 0; }
.plan-features li.na { color: #3a3d4a; }
.plan-features li.na i { color: #3a3d4a; }
.plan-btn {
    display: block; width: 100%; padding: 14px; border-radius: 12px; font-size: 15px; font-weight: 700;
    font-family: 'Inter', sans-serif; cursor: pointer; text-align: center; transition: all 0.3s; border: none;
}
.plan-btn-primary { background: linear-gradient(135deg,#6c63ff,#a855f7); color: #fff; box-shadow: 0 4px 20px rgba(108,99,255,0.35); }
.plan-btn-primary:hover { box-shadow: 0 8px 30px rgba(108,99,255,0.55); transform: translateY(-2px); }
.plan-btn-outline { background: transparent; border: 1px solid rgba(255,255,255,0.15) !important; color: #9397a8; }
.plan-btn-outline:hover { border-color: rgba(108,99,255,0.5) !important; color: #6c63ff; background: rgba(108,99,255,0.06); }
@media(max-width:900px){ .plans-grid { grid-template-columns:1fr; } .plan-card.popular { transform:none; } }
</style>

<section class="plans" id="pricing">
    <div class="plans-bg"></div>
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <div class="section-label" style="justify-content:center;"><i class="fa-solid fa-star"></i> Pricing Plans</div>
            <h2 class="section-title">Simple, Transparent Pricing</h2>
            <p class="section-subtitle">Choose the plan that fits your workflow. Cancel anytime.</p>
        </div>
        <div class="plans-toggle">
            <span>Monthly</span>
            <label class="toggle-switch">
                <input type="checkbox" id="billingToggle">
                <span class="toggle-slider"></span>
            </label>
            <span>Annual <span class="save-badge">Save 35%</span></span>
        </div>
        <div class="plans-grid">
            <!-- Free -->
            <div class="plan-card reveal">
                <div class="plan-name">Free</div>
                <div class="plan-desc">Great for exploring. Browse and download limited free assets every month.</div>
                <div class="plan-price-wrap">
                    <div class="plan-price"><sup>$</sup>0<sub>/mo</sub></div>
                </div>
                <ul class="plan-features">
                    <li><i class="fa-solid fa-check"></i> 10 free downloads/month</li>
                    <li><i class="fa-solid fa-check"></i> Standard resolution only</li>
                    <li><i class="fa-solid fa-check"></i> Personal license</li>
                    <li class="na"><i class="fa-solid fa-xmark"></i> No HD or 4K downloads</li>
                    <li class="na"><i class="fa-solid fa-xmark"></i> No commercial license</li>
                    <li class="na"><i class="fa-solid fa-xmark"></i> No video downloads</li>
                </ul>
                <button class="plan-btn plan-btn-outline">Get Started Free</button>
            </div>
            <!-- Pro – Popular -->
            <div class="plan-card popular reveal" style="animation-delay:0.1s;">
                <div class="plan-popular-tag"><i class="fa-solid fa-bolt"></i> Most Popular</div>
                <div class="plan-name">Pro</div>
                <div class="plan-desc">Perfect for freelancers and studios who need premium assets regularly.</div>
                <div class="plan-price-wrap">
                    <div class="plan-price" data-monthly="29" data-annual="19"><sup>$</sup><span class="price-val">29</span><sub>/mo</sub></div>
                </div>
                <ul class="plan-features">
                    <li><i class="fa-solid fa-check"></i> Unlimited photo downloads</li>
                    <li><i class="fa-solid fa-check"></i> 100 video downloads/month</li>
                    <li><i class="fa-solid fa-check"></i> Full HD &amp; 4K quality</li>
                    <li><i class="fa-solid fa-check"></i> Commercial license included</li>
                    <li><i class="fa-solid fa-check"></i> Priority support</li>
                    <li class="na"><i class="fa-solid fa-xmark"></i> Extended license</li>
                </ul>
                <button class="plan-btn plan-btn-primary">Start Pro – 7 Days Free</button>
            </div>
            <!-- Enterprise -->
            <div class="plan-card reveal" style="animation-delay:0.2s;">
                <div class="plan-name">Enterprise</div>
                <div class="plan-desc">For teams &amp; agencies with high-volume needs and custom licensing.</div>
                <div class="plan-price-wrap">
                    <div class="plan-price" data-monthly="99" data-annual="69"><sup>$</sup><span class="price-val">99</span><sub>/mo</sub></div>
                </div>
                <ul class="plan-features">
                    <li><i class="fa-solid fa-check"></i> Unlimited everything</li>
                    <li><i class="fa-solid fa-check"></i> Extended commercial license</li>
                    <li><i class="fa-solid fa-check"></i> Multi-seat (up to 10 users)</li>
                    <li><i class="fa-solid fa-check"></i> White-label rights</li>
                    <li><i class="fa-solid fa-check"></i> API access</li>
                    <li><i class="fa-solid fa-check"></i> Dedicated account manager</li>
                </ul>
                <button class="plan-btn plan-btn-outline">Contact Sales</button>
            </div>
        </div>
        <p style="text-align:center;margin-top:24px;font-size:13px;color:#4a5060;">All plans include a 30-day money-back guarantee. No hidden fees.</p>
    </div>
</section>

<script>
(function(){
    var toggle = document.getElementById('billingToggle');
    if(!toggle) return;
    toggle.addEventListener('change', function(){
        document.querySelectorAll('[data-monthly]').forEach(function(el){
            var val = toggle.checked ? el.dataset.annual : el.dataset.monthly;
            el.querySelector('.price-val').textContent = val;
        });
    });
})();
</script>
