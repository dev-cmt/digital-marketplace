<style>
/* ============================
   STATS BAR
   ============================ */
.stats-bar {
    background: #111318; border-top: 1px solid rgba(255,255,255,0.06);
    border-bottom: 1px solid rgba(255,255,255,0.06); padding: 28px 0;
}
.stats-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 24px; }
.stat-item { text-align: center; }
.stat-num { font-family: 'Outfit', sans-serif; font-size: 34px; font-weight: 800; color: #fff; line-height: 1; }
.stat-num span { background: linear-gradient(135deg, #6c63ff, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.stat-label { font-size: 13px; color: #6b7080; margin-top: 4px; font-weight: 500; }
.stat-divider { width: 1px; background: rgba(255,255,255,0.07); }
@media(max-width: 600px) { .stat-divider { display: none; } }
</style>

<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat-item reveal">
            <div class="stat-num"><span>15M+</span></div>
            <div class="stat-label">Premium Assets</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item reveal">
            <div class="stat-num"><span>48K+</span></div>
            <div class="stat-label">Active Creators</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item reveal">
            <div class="stat-num"><span>2.1M+</span></div>
            <div class="stat-label">Downloads Monthly</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item reveal">
            <div class="stat-num"><span>$12M</span></div>
            <div class="stat-label">Paid to Creators</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item reveal">
            <div class="stat-num"><span>180+</span></div>
            <div class="stat-label">Countries Served</div>
        </div>
    </div>
</div>
