<style>
/* ============================
   CTA SECTION
   ============================ */
.cta-section {
    padding: 100px 0; position: relative; overflow: hidden;
    background: linear-gradient(135deg, #0e0b25 0%, #0a0b0f 50%, #16081a 100%);
}
.cta-orb-1 { position:absolute; width:500px; height:500px; border-radius:50%; top:-200px; left:-100px; background:radial-gradient(circle, rgba(108,99,255,0.2) 0%, transparent 70%); pointer-events:none; }
.cta-orb-2 { position:absolute; width:400px; height:400px; border-radius:50%; bottom:-100px; right:-80px; background:radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 70%); pointer-events:none; }
.cta-grid-bg { position:absolute; inset:0; background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px); background-size:60px 60px; pointer-events:none; }
.cta-inner { position:relative; z-index:1; text-align:center; }
.cta-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(108,99,255,0.15); border:1px solid rgba(108,99,255,0.3); border-radius:50px; padding:6px 18px; font-size:12px; font-weight:700; color:#a89bf5; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:24px; }
.cta-title { font-family:'Outfit',sans-serif; font-size:clamp(36px,5vw,62px); font-weight:900; line-height:1.1; color:#fff; margin-bottom:18px; }
.cta-title .grad { background:linear-gradient(135deg,#6c63ff,#ec4899); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.cta-sub { font-size:17px; color:#7b8094; max-width:520px; margin:0 auto 40px; line-height:1.7; }
.cta-actions { display:flex; justify-content:center; gap:16px; flex-wrap:wrap; margin-bottom:40px; }
.cta-btn-primary { display:inline-flex; align-items:center; gap:10px; padding:17px 38px; background:linear-gradient(135deg,#6c63ff,#a855f7); border:none; border-radius:16px; color:#fff; font-size:16px; font-weight:700; font-family:'Inter',sans-serif; cursor:pointer; transition:all 0.3s; box-shadow:0 8px 32px rgba(108,99,255,0.45); }
.cta-btn-primary:hover { transform:translateY(-2px); box-shadow:0 14px 40px rgba(108,99,255,0.6); }
.cta-btn-outline { display:inline-flex; align-items:center; gap:10px; padding:16px 32px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.15); border-radius:16px; color:#fff; font-size:16px; font-weight:600; font-family:'Inter',sans-serif; cursor:pointer; transition:all 0.3s; }
.cta-btn-outline:hover { border-color:rgba(255,255,255,0.3); background:rgba(255,255,255,0.1); }
.cta-perks { display:flex; justify-content:center; gap:28px; flex-wrap:wrap; }
.cta-perk { display:flex; align-items:center; gap:7px; font-size:13px; color:#7b8094; }
.cta-perk i { color:#43e97b; }
/* Referral strip */
.referral-strip {
    margin-top:56px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08);
    border-radius:16px; padding:24px 32px; display:flex; align-items:center; justify-content:space-between;
    gap:20px; flex-wrap:wrap; backdrop-filter:blur(10px);
}
.referral-info { display:flex; align-items:center; gap:14px; }
.referral-icon { width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg,rgba(245,158,11,0.2),rgba(236,72,153,0.15)); display:flex; align-items:center; justify-content:center; font-size:22px; color:#f59e0b; }
.referral-title { font-family:'Outfit',sans-serif; font-size:17px; font-weight:800; color:#fff; }
.referral-desc { font-size:13px; color:#7b8094; }
.referral-btn { padding:11px 24px; background:linear-gradient(135deg,#f59e0b,#fb923c); border:none; border-radius:10px; color:#000; font-size:14px; font-weight:700; cursor:pointer; font-family:'Inter',sans-serif; transition:all 0.25s; white-space:nowrap; }
.referral-btn:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(245,158,11,0.4); }
</style>

<section class="cta-section">
    <div class="cta-orb-1"></div>
    <div class="cta-orb-2"></div>
    <div class="cta-grid-bg"></div>
    <div class="container">
        <div class="cta-inner">
            <div class="cta-badge"><i class="fa-solid fa-bolt-lightning"></i> Limited Time Offer</div>
            <h2 class="cta-title">Start Creating with<br><span class="grad">15 Million+ Assets</span><br>Today</h2>
            <p class="cta-sub">Join 48,000 creators and 1.2 million buyers who trust PixelVault for their digital content needs.</p>
            <div class="cta-actions">
                <a href="{{ route('login') }}" class="cta-btn-primary">
                    <i class="fa-solid fa-rocket"></i> Get Started Free
                </a>
                <a href="#pricing" class="cta-btn-outline">
                    <i class="fa-solid fa-tag"></i> View Plans
                </a>
            </div>
            <div class="cta-perks">
                <div class="cta-perk"><i class="fa-solid fa-check-circle"></i> No credit card required</div>
                <div class="cta-perk"><i class="fa-solid fa-check-circle"></i> 7-day free Pro trial</div>
                <div class="cta-perk"><i class="fa-solid fa-check-circle"></i> Cancel anytime</div>
                <div class="cta-perk"><i class="fa-solid fa-check-circle"></i> 30-day money-back</div>
            </div>
        </div>

        <!-- Referral Strip -->
        <div class="referral-strip">
            <div class="referral-info">
                <div class="referral-icon"><i class="fa-solid fa-gift"></i></div>
                <div>
                    <div class="referral-title">Earn $20 for Every Friend You Refer</div>
                    <div class="referral-desc">Share your unique link — when a friend subscribes, you both get a bonus.</div>
                </div>
            </div>
            <button class="referral-btn"><i class="fa-solid fa-share-nodes" style="margin-right:7px;"></i> Share & Earn</button>
        </div>
    </div>
</section>

<style>
/* Scroll reveal animations */
.reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.6s ease, transform 0.6s ease; }
.reveal.is-visible { opacity: 1; transform: translateY(0); }
</style>
