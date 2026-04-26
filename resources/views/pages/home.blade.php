@extends('layouts.app')

@section('title', 'Haawwaa Galaan – Baga Nagaan Dhuftan')

@section('content')
<!-- Hero Slideshow Section -->
@php
$slides = \App\Models\PageSection::where('page','home')->where('section','hero_slides')->orderBy('key')->get();
$heroTitle = \App\Models\PageSection::get('home','hero','title') ?? 'AANAA HAAWWAA GALAAN';
$heroSubtitle = \App\Models\PageSection::get('home','hero','subtitle') ?? 'BAGA GARA BULCHIINSA AANAA HAAWWAA GALAAN NAGAAN DHUFTAN!';
$defaultSlides = ['linear-gradient(135deg,#1e3a8a 0%,#3b82f6 100%)','linear-gradient(135deg,#1e40af 0%,#1d4ed8 100%)','linear-gradient(135deg,#0f172a 0%,#1e3a8a 50%,#3b82f6 100%)'];
$slideCount = $slides->count() > 0 ? $slides->count() : 3;
@endphp

<section id="home" style="position:relative;width:100%;height:100vh;overflow:hidden;">

    {{-- Slides stacked with opacity transition --}}
    <div id="hero-slides-wrap" style="position:absolute;inset:0;">
        @if($slides->count() > 0)
            @foreach($slides as $i => $slide)
            <div class="hero-slide" style="position:absolute;inset:0;opacity:{{ $i===0?'1':'0' }};transition:opacity 0.8s ease;background:url('{{ asset('images/'.$slide->value) }}') center/cover no-repeat;"></div>
            @endforeach
        @else
            @foreach($defaultSlides as $i => $grad)
            <div class="hero-slide" style="position:absolute;inset:0;opacity:{{ $i===0?'1':'0' }};transition:opacity 0.8s ease;background:{{ $grad }};"></div>
            @endforeach
        @endif
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.4);z-index:1;"></div>
    </div>

    {{-- Text overlay --}}
    <div style="position:absolute;inset:0;z-index:10;display:flex;align-items:center;justify-content:center;text-align:center;padding:80px 20px 80px;">
        <div style="max-width:800px;width:100%;">
            <h1 style="font-size:clamp(1.8rem,5vw,4rem);font-weight:700;color:white;margin-bottom:20px;text-shadow:0 2px 15px rgba(0,0,0,0.4);line-height:1.2;">{{ $heroTitle }}</h1>
            <p style="font-size:clamp(0.95rem,2.5vw,1.4rem);color:rgba(255,255,255,0.92);margin-bottom:35px;line-height:1.6;text-shadow:0 1px 8px rgba(0,0,0,0.3);">{{ $heroSubtitle }}</p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="#about" style="background:white;color:#1e3a8a;padding:12px 28px;border-radius:50px;font-weight:600;text-decoration:none;box-shadow:0 4px 15px rgba(0,0,0,0.2);font-size:clamp(0.85rem,2vw,1rem);">Explore More</a>
                <a href="#contact" style="background:transparent;color:white;padding:12px 28px;border-radius:50px;font-weight:600;text-decoration:none;border:2px solid rgba(255,255,255,0.8);font-size:clamp(0.85rem,2vw,1rem);">Get in Touch</a>
            </div>
        </div>
    </div>

    {{-- Dot indicators --}}
    <div id="hero-dots" style="position:absolute;bottom:20px;left:50%;transform:translateX(-50%);z-index:20;display:flex;gap:10px;align-items:center;">
        @for($i = 0; $i < $slideCount; $i++)
        <button onclick="goToSlide({{ $i }})" style="width:11px;height:11px;min-height:11px;border-radius:50%;border:2px solid white;background:{{ $i===0?'white':'transparent' }};cursor:pointer;padding:0;transition:all 0.3s;flex-shrink:0;"></button>
        @endfor
    </div>

    {{-- Arrows --}}
    <button onclick="changeSlide(-1)" aria-label="Previous" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);z-index:20;background:rgba(0,0,0,0.35);border:1px solid rgba(255,255,255,0.4);color:white;width:38px;height:38px;border-radius:50%;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;">&#8249;</button>
    <button onclick="changeSlide(1)" aria-label="Next" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);z-index:20;background:rgba(0,0,0,0.35);border:1px solid rgba(255,255,255,0.4);color:white;width:38px;height:38px;border-radius:50%;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;">&#8250;</button>
</section>

<script>
(function(){
    var cur = 0;
    var total = {{ $slideCount }};
    var slides = document.querySelectorAll('.hero-slide');
    var dots = document.getElementById('hero-dots') ? document.getElementById('hero-dots').querySelectorAll('button') : [];
    var timer;

    function show(n) {
        cur = (n + total) % total;
        slides.forEach(function(s, i) { s.style.opacity = i === cur ? '1' : '0'; });
        dots.forEach(function(d, i) { d.style.background = i === cur ? 'white' : 'transparent'; });
        resetTimer();
    }

    window.goToSlide = function(n) { show(n); };
    window.changeSlide = function(d) { show(cur + d); };

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function() { show(cur + 1); }, 5000);
    }

    resetTimer();
})();
</script>

<!-- About Section -->
<section id="about" style="padding: 80px 0; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: clamp(1.5rem, 4vw, 2.2rem); font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 40px;">
            {{ $about['title'] ?? 'SEENAA HUNDEEFFAMA AANAA HAAWWAA GALAAN' }}
        </h2>
        <div class="about-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
            <div>
                <div style="color: #4b5563; line-height: 1.8; font-size: 1.05rem; word-wrap: break-word; overflow-wrap: break-word;">
                    {!! nl2br(e($about['body'] ?? 'Aanaan Hawwaa Galaan aanolee Godina Qellem Wallaggaa keessaa ishee tokko.')) !!}
                </div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-top: 30px;">
                    <div style="text-align: center; padding: 15px 10px; background: #f0f9ff; border-radius: 15px;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #3b82f6; margin-bottom: 5px;">100K+</h3>
                        <p style="color: #6b7280; font-size: 0.85rem;">Jiraattota</p>
                    </div>
                    <div style="text-align: center; padding: 15px 10px; background: #f0f9ff; border-radius: 15px;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #3b82f6; margin-bottom: 5px;">50+</h3>
                        <p style="color: #6b7280; font-size: 0.85rem;">Hawwatamummaa</p>
                    </div>
                    <div style="text-align: center; padding: 15px 10px; background: #f0f9ff; border-radius: 15px;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #3b82f6; margin-bottom: 5px;">200+</h3>
                        <p style="color: #6b7280; font-size: 0.85rem;">Bara Seenaa</p>
                    </div>
                </div>
            </div>
            <div>
                @php $aboutImg = $about['image'] ?? null; @endphp
                @if($aboutImg)
                <img src="{{ asset('images/'.$aboutImg) }}" alt="Karta Aanaa Haawwaa Galaan"
                     style="width: 100%; height: 400px; object-fit: contain; border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.15);"
                     onerror="this.style.display='none'">
                @else
                <div style="width:100%;height:400px;background:linear-gradient(135deg,#dbeafe,#eff6ff);border-radius:20px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
                    <div style="text-align:center;color:#3b82f6;">
                        <i class="fas fa-map" style="font-size:4rem;margin-bottom:15px;"></i>
                        <p style="font-weight:600;">Karta Aanaa Haawwaa Galaan</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Invitations Section -->
<section id="invitations" style="padding: 60px 0 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            {{ $about['invitations_title'] ?? 'Waamicha Investeroota fi Abbootii Qabeenyaaf...' }}
        </h2>
    </div>
</section>

<!-- Invitation Cards -->
@php
$defaultInvitations = [
    [
        'section' => 'city_leader_invite',
        'image_key' => 'city_leader_image',
        'text_key' => 'city_leader_text',
        'btn_key' => 'city_leader_btn',
        'default_text' => 'Aanaan keenya qabeenya uumamaan badhaatuu kan taatee fi bu\'uuraalee misoomaa kanneen akka daandii, ibsaa, manneen barnootaa hanga koolleejjiitti akkasumas tajaajila bishaan dhugaatii gahaa kan qabduudha. Kana malees daandiin konkolaataa aspaaltiin magaalaa guddoo biyya keenyaa Finfinnee irraa gara magaalaa Godina keenyaa Dambi Doolloo geessu Aanaa keeenya keessa kan qaxxaamuru fi buufata xiyyaaraa Dambi Dollo irraa kiilomeetira 20 kan hin caalle fagaannee argamna.',
        'default_btn' => 'Obbo Asaffaa Yoonaas Dibaabaa – Bulchaa Aanaa Haawwaa Galaan',
    ],
    [
        'section' => 'prosperity_invite',
        'image_key' => 'prosperity_image',
        'text_key' => 'prosperity_text',
        'btn_key' => 'prosperity_btn',
        'default_text' => 'Aanaan Haawwaa Galaan gandoota baadiyyaa 30 fi Bulchiinsa magaalaa 2 kan of keessaa qabdu yommuu ta\'u Aanaan keenya Sabaa fi Sab-lammoota biyyattii hedduudhaaf iddoo jireenyaa mijattuu taatee kan jirtuu fi Sabaa fi Sab-lammoonni Aanaa keenya keessatti argaman aadaa waliin jireenyaa cimaa dagaagfatanii nageenyaa fi tokkummaa isaanii dammaqinaan tikfachaa jiru.',
        'default_btn' => 'Obbo Tasfaa Shunnaa Bulchaa – I/G/Waajjira Paartii Badhaadhinaa',
    ],
    [
        'section' => 'investor_invite',
        'image_key' => 'investor_image',
        'text_key' => 'investor_text',
        'btn_key' => 'investor_btn',
        'default_text' => 'Omishaa fi omishtummaa daran guddisuun hirkattummaa biyyoota bakkee jalaa bahuun al-ergee keenya guddisuu qabna jechuun toora xiyyeeffannoo Mootummaan keenya qabatee jiru faana dhahuun akka Aanaa Haawwaa Galaanitti hojiiwwan gurguddaan damee qonnaatiin hojjetamaa jira.',
        'default_btn' => 'Obbo Abbabe Tizaazuu Kuusaa – I/A/Bulchaa fi I/G/W/Qonnaa fi Lafaa',
    ],
];
@endphp

@foreach($defaultInvitations as $inv)
@php
    $invData = \App\Models\PageSection::where('page','home')->where('section',$inv['section'])->pluck('value','key');
    $imgPath = $invData[$inv['image_key']] ?? null;
    $text = $invData[$inv['text_key']] ?? $inv['default_text'];
    $btn = $invData[$inv['btn_key']] ?? $inv['default_btn'];
@endphp
<section style="padding: 30px 0; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
            <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.15); height: 420px;">
                @if($imgPath)
                <img src="{{ asset('images/'.$imgPath) }}" alt="Invitation"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#dbeafe,#bfdbfe);display:flex;align-items:center;justify-content:center;color:#1e3a8a;">
                    <div style="text-align:center;">
                        <i class="fas fa-user-tie" style="font-size:4rem;margin-bottom:15px;opacity:0.5;"></i>
                        <p style="font-size:0.9rem;opacity:0.6;">Upload photo from admin panel</p>
                    </div>
                </div>
                @endif
            </div>
            <div>
                <div style="color:#4b5563;line-height:1.8;font-size:1.05rem;">{!! nl2br(e($text)) !!}</div>
                <a href="#" style="display:inline-block;margin-top:20px;background:#1e3a8a;color:white;padding:12px 28px;border-radius:50px;font-weight:600;text-decoration:none;font-size:0.9rem;">{{ $btn }}</a>
            </div>
        </div>
    </div>
</section>
@endforeach

<!-- Leaders Section -->
@if($leaders->isNotEmpty())
<section id="leaders" style="padding: 80px 0; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            Hooggantoota Sekteraalee
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            @foreach($leaders as $leader)
            <div class="attraction-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div style="height: 250px; overflow: hidden; position: relative;">
                    <img src="{{ $leader->photo ? asset('images/'.$leader->photo) : asset('images/placeholder.svg') }}"
                         alt="{{ $leader->name }}"
                         class="attraction-img"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                         onerror="this.src='/images/placeholder.svg'">
                </div>
                <div style="padding: 25px;">
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #1f2937; margin-bottom: 8px;">{{ $leader->name }}</h3>
                    <p style="color: #6b7280; font-size: 0.95rem; margin-bottom: 15px;">{{ $leader->title }}</p>
                    @if($leader->description)
                    <div class="hidden-text" style="display: none; margin-top: 10px; line-height: 1.7; color: #4b5563; font-size: 0.95rem;">
                        {!! nl2br(e($leader->description)) !!}
                    </div>
                    <a href="#" class="attraction-link" aria-expanded="false"
                       style="color: #3b82f6; font-weight: 600; text-decoration: none; font-size: 0.9rem; display:inline-block; padding: 8px 0; min-height: 44px; line-height: 28px;"
                       onclick="(function(el){var h=el.parentElement.querySelector('.hidden-text');if(!h)return false;var open=el.getAttribute('aria-expanded')==='true';h.style.display=open?'none':'block';el.setAttribute('aria-expanded',open?'false':'true');el.textContent=open?'Read More':'Read Less';return false;})(this); return false;">
                        Read More
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Charity / Kenna Tajaajila Lammummaa Section -->
@php $charity = \App\Models\PageSection::where('page','home')->where('section','charity')->pluck('value','key'); @endphp
<section id="charity" style="padding: 80px 0; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            {{ $charity['title'] ?? 'Kenna Tajaajila Lammummaa' }}
        </h2>

        {{-- Main large feature --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; margin-bottom: 40px; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
            <div style="height: 350px; overflow: hidden; position: relative;">
                @if($charity->has('main_image') && $charity['main_image'])
                <img src="{{ asset('images/'.$charity['main_image']) }}" alt="Charity Main"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1e3a8a,#3b82f6);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:15px;">
                    <i class="fas fa-hands-helping" style="font-size:5rem;color:rgba(255,255,255,0.6);"></i>
                    <p style="color:rgba(255,255,255,0.8);font-size:0.9rem;text-align:center;padding:0 20px;">Upload photo from<br>Admin → Page Sections → Home</p>
                </div>
                @endif
            </div>
            <div style="padding: 40px;">
                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 15px;">
                    {{ $charity['main_title'] ?? 'Tajaajila Gargaarsaa' }}
                </h3>
                <p style="color: #4b5563; line-height: 1.8; font-size: 1rem;">
                    {{ $charity['main_text'] ?? 'Furmaata rakkoo waloof tajaajilli lammummaa xiyyeeffannoodhaan akka hojjetamuuf mootummaan saganteessee hojjetamaa jira. Kenna tajaajilaa gosoota garaa garaa hojjetamaa jiraniin bu\'aalee hudduun kan argaman yommuu ta\'u harka qalleeyyii heedduun fayyadamoo ta\'anii rakkoo isaanii dandamataniiru. Godina Qellem wallaggaa Aanaa Haawwaa Galaanittis hojiiwwan tajaajila lammummaatiin hojjetaman namoota heedduu fayyadamoo taasiseera.' }}
                </p>
            </div>
        </div>

        {{-- Gallery grid --}}
        @php
        $charityItems = [
            ['img_key'=>'gallery_1_image','title_key'=>'gallery_1_title','text_key'=>'gallery_1_text','default_title'=>'Ijaarsa Manaa','default_text'=>'Qaamolee Hoggansa Godinaa waliin ta\'uun mana harka qalleeyyii ijaarame'],
            ['img_key'=>'gallery_2_image','title_key'=>'gallery_2_title','text_key'=>'gallery_2_text','default_title'=>'Ijaarsa manaa','default_text'=>'Qaamolee Hoggansa Godinaa waliin ta\'uun mana harka qalleeyyii ijaarame'],
            ['img_key'=>'gallery_3_image','title_key'=>'gallery_3_title','text_key'=>'gallery_3_text','default_title'=>'Deggersa midhaan nyaataa','default_text'=>'Utuu nuti jirruu haati hiyyeessaa hagabuu buluu hin qabdu jechuun deggersa haadha hiyyeessaaf taasifame'],
            ['img_key'=>'gallery_4_image','title_key'=>'gallery_4_title','text_key'=>'gallery_4_text','default_title'=>'Diinagdeedhaan of dandeessisuu','default_text'=>'Haati hiyyeessaa eeggattummaa jalaa akka baatuuf deggersa qabeenya dhaabbataa taasifame'],
            ['img_key'=>'gallery_5_image','title_key'=>'gallery_5_title','text_key'=>'gallery_5_text','default_title'=>'Deggersa midhaan nyaataa','default_text'=>'Utuu nuti jirruu haati hiyyeessaa hagabuu buluu hin qabdu jechuun deggersa haadha hiyyeessaaf taasifame'],
            ['img_key'=>'gallery_6_image','title_key'=>'gallery_6_title','text_key'=>'gallery_6_text','default_title'=>'Deggersa uffataa','default_text'=>'Nuti uffannee utuu jirruu maatii harka qalleessaa qorri dhaanuu hin qabu jechuun deggersa uffata qorraa taasifame'],
        ];
        @endphp
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($charityItems as $item)
            <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <div style="height: 180px; overflow: hidden;">
                    @if($charity->has($item['img_key']) && $charity[$item['img_key']])
                    <img src="{{ asset('images/'.$charity[$item['img_key']]) }}" alt="{{ $item['default_title'] }}"
                         style="width:100%;height:100%;object-fit:cover;">
                    @else
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#1e3a8a,#3b82f6);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;">
                        <i class="fas fa-camera" style="font-size:1.8rem;color:rgba(255,255,255,0.6);"></i>
                        <span style="color:rgba(255,255,255,0.7);font-size:0.75rem;">Upload photo</span>
                    </div>
                    @endif
                </div>
                <div style="padding: 15px;">
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #1f2937; margin-bottom: 6px;">
                        {{ $charity[$item['title_key']] ?? $item['default_title'] }}
                    </h4>
                    <p style="font-size: 0.85rem; color: #6b7280; line-height: 1.5;">
                        {{ $charity[$item['text_key']] ?? $item['default_text'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Hospital Section -->
@php $hospital = \App\Models\PageSection::where('page','home')->where('section','hospital')->pluck('value','key'); @endphp
<section id="hospital" style="padding: 80px 0; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            {{ $hospital['title'] ?? 'Hospitaala Jalqabaa Aanaa Haawwaa Galaan' }}
        </h2>

        {{-- Main hospital content --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; margin-bottom: 40px;">
            <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.12); height: 350px;">
                @if($hospital->has('main_image') && $hospital['main_image'])
                <img src="{{ asset('images/'.$hospital['main_image']) }}" alt="Hospital"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-hospital" style="font-size:5rem;color:#3b82f6;opacity:0.4;"></i>
                </div>
                @endif
            </div>
            <div>
                <p style="color: #4b5563; line-height: 1.8; font-size: 1rem; margin-bottom: 25px;">
                    {{ $hospital['description'] ?? 'Hospitaalli Jalqabaa Aanaa Haawwaa Galaan bara 2010 hojii tajaajila yaalaa guutuu ta\'e kennuu kan jalqabe yammuu ta\'u, Hawwaasa aanichaa bira darbee jiraattota gandoolee aanaa Ollaa jiran tajaajiluurratti kan argamu kaappitaala jalqabaa qarshii 100,000 qofaan kan jalqabe fi galii keessoo isaa guddisuuf hojjeteen waggoottan muraasa kanatti yeroo ammaa qarshii miliyoona 5 olirra kan jirudha. meeshaalee yaalaa ammayyaa\'oo ta\'aniin saatii 24 guutuu tajaajilaa kan jirudha.' }}
                </p>
                <div style="background: #f8fafc; border-radius: 15px; padding: 20px;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin-bottom: 12px;">Tajaajila Hospitaalli keenya kennu:</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                        @foreach(['Tajaajila deddeebisanii yaaluu','Tajaajila ciibsanii yaaluu','Tajaajila karoora maatii','Tajaajila da\'umsa duraa fi boodaa','Tajaajila baqaqsanii yaaluu','Tajaajila faarmaasii','Tajaajila laaboraatori','Tajaajila altiraasaawundii','Tajaajila talaallii daa\'immanii'] as $svc)
                        <li style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:#4b5563;">
                            <i class="fas fa-check-circle" style="color:#3b82f6;flex-shrink:0;"></i> {{ $svc }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Facilities grid --}}
        @php
        $facilities = [
            ['key'=>'facility_lab','label'=>'Laboratory'],
            ['key'=>'facility_gene','label'=>'GeneXpert Room'],
            ['key'=>'facility_chemistry','label'=>'Chemistry Room'],
            ['key'=>'facility_ultra','label'=>'Ultrasound'],
            ['key'=>'facility_operation','label'=>'Operation Room'],
            ['key'=>'facility_xray','label'=>'X-Ray'],
        ];
        @endphp
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px;">
            @foreach($facilities as $fac)
            <div style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <div style="height: 160px; overflow: hidden;">
                    @if($hospital->has($fac['key']) && $hospital[$fac['key']])
                    <img src="{{ asset('images/'.$hospital[$fac['key']]) }}" alt="{{ $fac['label'] }}"
                         style="width:100%;height:100%;object-fit:cover;">
                    @else
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-image" style="font-size:2rem;color:#93c5fd;"></i>
                    </div>
                    @endif
                </div>
                <div style="padding: 12px; background: white; text-align: center;">
                    <h4 style="font-size: 0.9rem; font-weight: 600; color: #1f2937; margin: 0;">{{ $fac['label'] }}</h4>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Green area wide --}}
        <div style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <div style="height: 200px; overflow: hidden;">
                @if($hospital->has('facility_green') && $hospital['facility_green'])
                <img src="{{ asset('images/'.$hospital['facility_green']) }}" alt="Green Area"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-leaf" style="font-size:3rem;color:#86efac;"></i>
                </div>
                @endif
            </div>
            <div style="padding: 12px; background: white; text-align: center;">
                <h4 style="font-size: 0.9rem; font-weight: 600; color: #1f2937; margin: 0;">Green Area</h4>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
@if($news->isNotEmpty())
<section id="news" style="padding: 80px 0; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            Oduu fi Beeksisa
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            @foreach($news as $post)
            <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                @if($post->image)
                <div style="height: 200px; overflow: hidden;">
                    <img src="{{ asset('images/'.$post->image) }}" alt="{{ $post->title }}"
                         style="width: 100%; height: 100%; object-fit: cover;"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                </div>
                @endif
                <div style="padding: 25px;">
                    <p style="color: #9ca3af; font-size: 0.85rem; margin-bottom: 10px;">
                        {{ $post->published_at?->format('M d, Y') }}
                    </p>
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1f2937; margin-bottom: 12px;">{{ $post->title }}</h3>
                    <p style="color: #6b7280; line-height: 1.6; font-size: 0.95rem;">
                        {{ Str::limit($post->body, 150) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Football Championship Section -->
@php $football = \App\Models\PageSection::where('page','home')->where('section','football')->pluck('value','key'); @endphp
<section id="football-championship" style="padding: 80px 0; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #1f2937; text-align: center; margin-bottom: 50px;">
            {{ $football['title'] ?? 'Gaba Robi Football Club – Oromia First League Champions' }}
        </h2>

        {{-- Main feature --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; margin-bottom: 30px; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
            <div style="height: 350px; overflow: hidden;">
                @if($football->has('main_image') && $football['main_image'])
                <img src="{{ asset('images/'.$football['main_image']) }}" alt="Football Championship"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#fef3c7,#fde68a);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-trophy" style="font-size:5rem;color:#f59e0b;opacity:0.5;"></i>
                </div>
                @endif
            </div>
            <div style="padding: 40px;">
                <h3 style="font-size: 1.4rem; font-weight: 700; color: #1f2937; margin-bottom: 15px;">
                    🏆 {{ $football['subtitle'] ?? 'Oromia First League Champions 2017' }}
                </h3>
                <p style="color: #4b5563; line-height: 1.8; font-size: 1rem;">
                    {{ $football['body'] ?? 'Aanaa Haawwaa Galaanitti gareen kubbaa miillaa Bulchiinsa magaalaa Gabaa Roobii Oromia First League Championship kan bara 2017 irratti hirmaachuun murannoo fi cimina taphattoonni garechaa agarsiisanii fi qindoomina qooda fudhattoota geggeessummaadhaan keessatti hirmaataniin champiyooni ta\'uu danda\'eera. Injifannoon kun Aanicha sadarkaa biyyaatti beeksisuu danda\'edha.' }}
                </p>
            </div>
        </div>

        {{-- Gallery --}}
        @php
        $footballGallery = ['gallery_1','gallery_2','gallery_3','gallery_4','gallery_5','gallery_6'];
        @endphp
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
            @foreach($footballGallery as $gKey)
            <div style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 180px;">
                @if($football->has($gKey) && $football[$gKey])
                <img src="{{ asset('images/'.$football[$gKey]) }}" alt="Football"
                     style="width:100%;height:100%;object-fit:cover;">
                @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#fef3c7,#fde68a);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-futbol" style="font-size:2.5rem;color:#f59e0b;opacity:0.4;"></i>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" style="padding: 80px 0; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; text-align: center; margin-bottom: 10px;">Nu Quunnamaa</h2>
        <p style="text-align: center; opacity: 0.85; margin-bottom: 50px; font-size: 1.1rem;">Gaaffii yoo qabaattan nu quunnamaa</p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: start;">

            {{-- Left: Contact Info --}}
            <div style="display: flex; flex-direction: column; gap: 25px;">
                @if($contact->has('address'))
                <div style="display: flex; align-items: flex-start; gap: 20px; background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; backdrop-filter: blur(10px);">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-weight: 600; margin-bottom: 5px; font-size: 1rem;">Teessoo</h4>
                        <p style="opacity: 0.85; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $contact['address'] }}</p>
                    </div>
                </div>
                @else
                <div style="display: flex; align-items: flex-start; gap: 20px; background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-weight: 600; margin-bottom: 5px;">Teessoo</h4>
                        <p style="opacity: 0.85; font-size: 0.95rem; margin: 0;">Gabaa Roobii, Aanaa Haawwaa Galaan, Qellem Wallaggaa</p>
                    </div>
                </div>
                @endif

                @if($contact->has('phone'))
                <div style="display: flex; align-items: flex-start; gap: 20px; background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; backdrop-filter: blur(10px);">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-phone" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-weight: 600; margin-bottom: 5px;">Bilbila</h4>
                        <p style="opacity: 0.85; font-size: 0.95rem; margin: 0;">{{ $contact['phone'] }}</p>
                    </div>
                </div>
                @endif

                @if($contact->has('email'))
                <div style="display: flex; align-items: flex-start; gap: 20px; background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; backdrop-filter: blur(10px);">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-envelope" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-weight: 600; margin-bottom: 5px;">Imeelii</h4>
                        <p style="opacity: 0.85; font-size: 0.95rem; margin: 0;">{{ $contact['email'] }}</p>
                    </div>
                </div>
                @endif

                <div style="display: flex; align-items: flex-start; gap: 20px; background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; backdrop-filter: blur(10px);">
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-clock" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="font-weight: 600; margin-bottom: 5px;">Yeroo Hojii</h4>
                        <p style="opacity: 0.85; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                            {{ $contact['office_hours'] ?? 'Wiixata – Jimaata' }}<br>
                            8:00 AM – 5:00 PM
                        </p>
                    </div>
                </div>

                @if($contact->has('telegram') || $contact->has('facebook'))
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    @if($contact->has('telegram'))
                    <a href="{{ $contact['telegram'] }}" target="_blank" style="display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); color: white; padding: 10px 18px; border-radius: 25px; text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                        <i class="fab fa-telegram"></i> Telegram
                    </a>
                    @endif
                    @if($contact->has('facebook'))
                    <a href="{{ $contact['facebook'] }}" target="_blank" style="display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); color: white; padding: 10px 18px; border-radius: 25px; text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                    @endif
                </div>
                @endif
            </div>

            {{-- Right: Contact Form --}}
            <div style="background: white; border-radius: 20px; padding: 35px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin-bottom: 25px;">Ergaa Nuuf Ergi</h3>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                    @csrf
                    <div>
                        <input type="text" name="name" placeholder="Maqaa Kee" required
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.95rem; color: #1f2937; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Imeelii Kee" required
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.95rem; color: #1f2937; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <input type="text" name="subject" placeholder="Mata Duree"
                               style="width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.95rem; color: #1f2937; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <textarea name="message" placeholder="Ergaa Kee..." rows="5" required
                                  style="width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 0.95rem; color: #1f2937; outline: none; resize: vertical; box-sizing: border-box;"></textarea>
                    </div>
                    <button type="submit"
                            style="background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; padding: 13px 30px; border: none; border-radius: 10px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: opacity 0.2s;">
                        <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Ergaa Ergi
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

