<style>
/* ============================
   HERO SECTION
   ============================ */
.hero {
    position: relative; min-height: calc(100vh - 70px);
    display: flex; align-items: center; overflow: hidden;
    background: radial-gradient(ellipse 100% 80% at 50% 0%, rgba(108,99,255,0.12) 0%, transparent 70%),
                linear-gradient(180deg, #0a0b0f 0%, #0d0e14 100%);
    padding: 80px 0 60px;
}
.hero-bg-orb-1 { position: absolute; width: 600px; height: 600px; top: -200px; left: -150px; border-radius: 50%; background: radial-gradient(circle, rgba(108,99,255,0.14) 0%, transparent 70%); pointer-events:none; }
.hero-bg-orb-2 { position: absolute; width: 500px; height: 500px; bottom: -100px; right: -100px; border-radius: 50%; background: radial-gradient(circle, rgba(236,72,153,0.1) 0%, transparent 70%); pointer-events:none; }
.hero-grid-bg { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px; pointer-events:none; }
.hero-container { max-width: 1280px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 1; width: 100%; }
.hero-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(108,99,255,0.12); border: 1px solid rgba(108,99,255,0.3);
    border-radius: 50px; padding: 6px 16px; font-size: 12px; font-weight: 600;
    color: #a89bf5; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 24px;
}
.hero-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: #43e97b; animation: pulse-ring 1.5s infinite; }
.hero-title {
    font-family: 'Outfit', sans-serif; font-size: clamp(38px, 5vw, 68px);
    font-weight: 900; line-height: 1.08; color: #fff; margin-bottom: 22px;
}
.hero-title .line-grad { background: linear-gradient(135deg, #6c63ff 0%, #ec4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.hero-subtitle { font-size: 17px; color: #7b8094; line-height: 1.75; margin-bottom: 36px; max-width: 500px; }
.hero-actions { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 40px; }
.hero-btn-primary {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 16px 32px; background: linear-gradient(135deg, #6c63ff, #a855f7);
    border: none; border-radius: 14px; color: #fff; font-size: 15px; font-weight: 700;
    font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.3s;
    box-shadow: 0 6px 28px rgba(108,99,255,0.45);
}
.hero-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 36px rgba(108,99,255,0.6); }
.hero-btn-outline {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 15px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 14px; color: #fff; font-size: 15px; font-weight: 600;
    font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.3s;
}
.hero-btn-outline:hover { border-color: rgba(255,255,255,0.35); background: rgba(255,255,255,0.1); }
.hero-trust { display: flex; align-items: center; gap: 14px; }
.hero-avatars { display: flex; }
.hero-avatars img { width: 34px; height: 34px; border-radius: 50%; border: 2px solid #1e2029; margin-left: -10px; object-fit: cover; }
.hero-avatars img:first-child { margin-left: 0; }
.hero-trust-text { font-size: 13px; color: #7b8094; }
.hero-trust-text strong { color: #fff; }
.hero-stars { color: #f59e0b; font-size: 12px; display: block; margin-top: 2px; }
/* Floating media mosaic */
.hero-visual { position: relative; display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: 200px 200px; gap: 14px; }
.hero-card {
    border-radius: 18px; overflow: hidden; position: relative;
    background: #16181e; border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 16px 48px rgba(0,0,0,0.5); transition: transform 0.4s;
    animation: float 6s ease-in-out infinite;
}
.hero-card:hover { transform: scale(1.03); }
.hero-card:nth-child(2) { animation-delay: 1.5s; }
.hero-card:nth-child(3) { animation-delay: 3s; }
.hero-card:nth-child(4) { animation-delay: 4.5s; }
.hero-card-img { width: 100%; height: 100%; object-fit: cover; opacity: 0.85; }
.hero-card-badge {
    position: absolute; bottom: 10px; left: 10px;
    background: rgba(0,0,0,0.75); backdrop-filter: blur(10px);
    border-radius: 8px; padding: 5px 10px; display: flex; align-items: center; gap: 6px; font-size: 11px; color: #fff; font-weight: 600;
}
.hero-card-play {
    position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.2s;
}
.hero-card:hover .hero-card-play { opacity: 1; }
.hero-card-play-btn {
    width: 48px; height: 48px; border-radius: 50%;
    background: rgba(108,99,255,0.9); display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 18px; backdrop-filter: blur(8px);
}
.hero-tag {
    position: absolute; top: 10px; right: 10px;
    background: rgba(0,0,0,0.7); backdrop-filter: blur(8px);
    border-radius: 6px; padding: 3px 8px; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.5px;
}
.tag-photo { color: #43e97b; }
.tag-video { color: #f59e0b; }
.tag-audio { color: #6c63ff; }
.tag-vector { color: #ec4899; }
/* Search bar big */
.hero-search-wrap { margin-top: 32px; }
.hero-search-bar {
    display: flex; align-items: stretch; background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.13); border-radius: 16px; overflow: hidden;
    transition: border-color 0.3s, box-shadow 0.3s;
}
.hero-search-bar:focus-within { border-color: rgba(108,99,255,0.5); box-shadow: 0 0 0 4px rgba(108,99,255,0.1); }
.hero-search-select {
    background: rgba(255,255,255,0.05); border: none; border-right: 1px solid rgba(255,255,255,0.08);
    padding: 14px 18px; color: #9397a8; font-size: 14px; outline: none;
    font-family: 'Inter', sans-serif; cursor: pointer;
}
.hero-search-select option { background: #16181e; }
.hero-search-input {
    flex: 1; background: transparent; border: none; outline: none;
    color: #fff; font-size: 15px; font-family: 'Inter', sans-serif; padding: 14px 20px;
}
.hero-search-input::placeholder { color: #4a5060; }
.hero-search-submit {
    padding: 14px 28px; background: linear-gradient(135deg, #6c63ff, #a855f7);
    border: none; color: #fff; font-size: 14px; font-weight: 700;
    font-family: 'Inter', sans-serif; cursor: pointer; transition: opacity 0.2s;
}
.hero-search-submit:hover { opacity: 0.88; }
.hero-trending-tags { margin-top: 14px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.hero-trending-tags span { color: #4a5060; font-size: 12px; flex-shrink: 0; }
.hero-tag-pill {
    padding: 4px 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50px; font-size: 12px; color: #9397a8; transition: all 0.2s; cursor: pointer;
}
.hero-tag-pill:hover { border-color: rgba(108,99,255,0.4); color: #6c63ff; background: rgba(108,99,255,0.08); }
@media(max-width: 900px) {
    .hero-layout { grid-template-columns: 1fr; }
    .hero-visual { display: none; }
    .hero { min-height: auto; padding: 60px 0 50px; }
}
</style>

<section class="hero">
    <div class="hero-bg-orb-1"></div>
    <div class="hero-bg-orb-2"></div>
    <div class="hero-grid-bg"></div>
    <div class="hero-container">
        <div class="hero-layout">
            <!-- Text Side -->
            <div>
                <div class="hero-badge">
                    <div class="dot"></div>
                    Over 15 Million Premium Assets
                </div>
                <h1 class="hero-title">
                    Discover &amp; License<br>
                    <span class="line-grad">World-Class</span><br>
                    Digital Assets
                </h1>
                <p class="hero-subtitle">
                    Photos, videos, audio, illustrations &amp; more — created by the world's best creators.
                    Subscribe or buy a la carte and bring your projects to life.
                </p>

                <!-- Search Bar -->
                <div class="hero-search-wrap">
                    <div class="hero-search-bar">
                        <select class="hero-search-select">
                            <option>All</option>
                            <option>Photos</option>
                            <option>Videos</option>
                            <option>Audio</option>
                            <option>Vectors</option>
                        </select>
                        <input class="hero-search-input" type="text" placeholder="Search millions of assets…">
                        <button class="hero-search-submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </div>
                    <div class="hero-trending-tags">
                        <span>Trending:</span>
                        <span class="hero-tag-pill">Nature</span>
                        <span class="hero-tag-pill">Business</span>
                        <span class="hero-tag-pill">Technology</span>
                        <span class="hero-tag-pill">Aesthetic</span>
                        <span class="hero-tag-pill">4K Video</span>
                        <span class="hero-tag-pill">Abstract</span>
                    </div>
                </div>

                <div style="margin-top:36px;display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
                    <div class="hero-trust">
                        <div class="hero-avatars">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="user">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="user">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="user">
                            <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="user">
                        </div>
                        <div class="hero-trust-text">
                            <strong>48,000+</strong> happy creators<br>
                            <span class="hero-stars">★★★★★ 4.9/5</span>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="hero-btn-primary">
                        <i class="fa-solid fa-rocket"></i> Start Free Trial
                    </a>
                    <a href="#how-it-works" class="hero-btn-outline">
                        <i class="fa-solid fa-play"></i> How it works
                    </a>
                </div>
            </div>

            <!-- Visual Mosaic -->
            <div class="hero-visual" aria-hidden="true">
                <div class="hero-card">
                    <img class="hero-card-img" src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&q=80" alt="Nature photo">
                    <span class="hero-tag tag-photo">Photo</span>
                    <div class="hero-card-badge"><i class="fa-solid fa-heart" style="color:#ec4899;"></i> 2.4k</div>
                </div>
                <div class="hero-card">
                    <img class="hero-card-img" src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&q=80" alt="Forest video">
                    <span class="hero-tag tag-video">Video</span>
                    <div class="hero-card-play"><div class="hero-card-play-btn"><i class="fa-solid fa-play"></i></div></div>
                    <div class="hero-card-badge"><i class="fa-solid fa-eye"></i> 12k</div>
                </div>
                <div class="hero-card">
                    <img class="hero-card-img" src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?w=400&q=80" alt="Landscape">
                    <span class="hero-tag tag-vector">Vector</span>
                    <div class="hero-card-badge"><i class="fa-solid fa-download"></i> 856</div>
                </div>
                <div class="hero-card">
                    <img class="hero-card-img" src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=400&q=80" alt="Business">
                    <span class="hero-tag tag-audio">Audio</span>
                    <div class="hero-card-badge"><i class="fa-solid fa-star" style="color:#f59e0b;"></i> 4.9</div>
                </div>
            </div>
        </div>
    </div>
</section>
