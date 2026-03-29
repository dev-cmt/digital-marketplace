<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! $seotags ?? '<title>PixelVault – Premium Digital Assets</title>' !!}
    {!! $breadcrumbs ?? '' !!}
    {!! $jsonld ?? '' !!}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Base Styles -->
    <style>
        :root {
            --bg-primary: #0a0b0f;
            --bg-secondary: #111318;
            --bg-card: #16181e;
            --bg-card-hover: #1e2029;
            --border-color: rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.15);
            --accent-1: #6c63ff;
            --accent-2: #ff6b6b;
            --accent-3: #43e97b;
            --accent-gradient: linear-gradient(135deg, #6c63ff 0%, #a855f7 50%, #ec4899 100%);
            --gold: #f59e0b;
            --text-primary: #f0f0f7;
            --text-secondary: #9397a8;
            --text-muted: #565b70;
            --font-main: 'Inter', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 22px;
            --radius-xl: 32px;
            --shadow-card: 0 8px 32px rgba(0,0,0,0.4);
            --shadow-glow: 0 0 60px rgba(108,99,255,0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-main);
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        main { min-height: 80vh; }

        a { text-decoration: none; color: inherit; }

        img { max-width: 100%; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb { background: var(--accent-1); border-radius: 3px; }

        /* Selection */
        ::selection { background: rgba(108,99,255,0.35); color: #fff; }

        /* Badge */
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.8px;
        }
        .badge-accent { background: rgba(108,99,255,0.18); color: var(--accent-1); border: 1px solid rgba(108,99,255,0.3); }
        .badge-gold { background: rgba(245,158,11,0.15); color: var(--gold); border: 1px solid rgba(245,158,11,0.3); }
        .badge-green { background: rgba(67,233,123,0.12); color: var(--accent-3); border: 1px solid rgba(67,233,123,0.25); }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 26px; border-radius: var(--radius-md); font-weight: 600;
            font-size: 14px; cursor: pointer; transition: var(--transition);
            border: none; font-family: var(--font-main);
        }
        .btn-primary {
            background: var(--accent-gradient); color: #fff;
            box-shadow: 0 4px 20px rgba(108,99,255,0.4);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(108,99,255,0.55); }
        .btn-outline {
            background: transparent; color: var(--text-primary);
            border: 1px solid var(--border-hover);
        }
        .btn-outline:hover { border-color: var(--accent-1); color: var(--accent-1); background: rgba(108,99,255,0.08); }
        .btn-lg { padding: 16px 36px; font-size: 16px; border-radius: var(--radius-lg); }
        .btn-sm { padding: 8px 18px; font-size: 13px; }

        /* Wishlist Floating Button */
        .wishlist-btn { position: absolute; top: 10px; right: 10px; width: 32px; height: 32px; border-radius: 50%; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; color: #fff; z-index: 3; cursor: pointer; transition: all 0.2s; }
        .wishlist-btn:hover { background: rgba(236,72,153,0.2); border-color: #ec4899; color: #ec4899; }
        .wishlist-btn i { font-size: 14px; transition: all 0.2s; }

        /* Section heading */
        .section-label {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;
            color: var(--accent-1); margin-bottom: 16px;
        }
        .section-label::before { content: ''; width: 24px; height: 2px; background: var(--accent-gradient); border-radius: 2px; }
        .section-title {
            font-family: var(--font-heading); font-size: clamp(28px, 4vw, 42px);
            font-weight: 800; line-height: 1.2; color: var(--text-primary);
        }
        .section-subtitle { font-size: 16px; color: var(--text-secondary); margin-top: 10px; line-height: 1.7; }
        .section-header { margin-bottom: 48px; }

        /* Container */
        .container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .section { padding: 96px 0; }

        /* Divider */
        .divider { height: 1px; background: var(--border-color); margin: 0; }

        /* Gradient Text */
        .gradient-text { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Glow orb */
        .glow-orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.18; pointer-events: none;
        }
        .orb-purple { background: radial-gradient(circle, #6c63ff, transparent 70%); }
        .orb-pink { background: radial-gradient(circle, #ec4899, transparent 70%); }
        .orb-teal { background: radial-gradient(circle, #43e97b, transparent 70%); }

        /* Animate fade-up */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-12px); } }
        @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
        @keyframes pulse-ring { 0% { transform: scale(1); opacity: 0.6; } 100% { transform: scale(1.5); opacity: 0; } }

        .fade-up { animation: fadeUp 0.7s ease forwards; }

        /* Responsive grid helpers */
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }

        @media(max-width: 1024px) {
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
            .grid-3 { grid-template-columns: repeat(2, 1fr); }
        }
        @media(max-width: 768px) {
            .container { padding: 0 16px; }
            .section { padding: 64px 0; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .btn-lg { padding: 14px 28px; font-size: 14px; }
        }
    </style>

    @stack('css')
    <style>
        #previewLightbox {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(10, 11, 15, 0.9); backdrop-filter: blur(20px);
            z-index: 10000; display: none; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s ease;
        }
        #previewLightbox.active { display: flex; opacity: 1; }
        .lightbox-content {
            position: relative; max-width: 90%; max-height: 90%;
            transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #previewLightbox.active .lightbox-content { transform: scale(1); }
        .lightbox-close {
            position: absolute; top: -50px; right: 0; color: #fff;
            font-size: 30px; cursor: pointer; transition: transform 0.2s;
        }
        .lightbox-close:hover { transform: scale(1.1); color: var(--accent-1); }
        .lightbox-media { border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); max-width: 100%; max-height: 80vh; }
    </style>
</head>

<body>
    <!-- Navbar / Header -->
    @include('frontend.partials.navbar')

    <!-- Notifications -->
    @if(session('error') || session('success'))
    <div style="position: fixed; top: 90px; right: 20px; z-index: 9999; min-width: 300px; animation: fadeUp 0.3s ease;">
        @if(session('error'))
        <div style="background: rgba(255, 107, 107, 0.95); backdrop-filter: blur(10px); color: #fff; padding: 16px 20px; border-radius: 12px; border-left: 5px solid #ff4757; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 12px;">
            <i class="fa-solid fa-circle-exclamation" style="font-size: 20px;"></i>
            <span style="font-weight: 600;">{{ session('error') }}</span>
        </div>
        @endif
        @if(session('success'))
        <div style="background: rgba(67, 233, 123, 0.95); backdrop-filter: blur(10px); color: #0a0b0f; padding: 16px 20px; border-radius: 12px; border-left: 5px solid #2ed573; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 12px;">
            <i class="fa-solid fa-circle-check" style="font-size: 20px;"></i>
            <span style="font-weight: 700;">{{ session('success') }}</span>
        </div>
        @endif
    </div>
    <script>setTimeout(() => { document.querySelector('[style*="z-index: 9999"]').style.display = 'none'; }, 5000);</script>
    @endif

    <!-- Main Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Global Preview Lightbox -->
    <div id="previewLightbox" onclick="closePreview(event)">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <span class="lightbox-close" onclick="closePreview()"><i class="fa-solid fa-xmark"></i></span>
            <div id="lightboxMediaContainer"></div>
        </div>
    </div>

    <!-- Footer -->
    @stack('js')

    <script>
        // Global Route URLs for AJAX
        const ROUTES = {
            wishlistToggle: "{{ route('wishlist.toggle') }}",
            cartAdd: "{{ route('cart.add') }}",
            login: "{{ route('login') }}"
        };

        function toggleWishlist(event, assetId, element) {
            if(event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const icon = element.querySelector('i');
            const badge = document.querySelector('a[title="Wishlist"] .nav-badge');
            
            fetch(ROUTES.wishlistToggle, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ asset_id: assetId })
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = ROUTES.login;
                    return Promise.reject('Unauthorized');
                }
                return response.json();
            })
            .then(data => {
                if(data.status === 'added') {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid');
                    icon.style.color = '#ec4899';
                    if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
                } else if(data.status === 'removed') {
                    icon.classList.remove('fa-solid');
                    icon.classList.add('fa-regular');
                    icon.style.color = '';
                    if (badge) badge.innerText = Math.max(0, parseInt(badge.innerText || 0) - 1);
                }
            })
            .catch(error => console.error('Error toggling wishlist:', error));
        }

        function openPreview(url, type) {
            const lightbox = document.getElementById('previewLightbox');
            const container = document.getElementById('lightboxMediaContainer');
            
            let html = '';
            if (type === 'video') {
                html = `<video class="lightbox-media" controls autoplay><source src="${url}" type="video/mp4"></video>`;
            } else if (type === 'audio') {
                html = `<div style="text-align:center; background:rgba(255,255,255,0.05); padding:40px; border-radius:12px;"><i class="fa-solid fa-music" style="font-size:80px; color:var(--accent-1); margin-bottom:20px;"></i><br><audio controls autoplay style="width:100%"><source src="${url}" type="audio/mpeg"></audio></div>`;
            } else {
                html = `<img src="${url}" class="lightbox-media">`;
            }

            container.innerHTML = html;
            lightbox.style.display = 'flex';
            setTimeout(() => lightbox.classList.add('active'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closePreview() {
            const lightbox = document.getElementById('previewLightbox');
            lightbox.classList.remove('active');
            setTimeout(() => {
                lightbox.style.display = 'none';
                document.getElementById('lightboxMediaContainer').innerHTML = '';
            }, 300);
            document.body.style.overflow = '';
        }

        function shareAsset(title) {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: title + ' - PixelVault',
                    url: url
                }).catch(err => console.error('Error sharing:', err));
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        }

        function addToCart(event, assetId, buttonElement) {
            if(event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const originalText = buttonElement.innerHTML;
            buttonElement.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Adding...';
            buttonElement.disabled = true;

            fetch(ROUTES.cartAdd, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ asset_id: assetId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success' || data.status === 'exists') {
                    const badge = document.querySelector('a[title="Cart"] .nav-badge');
                    if (badge && data.total_items !== undefined) {
                        badge.innerText = data.total_items;
                    }
                    buttonElement.innerHTML = '<i class="fa-solid fa-check"></i> Added';
                    setTimeout(() => {
                        buttonElement.innerHTML = originalText;
                        buttonElement.disabled = false;
                    }, 2000);
                } else {
                    alert(data.message || 'Error adding to cart');
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                buttonElement.innerHTML = originalText;
                buttonElement.disabled = false;
            });
        }
    </script>
</body>
</html>
