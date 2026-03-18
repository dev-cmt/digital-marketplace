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
</head>

<body>
    <!-- Navbar / Header -->
    @include('frontend.partials.navbar')

    <!-- Main Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

    @stack('js')
</body>
</html>
