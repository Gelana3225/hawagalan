@extends('layouts.admin')
@section('title', 'Football Gallery')
@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.dashboard') }}" style="color:#3b82f6;text-decoration:none;font-size:0.9rem;">← Back to Dashboard</a>
</div>

<div style="background:white;border-radius:15px;padding:25px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:25px;">
    <h2 style="font-size:1.3rem;font-weight:700;color:#1f2937;margin-bottom:6px;">Football Championship Gallery</h2>
    <p style="color:#6b7280;font-size:0.9rem;margin:0;">Upload the main championship photo and up to 6 gallery photos.</p>
</div>

@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 20px;border-radius:10px;margin-bottom:20px;font-size:0.9rem;">✓ {{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.football.photos.update') }}" enctype="multipart/form-data">
    @csrf

    {{-- Text fields --}}
    <div style="background:white;border-radius:15px;padding:25px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:20px;">
        <h3 style="font-size:1rem;font-weight:600;color:#1f2937;margin-bottom:15px;">Section Text</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">
            <div>
                <label style="display:block;font-size:0.85rem;font-weight:500;color:#374151;margin-bottom:5px;">Title</label>
                <input type="text" name="text[title]" value="{{ $photos['title']->value ?? '' }}"
                       placeholder="Gaba Robi Football Club – Oromia First League Champions"
                       style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block;font-size:0.85rem;font-weight:500;color:#374151;margin-bottom:5px;">Subtitle</label>
                <input type="text" name="text[subtitle]" value="{{ $photos['subtitle']->value ?? '' }}"
                       placeholder="Oromia First League Champions 2017"
                       style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;box-sizing:border-box;">
            </div>
        </div>
        <div>
            <label style="display:block;font-size:0.85rem;font-weight:500;color:#374151;margin-bottom:5px;">Description</label>
            <textarea name="text[body]" rows="3" placeholder="Championship description..."
                      style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;resize:vertical;box-sizing:border-box;">{{ $photos['body']->value ?? '' }}</textarea>
        </div>
    </div>

    {{-- Main photo --}}
    @php $main = $photos['main_image'] ?? null; @endphp
    <div style="background:white;border-radius:15px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:20px;border:2px solid {{ $main ? '#3b82f6' : '#e5e7eb' }};">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <span style="font-weight:600;color:#1f2937;">Main Championship Photo</span>
            @if($main)<span style="background:#dbeafe;color:#1d4ed8;font-size:0.75rem;padding:3px 10px;border-radius:20px;">Uploaded</span>@endif
        </div>
        <div style="width:100%;height:200px;border-radius:10px;overflow:hidden;margin-bottom:12px;background:#f3f4f6;">
            @if($main && $main->value)
            <img src="{{ asset('images/'.$main->value) }}" id="prev-main_image" style="width:100%;height:100%;object-fit:cover;" onerror="this.style.display='none'">
            @else
            <div id="prev-main_image" style="width:100%;height:100%;background:linear-gradient(135deg,#fef3c7,#fde68a);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;">
                <i class="fas fa-trophy" style="font-size:3rem;color:#f59e0b;opacity:0.6;"></i>
                <span style="color:#92400e;font-size:0.85rem;">No photo yet</span>
            </div>
            @endif
        </div>
        <label style="display:block;width:100%;padding:10px;background:#fffbeb;border:2px dashed #fcd34d;border-radius:8px;text-align:center;cursor:pointer;font-size:0.85rem;color:#d97706;font-weight:500;">
            <i class="fas fa-upload" style="margin-right:6px;"></i> {{ $main ? 'Replace Photo' : 'Upload Photo' }}
            <input type="file" name="photos[main_image]" accept="image/*" style="display:none;" onchange="previewPhoto(this,'main_image')">
        </label>
        @if($main)
        <label style="display:flex;align-items:center;gap:8px;margin-top:10px;cursor:pointer;font-size:0.85rem;color:#ef4444;">
            <input type="checkbox" name="delete_main_image" value="1" style="accent-color:#ef4444;"> Remove photo
        </label>
        @endif
    </div>

    {{-- Gallery grid --}}
    <div style="background:white;border-radius:15px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:25px;">
        <h3 style="font-size:1rem;font-weight:600;color:#1f2937;margin-bottom:15px;">Gallery Photos (up to 6)</h3>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;">
            @for($i = 1; $i <= 6; $i++)
            @php $gKey = 'gallery_'.$i; $rec = $photos[$gKey] ?? null; @endphp
            <div style="border-radius:12px;overflow:hidden;border:2px solid {{ $rec ? '#3b82f6' : '#e5e7eb' }};background:white;">
                <div style="height:130px;position:relative;background:#f3f4f6;">
                    @if($rec && $rec->value)
                    <img src="{{ asset('images/'.$rec->value) }}" id="prev-{{ $gKey }}"
                         style="width:100%;height:100%;object-fit:cover;display:block;"
                         onerror="this.style.display='none'">
                    @else
                    <div id="prev-{{ $gKey }}" style="width:100%;height:100%;background:linear-gradient(135deg,#fef3c7,#fde68a);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-futbol" style="font-size:2rem;color:#f59e0b;opacity:0.5;"></i>
                    </div>
                    @endif
                    @if($rec)<span style="position:absolute;top:8px;right:8px;background:#3b82f6;color:white;font-size:0.7rem;padding:2px 8px;border-radius:20px;">✓</span>@endif
                </div>
                <div style="padding:10px;">
                    <label style="display:block;width:100%;padding:7px;background:#fffbeb;border:1px dashed #fcd34d;border-radius:6px;text-align:center;cursor:pointer;font-size:0.8rem;color:#d97706;font-weight:500;box-sizing:border-box;">
                        <i class="fas fa-upload"></i> Photo {{ $i }}
                        <input type="file" name="photos[{{ $gKey }}]" accept="image/*" style="display:none;" onchange="previewPhoto(this,'{{ $gKey }}')">
                    </label>
                    @if($rec)
                    <label style="display:flex;align-items:center;gap:6px;margin-top:8px;cursor:pointer;font-size:0.8rem;color:#ef4444;">
                        <input type="checkbox" name="delete_{{ $gKey }}" value="1" style="accent-color:#ef4444;"> Remove
                    </label>
                    @endif
                </div>
            </div>
            @endfor
        </div>
    </div>

    <button type="submit" style="background:#f59e0b;color:white;padding:12px 32px;border:none;border-radius:10px;font-size:0.95rem;font-weight:600;cursor:pointer;">
        <i class="fas fa-save" style="margin-right:8px;"></i> Save Football Gallery
    </button>
</form>

<script>
function previewPhoto(input, key) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var el = document.getElementById('prev-' + key);
            if (el) { el.outerHTML = '<img id="prev-'+key+'" src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;display:block;">'; }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
