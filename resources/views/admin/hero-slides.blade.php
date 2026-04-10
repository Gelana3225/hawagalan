@extends('layouts.admin')

@section('title', 'Hero Slideshow Photos')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.dashboard') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">← Back to Dashboard</a>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px;">
    <h2 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Home Page Slideshow</h2>
    <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Upload up to 5 photos for the hero background slideshow. Photos auto-slide every 5 seconds. Recommended size: 1920×1080px or wider.</p>
</div>

@if(session('success'))
<div style="background: #d1fae5; border: 1px solid #6ee7b7; color: #065f46; padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem;">
    ✓ {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.hero.slides.update') }}" enctype="multipart/form-data">
    @csrf

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        @for($i = 1; $i <= 5; $i++)
        @php $key = 'slide_' . $i; $existing = $slides[$key] ?? null; @endphp
        <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: 2px solid {{ $existing ? '#3b82f6' : '#e5e7eb' }};">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <span style="font-weight: 600; color: #1f2937; font-size: 0.95rem;">Slide {{ $i }}</span>
                @if($existing)
                <span style="background: #dbeafe; color: #1d4ed8; font-size: 0.75rem; padding: 3px 10px; border-radius: 20px; font-weight: 500;">Uploaded</span>
                @else
                <span style="background: #f3f4f6; color: #9ca3af; font-size: 0.75rem; padding: 3px 10px; border-radius: 20px;">Empty</span>
                @endif
            </div>

            {{-- Preview --}}
            <div style="width: 100%; height: 160px; border-radius: 10px; overflow: hidden; margin-bottom: 12px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                @if($existing)
                <img src="{{ Storage::url($existing->value) }}" alt="Slide {{ $i }}"
                     id="preview-{{ $i }}"
                     style="width: 100%; height: 100%; object-fit: cover;">
                @else
                <div id="preview-{{ $i }}" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#9ca3af;">
                    <i class="fas fa-image" style="font-size: 2.5rem; margin-bottom: 8px;"></i>
                    <span style="font-size: 0.8rem;">No photo yet</span>
                </div>
                @endif
            </div>

            {{-- Upload input --}}
            <label style="display: block; width: 100%; padding: 10px; background: #eff6ff; border: 2px dashed #93c5fd; border-radius: 8px; text-align: center; cursor: pointer; font-size: 0.85rem; color: #3b82f6; font-weight: 500; transition: all 0.2s;">
                <i class="fas fa-upload" style="margin-right: 6px;"></i>
                {{ $existing ? 'Replace Photo' : 'Upload Photo' }}
                <input type="file" name="slides[{{ $i }}]" accept="image/*" style="display: none;"
                       onchange="previewSlide(this, {{ $i }})">
            </label>

            @error("slides.{$i}")
            <p style="color: #ef4444; font-size: 0.8rem; margin-top: 6px;">{{ $message }}</p>
            @enderror

            {{-- Delete checkbox --}}
            @if($existing)
            <label style="display: flex; align-items: center; gap: 8px; margin-top: 10px; cursor: pointer; font-size: 0.85rem; color: #ef4444;">
                <input type="checkbox" name="delete_{{ $key }}" value="1" style="accent-color: #ef4444;">
                Remove this slide
            </label>
            @endif
        </div>
        @endfor
    </div>

    <div style="margin-top: 25px;">
        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 32px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            <i class="fas fa-save" style="margin-right: 8px;"></i> Save Slideshow
        </button>
    </div>
</form>

<script>
function previewSlide(input, num) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var container = document.getElementById('preview-' + num);
            container.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
            container.style.background = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
