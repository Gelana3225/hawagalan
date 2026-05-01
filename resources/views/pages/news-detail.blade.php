@extends('layouts.app')

@section('title', $post->title . ' – Haawwaa Galaan')

@section('content')
<div style="margin-top:80px;background:#f8fafc;min-height:100vh;padding:50px 0 80px;">
<div style="max-width:900px;margin:0 auto;padding:0 20px;">

    {{-- Back --}}
    <a href="{{ route('home') }}#news" style="display:inline-flex;align-items:center;gap:8px;color:#6b7280;text-decoration:none;font-size:0.9rem;margin-bottom:30px;">
        <i class="fas fa-arrow-left"></i> Oduu fi Beeksisa
    </a>

    {{-- Article card --}}
    <div style="background:white;border-radius:24px;overflow:hidden;box-shadow:0 4px 30px rgba(0,0,0,0.08);">

        {{-- Cover image --}}
        @php $allImgs = $post->allImages(); @endphp
        @if(count($allImgs) > 0)
        <div style="position:relative;height:420px;overflow:hidden;">
            <img src="{{ asset('images/'.$allImgs[0]) }}" alt="{{ $post->title }}"
                 style="width:100%;height:100%;object-fit:cover;"
                 onerror="this.parentElement.style.display='none'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.5) 0%,transparent 50%);"></div>
            <div style="position:absolute;bottom:24px;left:30px;color:white;">
                <span style="background:rgba(30,58,138,0.85);padding:5px 14px;border-radius:20px;font-size:0.8rem;font-weight:500;">
                    {{ $post->published_at?->format('M d, Y') }}
                </span>
            </div>
            @if(count($allImgs) > 1)
            <div style="position:absolute;top:16px;right:16px;background:rgba(0,0,0,0.6);color:white;padding:5px 12px;border-radius:20px;font-size:0.8rem;backdrop-filter:blur(4px);">
                <i class="fas fa-images" style="margin-right:5px;"></i>{{ count($allImgs) }} photos
            </div>
            @endif
        </div>
        @endif

        {{-- Content --}}
        <div style="padding:40px;">
            <h1 style="font-size:clamp(1.4rem,3vw,2rem);font-weight:800;color:#111827;margin-bottom:20px;line-height:1.3;">
                {{ $post->title }}
            </h1>
            <div style="color:#374151;font-size:1.05rem;line-height:1.9;">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        {{-- Photo gallery --}}
        @if(count($allImgs) > 1)
        <div style="padding:0 40px 40px;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin-bottom:16px;">
                <i class="fas fa-images" style="color:#3b82f6;margin-right:8px;"></i>Suuraalee ({{ count($allImgs) }})
            </h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px;">
                @foreach($allImgs as $idx => $img)
                <div style="border-radius:12px;overflow:hidden;height:140px;cursor:pointer;"
                     onclick="openLightbox({{ $idx }})">
                    <img src="{{ asset('images/'.$img) }}"
                         style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s;"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'"
                         onerror="this.parentElement.style.display='none'">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Recent news --}}
    @if($recent->isNotEmpty())
    <div style="margin-top:50px;">
        <h2 style="font-size:1.3rem;font-weight:700;color:#111827;margin-bottom:24px;">Oduu Biroo</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
            @foreach($recent as $r)
            @php $rImgs = $r->allImages(); @endphp
            <a href="{{ route('news.show', $r->id) }}" style="text-decoration:none;">
                <div style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 15px rgba(0,0,0,0.07);transition:transform 0.2s,box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(0,0,0,0.12)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 15px rgba(0,0,0,0.07)'">
                    @if(count($rImgs) > 0)
                    <div style="height:150px;overflow:hidden;">
                        <img src="{{ asset('images/'.$rImgs[0]) }}" style="width:100%;height:100%;object-fit:cover;" onerror="this.parentElement.style.display='none'">
                    </div>
                    @endif
                    <div style="padding:16px;">
                        <p style="color:#9ca3af;font-size:0.78rem;margin-bottom:6px;">{{ $r->published_at?->format('M d, Y') }}</p>
                        <h4 style="color:#111827;font-size:0.95rem;font-weight:600;line-height:1.4;margin:0;">{{ Str::limit($r->title, 60) }}</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
</div>

{{-- Lightbox --}}
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9999;align-items:center;justify-content:center;">
    <button onclick="closeLightbox()" style="position:absolute;top:20px;right:20px;background:rgba(255,255,255,0.15);border:none;color:white;width:44px;height:44px;border-radius:50%;font-size:1.2rem;cursor:pointer;">✕</button>
    <button onclick="prevImg()" style="position:absolute;left:20px;background:rgba(255,255,255,0.15);border:none;color:white;width:44px;height:44px;border-radius:50%;font-size:1.3rem;cursor:pointer;">‹</button>
    <img id="lightbox-img" src="" style="max-width:90vw;max-height:85vh;object-fit:contain;border-radius:8px;">
    <button onclick="nextImg()" style="position:absolute;right:20px;background:rgba(255,255,255,0.15);border:none;color:white;width:44px;height:44px;border-radius:50%;font-size:1.3rem;cursor:pointer;">›</button>
    <div id="lightbox-counter" style="position:absolute;bottom:20px;color:rgba(255,255,255,0.7);font-size:0.9rem;"></div>
</div>

@push('scripts')
<script>
var imgs = @json($allImgs);
var cur = 0;

function openLightbox(idx) {
    cur = idx;
    document.getElementById('lightbox').style.display = 'flex';
    showImg();
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
function showImg() {
    document.getElementById('lightbox-img').src = '/images/' + imgs[cur];
    document.getElementById('lightbox-counter').textContent = (cur+1) + ' / ' + imgs.length;
}
function prevImg() { cur = (cur - 1 + imgs.length) % imgs.length; showImg(); }
function nextImg() { cur = (cur + 1) % imgs.length; showImg(); }
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});
</script>
@endpush
@endsection
