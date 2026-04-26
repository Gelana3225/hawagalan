@extends('layouts.app')

@section('title', 'Farming – Haawwaa Galaan')

@section('content')

<style>
/* Hero */
.farming-hero {
    background: linear-gradient(135deg, #052e16 0%, #166534 50%, #15803d 100%);
    color: white;
    text-align: center;
    padding: 160px 0 100px;
    position: relative;
    overflow: hidden;
    margin-top: 80px;
}
.farming-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.farming-hero-content { position: relative; z-index: 2; }
.farming-hero h1 {
    font-size: clamp(2.2rem, 5vw, 4rem);
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 0 3px 20px rgba(0,0,0,0.4);
    letter-spacing: -0.5px;
}
.farming-hero p {
    font-size: 1.2rem;
    opacity: 0.85;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 25px;
    backdrop-filter: blur(10px);
}

/* Section divider */
.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 0 10px;
    background: #f0fdf4;
}
.section-divider span {
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #16a34a, #4ade80);
    border-radius: 3px;
    margin: 0 10px;
}
.section-divider i { color: #16a34a; font-size: 1.2rem; }

/* Grid section */
.farming-grid-section {
    background: #f0fdf4;
    padding: 0 20px 40px;
}
.farming-grid {
    max-width: 1300px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Card */
.farm-card {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    height: 420px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    cursor: pointer;
    transform: translateY(40px);
    opacity: 0;
    transition: transform 0.6s cubic-bezier(0.34,1.56,0.64,1), opacity 0.6s ease, box-shadow 0.3s ease;
}
.farm-card.visible {
    transform: translateY(0);
    opacity: 1;
}
.farm-card:hover {
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    transform: translateY(-6px) scale(1.01);
}
.farm-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
    display: block;
}
.farm-card:hover img { transform: scale(1.08); }

/* Placeholder */
.farm-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #166534, #15803d);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.farm-placeholder i { font-size: 3.5rem; color: rgba(255,255,255,0.4); }
.farm-placeholder span { color: rgba(255,255,255,0.6); font-size: 0.9rem; }

/* Overlay */
.farm-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
    transition: background 0.3s ease;
}
.farm-card:hover .farm-overlay {
    background: linear-gradient(to top, rgba(5,46,22,0.9) 0%, rgba(5,46,22,0.3) 60%, transparent 100%);
}

/* Label */
.farm-label {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 30px 25px 25px;
    color: white;
    transform: translateY(0);
    transition: transform 0.3s ease;
}
.farm-label h2 {
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0 0 6px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    line-height: 1.2;
}
.farm-label .farm-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(74,222,128,0.25);
    border: 1px solid rgba(74,222,128,0.4);
    color: #bbf7d0;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease 0.1s, transform 0.3s ease 0.1s;
}
.farm-card:hover .farm-tag {
    opacity: 1;
    transform: translateY(0);
}

/* Number badge */
.farm-number {
    position: absolute;
    top: 18px;
    left: 18px;
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.85rem;
    font-weight: 700;
}

/* Responsive */
@media (max-width: 768px) {
    .farming-grid { grid-template-columns: 1fr; }
    .farm-card { height: 300px; }
    .farm-label h2 { font-size: 1.3rem; }
}
</style>

<!-- Hero -->
<section class="farming-hero">
    <div class="farming-hero-content" style="max-width:800px;margin:0 auto;padding:0 20px;">
        <div class="hero-badge">
            <i class="fas fa-seedling"></i>
            Aanaa Haawwaa Galaan
        </div>
        <h1>{{ $hero['title'] ?? 'Hojiiwwan Damee Qonnaa Aanichaa' }}</h1>
        @if($hero->has('subtitle') && $hero['subtitle'])
        <p>{{ $hero['subtitle'] }}</p>
        @else
        <p>Qonnaan bultoota Aanaa Haawwaa Galaan oomishaalee garaa garaa omishaa jiru</p>
        @endif
    </div>
</section>

@if($items->isNotEmpty())

<!-- Stats bar -->
<div style="background:white;padding:20px 0;border-bottom:1px solid #e5e7eb;">
    <div style="max-width:1300px;margin:0 auto;padding:0 20px;display:flex;align-items:center;justify-content:center;gap:40px;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:10px;color:#166534;">
            <i class="fas fa-leaf" style="font-size:1.3rem;"></i>
            <span style="font-weight:700;font-size:1.1rem;">{{ $items->count() }}</span>
            <span style="color:#6b7280;font-size:0.9rem;">Oomishaalee</span>
        </div>
        <div style="width:1px;height:30px;background:#e5e7eb;"></div>
        <div style="display:flex;align-items:center;gap:10px;color:#166534;">
            <i class="fas fa-map-marker-alt" style="font-size:1.3rem;"></i>
            <span style="color:#6b7280;font-size:0.9rem;">Aanaa Haawwaa Galaan, Qellem Wallaggaa</span>
        </div>
        <div style="width:1px;height:30px;background:#e5e7eb;"></div>
        <div style="display:flex;align-items:center;gap:10px;color:#166534;">
            <i class="fas fa-sun" style="font-size:1.3rem;"></i>
            <span style="color:#6b7280;font-size:0.9rem;">Haala qilleensaa mijataa</span>
        </div>
    </div>
</div>

<!-- Grid -->
<div class="farming-grid-section">
    <div class="section-divider">
        <span></span>
        <i class="fas fa-seedling"></i>
        <span></span>
    </div>
    <div style="text-align:center;padding:20px 0 30px;">
        <h2 style="font-size:1.8rem;font-weight:700;color:#166534;margin:0;">Oomishaalee Aanichaa</h2>
        <p style="color:#6b7280;margin-top:8px;font-size:0.95rem;">Scroll gadi buusaa oomishaawwan hunda ilaalaa</p>
    </div>

    <div class="farming-grid">
        @foreach($items as $index => $item)
        <div class="farm-card" style="transition-delay: {{ ($index % 4) * 0.1 }}s;" data-animate>
            @if($item->image)
            <img src="{{ asset('images/'.$item->image) }}"
                 alt="{{ $item->alt_text ?: $item->label }}"
                 onerror="this.parentElement.querySelector('.farm-placeholder') && (this.style.display='none')">
            @else
            <div class="farm-placeholder">
                <i class="fas fa-seedling"></i>
                <span>Upload photo from admin</span>
            </div>
            @endif
            <div class="farm-overlay"></div>
            <div class="farm-number">{{ $index + 1 }}</div>
            <div class="farm-label">
                <h2>{{ $item->label }}</h2>
                <span class="farm-tag">
                    <i class="fas fa-leaf"></i>
                    Qonnaa
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>

@else
<div style="padding:100px 20px;text-align:center;background:#f0fdf4;">
    <i class="fas fa-seedling" style="font-size:4rem;color:#bbf7d0;margin-bottom:20px;display:block;"></i>
    <h3 style="color:#166534;font-size:1.5rem;margin-bottom:10px;">Oomishaaleen hin argamne</h3>
    <p style="color:#6b7280;">Admin irraa oomishaawwan fi suuraalee galchi.</p>
</div>
@endif

<script>
// Intersection Observer for scroll animations
const cards = document.querySelectorAll('[data-animate]');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

cards.forEach(card => observer.observe(card));
</script>

@endsection
