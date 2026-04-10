<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Haawwaa Galaan')</title>
    <meta name="description" content="@yield('description', 'Aanaa Haawwaa Galaan – seenaa, tajaajiloota, hoggantoota, aadaa fi tuurizimii.')">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    /* ===== GLOBAL MOBILE RESPONSIVENESS ===== */
    *, *::before, *::after { box-sizing: border-box; }
    img { max-width: 100%; height: auto; }

    /* ── Nav mobile ── */
    @media (max-width: 768px) {
        #hamburger { display: flex !important; }
        #nav-menu {
            display: none !important;
            position: fixed; top: 80px; left: 0; right: 0; bottom: 0;
            background: white;
            flex-direction: column !important;
            padding: 15px 20px; gap: 4px !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-top: 1px solid #e5e7eb;
            overflow-y: auto; z-index: 9999;
        }
        #nav-menu.open { display: flex !important; }
        #nav-menu a {
            color: #374151 !important;
            padding: 14px 20px !important;
            border-radius: 10px !important;
            font-size: 1.05rem !important;
            border-bottom: 1px solid #f3f4f6;
            min-height: 44px;
            display: flex !important; align-items: center;
            background: rgba(255,255,255,0.9) !important;
        }
        #nav-menu a:active { background: #eff6ff !important; }
    }

    /* ── Home page sections ── */
    .resp-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    .resp-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .resp-grid-auto { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; }

    @media (max-width: 768px) {
        .resp-grid-2 { grid-template-columns: 1fr !important; gap: 25px !important; }
        .resp-grid-3 { grid-template-columns: 1fr 1fr !important; gap: 15px !important; }
        .resp-grid-auto { grid-template-columns: 1fr !important; }

        /* Leaders grid */
        #leaders > div > div { grid-template-columns: 1fr !important; }

        /* Services grid */
        #services > div > div { grid-template-columns: 1fr !important; }

        /* News grid */
        #news > div > div { grid-template-columns: 1fr !important; }

        /* Contact 2-col */
        #contact > div > div[style*="grid-template-columns: 1fr 1fr"] {
            display: flex !important; flex-direction: column !important; gap: 30px !important;
        }

        /* Invitation cards */
        section > div > div[style*="grid-template-columns: 1fr 1fr"] {
            display: flex !important; flex-direction: column !important; gap: 25px !important;
        }

        /* About 2-col */
        #about > div > div[style*="grid-template-columns: 1fr 1fr"] {
            display: flex !important; flex-direction: column !important; gap: 25px !important;
        }

        /* Charity gallery */
        #charity > div > div[style*="grid-template-columns: repeat(3"] {
            grid-template-columns: 1fr 1fr !important;
        }

        /* Hospital facilities */
        #hospital > div > div[style*="grid-template-columns: repeat(3"] {
            grid-template-columns: 1fr 1fr !important;
        }
        #hospital > div > div[style*="grid-template-columns: 1fr 1fr"] {
            display: flex !important; flex-direction: column !important;
        }

        /* Football gallery */
        #football-championship > div > div[style*="grid-template-columns: repeat(3"] {
            grid-template-columns: 1fr 1fr !important;
        }
        #football-championship > div > div[style*="grid-template-columns: 1fr 1fr"] {
            display: flex !important; flex-direction: column !important;
        }

        /* Hero slider arrows */
        #home > button { width: 38px !important; height: 38px !important; font-size: 1rem !important; }

        /* Read More button - ensure touch target */
        .attraction-link {
            display: inline-block !important;
            padding: 10px 0 !important;
            min-height: 44px !important;
            line-height: 44px !important;
            cursor: pointer !important;
        }

        /* Farming page */
        .farming-grid { grid-template-columns: 1fr !important; }
        .farm-card { height: 260px !important; }

        /* Tourism page */
        .tourism-grid { grid-template-columns: 1fr !important; }

        /* Biography */
        .bio-profile { grid-template-columns: 1fr !important; text-align: center !important; }
        .bio-main-img { width: 180px !important; height: 220px !important; }
        .ach-grid { grid-template-columns: 1fr !important; }
    }

    @media (max-width: 480px) {
        .resp-grid-3 { grid-template-columns: 1fr !important; }
        #charity > div > div[style*="grid-template-columns: repeat(3"] { grid-template-columns: 1fr !important; }
        #hospital > div > div[style*="grid-template-columns: repeat(3"] { grid-template-columns: 1fr !important; }
        #football-championship > div > div[style*="grid-template-columns: repeat(3"] { grid-template-columns: 1fr !important; }

        /* Prevent iOS input zoom */
        input, textarea, select { font-size: 16px !important; }

        /* Padding */
        section > div { padding-left: 15px !important; padding-right: 15px !important; }
        .bio-box { padding: 20px !important; }
    }

    /* Touch-friendly tap targets */
    @media (hover: none) and (pointer: coarse) {
        .attraction-link {
            padding: 12px 0 !important;
            min-height: 48px !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        a, button { min-height: 44px; }
    }

    /* Hero slider mobile fixes */
    @media (max-width: 768px) {
        #home { overflow: hidden !important; }
        /* Move arrows to bottom on mobile */
        #home > button:first-of-type,
        #home > button:last-of-type {
            top: auto !important;
            bottom: 60px !important;
            transform: none !important;
            width: 36px !important;
            height: 36px !important;
        }
        #home > button:first-of-type { left: calc(50% - 50px) !important; }
        #home > button:last-of-type { right: calc(50% - 50px) !important; }
    }
    /* Prevent dot buttons from being stretched */
    #hero-dots button {
        min-height: 11px !important;
        width: 11px !important;
        height: 11px !important;
        border-radius: 50% !important;
        padding: 0 !important;
        flex-shrink: 0 !important;
    }

    /* About section responsive */
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    @media (max-width: 768px) {
        .about-grid {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        /* Fix all inline grid-template-columns: 1fr 1fr on mobile */
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
        /* Fix text overflow */
        * { word-wrap: break-word; overflow-wrap: break-word; }
        /* Fix max-width containers */
        [style*="max-width: 1200px"] { padding-left: 15px !important; padding-right: 15px !important; }
    }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>

