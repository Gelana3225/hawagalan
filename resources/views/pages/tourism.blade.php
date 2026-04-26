@extends('layouts.app')

@section('title', 'Tourism – Haawwaa Galaan')

@section('content')

<style>
/* Hero */
.tourism-hero {
    background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    color: white;
    text-align: center;
    padding: 160px 0 120px;
    position: relative;
    overflow: hidden;
    margin-top: 80px;
}
.tourism-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 20% 50%, rgba(120,80,255,0.15) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(0,200,255,0.1) 0%, transparent 50%);
}
.tourism-hero-content { position: relative; z-index: 2; max-width: 800px; margin: 0 auto; padding: 0 20px; }
.tourism-hero h1 {
    font-size: clamp(2.2rem, 5vw, 4rem);
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 0 3px 20px rgba(0,0,0,0.5);
    letter-spacing: -0.5px;
}
.tourism-hero p { font-size: 1.2rem; opacity: 0.85; line-height: 1.7; }
.tourism-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.25);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 25px;
    backdrop-filter: blur(10px);
}

/* Floating particles */
.particle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    animation: floatUp 8s infinite ease-in-out;
}
@keyframes floatUp {
    0%,100% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { transform: translateY(-30px) scale(1.1); opacity: 0.6; }
}

/* Cards grid */
.tourism-section {
    background: #f8fafc;
    padding: 60px 20px 80px;
}
.tourism-grid {
    max-width: 1300px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

/* Card */
.tourism-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transform: translateY(50px);
    opacity: 0;
    transition: transform 0.7s cubic-bezier(0.34,1.56,0.64,1), opacity 0.6s ease, box-shadow 0.3s ease;
    position: relative;
}
.tourism-card.visible {
    transform: translateY(0);
    opacity: 1;
}
.tourism-card:hover {
    box-shadow: 0 20px 60px rgba(48,43,99,0.2);
    transform: translateY(-8px);
}

/* Image area */
.tourism-card-img {
    position: relative;
    height: 260px;
    overflow: hidden;
}
.tourism-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
    display: block;
}
.tourism-card:hover .tourism-card-img img { transform: scale(1.08); }

/* Placeholder */
.tourism-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #302b63, #24243e);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.tourism-placeholder i { font-size: 3rem; color: rgba(255,255,255,0.3); }
.tourism-placeholder span { color: rgba(255,255,255,0.5); font-size: 0.85rem; }

/* Category badge */
.tourism-category {
    position: absolute;
    top: 16px;
    right: 16px;
    background: rgba(48,43,99,0.85);
    color: white;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

/* Shimmer overlay on hover */
.tourism-card-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.08) 50%, transparent 60%);
    background-size: 200% 200%;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.tourism-card:hover .tourism-card-img::after { opacity: 1; }

/* Content */
.tourism-card-body {
    padding: 28px;
}
.tourism-card-body h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
    line-height: 1.3;
}
.tourism-card-body p {
    color: #6b7280;
    line-height: 1.7;
    font-size: 0.95rem;
    margin-bottom: 18px;
}

/* Feature tags */
.feature-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.feature-tag {
    background: #f3f4f6;
    color: #374151;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
}
.tourism-card:hover .feature-tag {
    background: #ede9fe;
    color: #5b21b6;
    border-color: #c4b5fd;
}

/* Divider line */
.card-divider {
    height: 3px;
    background: linear-gradient(90deg, #302b63, #764ba2, #667eea);
    border-radius: 0 0 3px 3px;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.tourism-card:hover .card-divider { transform: scaleX(1); }

/* Section header */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}
.section-header h2 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 10px;
}
.section-header p { color: #6b7280; font-size: 1rem; }
.section-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #302b63, #667eea);
    border-radius: 4px;
    margin: 15px auto 0;
}

@media (max-width: 768px) {
    .tourism-grid { grid-template-columns: 1fr; }
    .tourism-card-img { height: 200px; }
}
</style>

<!-- Hero -->
<section class="tourism-hero">
    <!-- Floating particles -->
    <div class="particle" style="width:8px;height:8px;top:20%;left:10%;animation-delay:0s;"></div>
    <div class="particle" style="width:5px;height:5px;top:60%;left:20%;animation-delay:2s;"></div>
    <div class="particle" style="width:10px;height:10px;top:30%;right:15%;animation-delay:1s;"></div>
    <div class="particle" style="width:6px;height:6px;top:70%;right:25%;animation-delay:3s;"></div>
    <div class="particle" style="width:4px;height:4px;top:50%;left:50%;animation-delay:1.5s;"></div>

    <div class="tourism-hero-content">
        <div class="tourism-badge">
            <i class="fas fa-mountain"></i>
            Tuurizimii fi Aadaa
        </div>
        <h1>{{ $hero['title'] ?? 'Tuurizimii fi Aadaa Aanaa Haawwaa Galaan' }}</h1>
        @if($hero->has('subtitle') && $hero['subtitle'])
        <p>{{ $hero['subtitle'] }}</p>
        @else
        <p>Iddoowwan hawwatamoo, aadaa fi seenaa Aanaa Haawwaa Galaan daawwadhaa</p>
        @endif
    </div>
</section>

<!-- Stats bar -->
<div style="background:white;padding:20px 0;border-bottom:1px solid #e5e7eb;box-shadow:0 2px 10px rgba(0,0,0,0.04);">
    <div style="max-width:1300px;margin:0 auto;padding:0 20px;display:flex;align-items:center;justify-content:center;gap:50px;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:10px;color:#302b63;">
            <i class="fas fa-map-marker-alt" style="font-size:1.3rem;"></i>
            <span style="font-weight:700;font-size:1.1rem;">{{ $attractions->count() }}</span>
            <span style="color:#6b7280;font-size:0.9rem;">Iddoowwan Tuurizimii</span>
        </div>
        <div style="width:1px;height:30px;background:#e5e7eb;"></div>
        <div style="display:flex;align-items:center;gap:10px;color:#302b63;">
            <i class="fas fa-camera" style="font-size:1.3rem;"></i>
            <span style="color:#6b7280;font-size:0.9rem;">Aadaa fi Seenaa</span>
        </div>
        <div style="width:1px;height:30px;background:#e5e7eb;"></div>
        <div style="display:flex;align-items:center;gap:10px;color:#302b63;">
            <i class="fas fa-star" style="font-size:1.3rem;color:#f59e0b;"></i>
            <span style="color:#6b7280;font-size:0.9rem;">Hawwatamummaa Olaanaa</span>
        </div>
    </div>
</div>

<!-- Attractions -->
@if($attractions->isNotEmpty())
<section class="tourism-section">
    <div class="section-header">
        <h2>Iddoowwan Hawwatamoo</h2>
        <p>Aanaa Haawwaa Galaan keessatti argaman daawwadhaa</p>
        <div class="section-line"></div>
    </div>

    <div class="tourism-grid">
        @foreach($attractions as $index => $attraction)
        <div class="tourism-card" style="transition-delay: {{ ($index % 3) * 0.12 }}s;" data-animate>
            <div class="card-divider"></div>
            <div class="tourism-card-img">
                @if($attraction->image)
                <img src="{{ asset('images/'.$attraction->image) }}"
                     alt="{{ $attraction->name }}"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="tourism-placeholder" style="display:none;">
                    <i class="fas fa-mountain"></i>
                    <span>Upload photo from admin</span>
                </div>
                @else
                <div class="tourism-placeholder">
                    <i class="fas fa-mountain"></i>
                    <span>Upload photo from admin</span>
                </div>
                @endif
                @if($attraction->category)
                <span class="tourism-category">
                    <i class="fas fa-tag" style="margin-right:4px;font-size:0.7rem;"></i>
                    {{ $attraction->category }}
                </span>
                @endif
            </div>
            <div class="tourism-card-body">
                <h3>{{ $attraction->name }}</h3>
                @if($attraction->description)
                <p>{{ Str::limit($attraction->description, 120) }}</p>
                @endif
                @if($attraction->features && count($attraction->features) > 0)
                <div class="feature-tags">
                    @foreach($attraction->features as $feature)
                    <span class="feature-tag">
                        <i class="fas fa-check" style="font-size:0.65rem;margin-right:4px;"></i>
                        {{ $feature }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@else
<div style="padding:100px 20px;text-align:center;background:#f8fafc;">
    <i class="fas fa-mountain" style="font-size:4rem;color:#c4b5fd;margin-bottom:20px;display:block;"></i>
    <h3 style="color:#302b63;font-size:1.5rem;margin-bottom:10px;">Iddoowwan tuurizimii hin argamne</h3>
    <p style="color:#6b7280;">Admin irraa iddoowwan tuurizimii galchi.</p>
</div>
@endif

<script>
const cards = document.querySelectorAll('[data-animate]');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
cards.forEach(card => observer.observe(card));
</script>

{{-- Biography Teaser Section --}}
@php
$bioContent = \App\Models\PageSection::where('page','biography')->pluck('value','key');
$bioIntro = $bioContent['intro'] ?? 'Goota beekamaa fi Uummata isaa biratti jaallatamaa nama tureedha. Goosaan maqaa farda isaa yammuu ta\'u inni sirriin maqaan isaa Buraayyuu Barii Oofaati. Bakki inni itti dhalatee guddate Godina Qellem Wallaggaa Aanaa Hawwaa Galaan ganda Gabaa Sanbata Duraa keessattidha.';
$bioImage = $bioContent['profile_image'] ?? null;
@endphp

<section style="padding: 80px 0; background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #1d4ed8 100%); color: white; position: relative; overflow: hidden;">
    {{-- Background pattern --}}
    <div style="position:absolute;inset:0;opacity:0.05;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'white\'%3E%3Ccircle cx=\'10\' cy=\'10\' r=\'2\'/%3E%3Ccircle cx=\'50\' cy=\'20\' r=\'1\'/%3E%3Ccircle cx=\'30\' cy=\'50\' r=\'1.5\'/%3E%3C/g%3E%3C/svg%3E');"></div>

    <div style="max-width:1100px;margin:0 auto;padding:0 20px;position:relative;z-index:2;">
        <div class="bio-teaser-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;">

            {{-- Left: Text --}}
            <div>
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);padding:6px 16px;border-radius:50px;font-size:0.85rem;font-weight:500;margin-bottom:20px;">
                    <i class="fas fa-star" style="color:#fbbf24;"></i>
                    Goota Seenaa
                </div>
                <h2 style="font-size:2.5rem;font-weight:800;margin-bottom:15px;line-height:1.2;">
                    Buraayyuu Abbaa Goosaa
                </h2>
                <p style="font-size:1rem;opacity:0.85;line-height:1.8;margin-bottom:30px;">
                    {{ Str::limit($bioIntro, 250) }}
                </p>
                <div style="display:flex;gap:15px;flex-wrap:wrap;">
                    <a href="{{ route('biography') }}"
                       style="display:inline-flex;align-items:center;gap:10px;background:white;color:#1e3a8a;padding:14px 28px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.95rem;box-shadow:0 4px 15px rgba(0,0,0,0.2);transition:all 0.3s ease;"
                       onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(0,0,0,0.3)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(0,0,0,0.2)'">
                        <i class="fas fa-book-open"></i>
                        Seenaa Guutuu Dubbisi
                    </a>
                    <a href="{{ route('biography') }}"
                       style="display:inline-flex;align-items:center;gap:10px;background:transparent;color:white;padding:14px 28px;border-radius:50px;font-weight:600;text-decoration:none;font-size:0.95rem;border:2px solid rgba(255,255,255,0.6);transition:all 0.3s ease;"
                       onmouseover="this.style.background='rgba(255,255,255,0.15)'"
                       onmouseout="this.style.background='transparent'">
                        <i class="fas fa-arrow-right"></i>
                        Biography Page
                    </a>
                </div>

                {{-- Quick stats --}}
                <div style="display:flex;gap:30px;margin-top:35px;flex-wrap:wrap;">
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#fbbf24;">19ffaa</div>
                        <div style="font-size:0.85rem;opacity:0.75;">Jaarraa</div>
                    </div>
                    <div style="width:1px;background:rgba(255,255,255,0.2);"></div>
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#fbbf24;">Haawwaa</div>
                        <div style="font-size:0.85rem;opacity:0.75;">Galaan</div>
                    </div>
                    <div style="width:1px;background:rgba(255,255,255,0.2);"></div>
                    <div>
                        <div style="font-size:1.8rem;font-weight:800;color:#fbbf24;">Goota</div>
                        <div style="font-size:0.85rem;opacity:0.75;">Seenaa</div>
                    </div>
                </div>
            </div>

            {{-- Right: Photo --}}
            <div style="display:flex;justify-content:center;">
                <div style="position:relative;">
                    {{-- Decorative ring --}}
                    <div style="position:absolute;inset:-15px;border-radius:50%;border:2px solid rgba(255,255,255,0.2);"></div>
                    <div style="position:absolute;inset:-30px;border-radius:50%;border:1px solid rgba(255,255,255,0.1);"></div>

                    @if($bioImage)
                    <img src="{{ asset('images/'.$bioImage) }}" alt="Buraayyuu Abbaa Goosaa"
                         style="width:280px;height:340px;object-fit:cover;border-radius:20px;box-shadow:0 20px 50px rgba(0,0,0,0.4);display:block;"
                         onerror="this.style.display='none'">
                    @else
                    <div style="width:280px;height:340px;background:rgba(255,255,255,0.1);border-radius:20px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:15px;border:2px solid rgba(255,255,255,0.2);">
                        <i class="fas fa-user" style="font-size:5rem;color:rgba(255,255,255,0.3);"></i>
                        <span style="color:rgba(255,255,255,0.5);font-size:0.85rem;text-align:center;padding:0 20px;">Upload photo from<br>Admin → Biography</span>
                    </div>
                    @endif

                    {{-- Badge --}}
                    <div style="position:absolute;bottom:-15px;left:50%;transform:translateX(-50%);background:#fbbf24;color:#1e3a8a;padding:8px 20px;border-radius:20px;font-size:0.85rem;font-weight:700;white-space:nowrap;box-shadow:0 4px 15px rgba(0,0,0,0.2);">
                        <i class="fas fa-star" style="margin-right:5px;"></i> Goota Seenaa
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media(max-width:768px){
    .tourism-grid { grid-template-columns: 1fr !important; }
    .tourism-card-img { height: 200px !important; }
    .bio-teaser-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
    .bio-teaser-grid > div:last-child {
        display: flex;
        justify-content: center;
    }
    /* Fix stats row overflow */
    .bio-teaser-grid div[style*="display: flex"][style*="gap: 30px"] {
        flex-wrap: wrap !important;
        gap: 15px !important;
    }
    /* Fix buttons wrapping */
    .bio-teaser-grid div[style*="display: flex"][style*="gap: 15px"] {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
}
</style>

@endsection
