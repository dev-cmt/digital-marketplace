<style>
/* ============================
   NAVBAR
   ============================ */
.navbar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    background: rgba(10, 11, 15, 0.85);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    transition: all 0.3s;
}
.navbar.scrolled {
    background: rgba(10, 11, 15, 0.97);
    border-color: rgba(255,255,255,0.1);
}
.nav-inner {
    max-width: 1280px; margin: 0 auto; padding: 0 24px;
    display: flex; align-items: center; gap: 20px; height: 70px;
}

/* Logo */
.nav-logo {
    display: flex; align-items: center; gap: 10px;
    font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 22px; color: #fff;
    flex-shrink: 0;
}
.nav-logo-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: linear-gradient(135deg, #6c63ff, #ec4899);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff;
}
.nav-logo span { background: linear-gradient(135deg, #6c63ff, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

/* Search */
.nav-search {
    flex: 1; max-width: 440px;
    display: flex; align-items: center;
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50px; overflow: hidden; transition: all 0.3s;
}
.nav-search:focus-within { border-color: rgba(108,99,255,0.6); background: rgba(108,99,255,0.06); box-shadow: 0 0 0 3px rgba(108,99,255,0.1); }
.nav-search i { padding: 0 14px; color: rgba(255,255,255,0.4); font-size: 14px; }
.nav-search input {
    flex: 1; background: transparent; border: none; outline: none;
    color: #fff; font-size: 14px; font-family: 'Inter', sans-serif;
    padding: 10px 0;
}
.nav-search input::placeholder { color: rgba(255,255,255,0.35); }
.nav-search-btn {
    padding: 8px 18px; background: linear-gradient(135deg, #6c63ff, #a855f7);
    border: none; color: #fff; font-size: 13px; font-weight: 600;
    cursor: pointer; font-family: 'Inter', sans-serif; transition: opacity 0.2s;
}
.nav-search-btn:hover { opacity: 0.85; }

/* Nav Links */
.nav-links { display: flex; align-items: center; gap: 4px; margin-left: auto; }
.nav-links a {
    padding: 8px 14px; color: rgba(255,255,255,0.72); font-size: 14px; font-weight: 500;
    border-radius: 8px; transition: all 0.2s;
}
.nav-links a:hover { color: #fff; background: rgba(255,255,255,0.07); }
.nav-links a.active { color: #6c63ff; }

/* Nav Actions */
.nav-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.nav-icon-btn {
    width: 40px; height: 40px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.7); font-size: 16px; cursor: pointer; transition: all 0.2s; position: relative;
}
.nav-icon-btn:hover { border-color: rgba(108,99,255,0.5); color: #6c63ff; background: rgba(108,99,255,0.08); }
.nav-badge {
    position: absolute; top: -5px; right: -5px;
    width: 18px; height: 18px; background: #ec4899; border-radius: 50%;
    font-size: 10px; font-weight: 700; color: #fff;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #0a0b0f;
}
.btn-upload {
    display: flex; align-items: center; gap: 7px;
    padding: 9px 18px; background: linear-gradient(135deg, #6c63ff, #a855f7);
    border: none; border-radius: 10px; color: #fff; font-size: 13px; font-weight: 600;
    font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(108,99,255,0.35);
}
.btn-upload:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(108,99,255,0.5); }
.btn-login {
    padding: 9px 18px; background: transparent; border: 1px solid rgba(255,255,255,0.15);
    border-radius: 10px; color: rgba(255,255,255,0.8); font-size: 13px; font-weight: 500;
    font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.2s;
}
.btn-login:hover { border-color: rgba(255,255,255,0.35); color: #fff; }

/* Avatar */
.nav-avatar { width: 36px; height: 36px; border-radius: 10px; overflow: hidden; cursor: pointer; border: 2px solid rgba(108,99,255,0.4); }
.nav-avatar img { width: 100%; height: 100%; object-fit: cover; }

/* Mobile toggle */
.nav-mobile-toggle { display: none; background: none; border: none; color: #fff; font-size: 20px; cursor: pointer; padding: 8px; }

/* Mobile Menu */
.mobile-menu {
    display: none;
    background: #111318; border-top: 1px solid rgba(255,255,255,0.07);
    padding: 16px 24px; flex-direction: column; gap: 8px;
}
.mobile-menu.open { display: flex; }
.mobile-menu a { padding: 10px 14px; color: rgba(255,255,255,0.75); font-size: 14px; border-radius: 8px; }
.mobile-menu a:hover { background: rgba(255,255,255,0.07); color: #fff; }

/* Sub-menu */
.nav-dropdown { position: relative; }
.nav-dropdown-menu {
    display: none; position: absolute; top: calc(100% + 10px); left: 0;
    background: #16181e; border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px; padding: 10px; min-width: 200px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5); z-index: 100;
}
.nav-dropdown:hover .nav-dropdown-menu { display: block; }
.nav-dropdown-menu a {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; color: rgba(255,255,255,0.75); border-radius: 8px; font-size: 13px;
    transition: all 0.2s;
}
.nav-dropdown-menu a:hover { background: rgba(108,99,255,0.08); color: #6c63ff; }
.nav-dropdown-menu a i { width: 18px; color: #6c63ff; }

@media (max-width: 900px) {
    .nav-search { display: none; }
    .nav-links { display: none; }
    .btn-upload span { display: none; }
    .nav-mobile-toggle { display: block; }
}
@media (max-width: 500px) {
    .nav-actions .btn-login { display: none; }
}
</style>

<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon"><i class="fa-solid fa-bolt-lightning"></i></div>
            Pixel<span>Vault</span>
        </a>

        <!-- Search -->
        <div class="nav-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search photos, videos, vectors…" id="navSearchInput">
            <button class="nav-search-btn">Search</button>
        </div>

        <!-- Nav Links -->
        <div class="nav-links">
            <div class="nav-dropdown">
                <a href="#">Browse <i class="fa-solid fa-chevron-down" style="font-size:10px;margin-left:3px;"></i></a>
                <div class="nav-dropdown-menu">
                    <a href="#"><i class="fa-regular fa-image"></i> Photos</a>
                    <a href="#"><i class="fa-solid fa-video"></i> Videos</a>
                    <a href="#"><i class="fa-solid fa-waveform-lines"></i> Audio</a>
                    <a href="#"><i class="fa-solid fa-pen-nib"></i> Vectors</a>
                    <a href="#"><i class="fa-solid fa-boxes-stacked"></i> 3D Assets</a>
                </div>
            </div>
            <a href="#">Pricing</a>
            <a href="#">Creators</a>
            <a href="#">Enterprise</a>
        </div>

        <!-- Actions -->
        <div class="nav-actions">
            @auth
                <a href="#" class="nav-icon-btn" title="Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="nav-badge">3</span>
                </a>
                <a href="#" class="nav-icon-btn" title="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span class="nav-badge">5</span>
                </a>
                <button class="btn-upload">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Upload</span>
                </button>
                <div class="nav-avatar">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=6c63ff&color=fff" alt="avatar">
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">Log In</a>
                <button class="btn-upload">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Start Selling</span>
                </button>
            @endauth
            <button class="nav-mobile-toggle" id="mobileToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#">Photos</a>
        <a href="#">Videos</a>
        <a href="#">Audio</a>
        <a href="#">Vectors</a>
        <a href="#">Pricing</a>
        <a href="#">Creators</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log In</a>
        @endauth
    </div>
</nav>

<script>
(function(){
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function(){
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });

    // Mobile toggle
    const toggle = document.getElementById('mobileToggle');
    const menu = document.getElementById('mobileMenu');
    if(toggle && menu) {
        toggle.addEventListener('click', function(){
            menu.classList.toggle('open');
            toggle.querySelector('i').className = menu.classList.contains('open')
                ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
        });
    }
})();
</script>
