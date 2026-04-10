<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – Haawwaa Galaan CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100" style="padding-top: 0;">
<div style="display: flex; min-height: 100vh;">

    <!-- Sidebar -->
    <aside style="width: 260px; background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%); color: white; flex-shrink: 0; position: fixed; top: 0; left: 0; bottom: 0; overflow-y: auto; z-index: 100;">
        <div style="padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <h1 style="font-size: 1.1rem; font-weight: 700; margin: 0; letter-spacing: 1px;">HAAWWAA GALAAN</h1>
            <p style="font-size: 0.8rem; opacity: 0.7; margin: 4px 0 0;">Content Management</p>
        </div>

        <nav style="padding: 15px 0;">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'icon' => 'fas fa-tachometer-alt', 'label' => 'Dashboard'],
                    ['route' => 'admin.hero.slides', 'icon' => 'fas fa-images', 'label' => 'Hero Slideshow'],
                    ['route' => 'admin.hospital.photos', 'icon' => 'fas fa-hospital', 'label' => 'Hospital Photos'],
                    ['route' => 'admin.football.photos', 'icon' => 'fas fa-futbol', 'label' => 'Football Gallery'],
                    ['route' => 'admin.sections.index', 'icon' => 'fas fa-file-alt', 'label' => 'Page Sections'],
                    ['route' => 'admin.leaders.index', 'icon' => 'fas fa-users', 'label' => 'Leaders'],
                    ['route' => 'admin.services.index', 'icon' => 'fas fa-cogs', 'label' => 'Services'],
                    ['route' => 'admin.farming.index', 'icon' => 'fas fa-seedling', 'label' => 'Farming Items'],
                    ['route' => 'admin.tourism.index', 'icon' => 'fas fa-mountain', 'label' => 'Tourism'],
                    ['route' => 'admin.news.index', 'icon' => 'fas fa-newspaper', 'label' => 'News Posts'],
                    ['route' => 'admin.contact.edit', 'icon' => 'fas fa-address-book', 'label' => 'Contact Info'],
                    ['route' => 'admin.media.index', 'icon' => 'fas fa-photo-video', 'label' => 'Media Library'],
                ];
            @endphp

            @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.95rem; transition: all 0.2s; {{ request()->routeIs($item['route']) ? 'background: rgba(255,255,255,0.15); color: white; border-right: 3px solid white;' : '' }}">
                <i class="{{ $item['icon'] }}" style="width: 18px; text-align: center;"></i>
                {{ $item['label'] }}
            </a>
            @endforeach

            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;"></div>

            <a href="{{ route('home') }}" target="_blank"
               style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">
                <i class="fas fa-external-link-alt" style="width: 18px; text-align: center;"></i>
                View Site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: rgba(255,255,255,0.7); background: none; border: none; cursor: pointer; font-size: 0.9rem; width: 100%; text-align: left;">
                    <i class="fas fa-sign-out-alt" style="width: 18px; text-align: center;"></i>
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div style="margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh;">
        <!-- Top Bar -->
        <header style="background: white; padding: 15px 30px; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 1.1rem; font-weight: 600; color: #1f2937; margin: 0;">@yield('title', 'Dashboard')</h2>
            <span style="font-size: 0.9rem; color: #6b7280;">{{ auth()->user()->name ?? 'Admin' }}</span>
        </header>

        <!-- Flash Messages -->
        <div style="padding: 0 30px; margin-top: 20px;">
            @if(session('success'))
            <div style="background: #d1fae5; border: 1px solid #6ee7b7; color: #065f46; padding: 14px 20px; border-radius: 10px; display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 14px 20px; border-radius: 10px; display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
            @endif
        </div>

        <!-- Page Content -->
        <main style="padding: 20px 30px 40px; flex: 1;">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

