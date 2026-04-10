@extends('layouts.admin')
@section('title', 'Hospital Photos')
@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.dashboard') }}" style="color:#3b82f6;text-decoration:none;font-size:0.9rem;">← Back to Dashboard</a>
</div>

<div style="background:white;border-radius:15px;padding:25px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:25px;">
    <h2 style="font-size:1.3rem;font-weight:700;color:#1f2937;margin-bottom:6px;">Hospital Section Photos</h2>
    <p style="color:#6b7280;font-size:0.9rem;margin:0;">Upload photos for the hospital section: main photo, facility rooms, and green area.</p>
</div>

@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 20px;border-radius:10px;margin-bottom:20px;font-size:0.9rem;">✓ {{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.hospital.photos.update') }}" enctype="multipart/form-data">
    @csrf

    @php
    $slots = [
        ['key'=>'main_image',         'label'=>'Main Hospital Photo',  'icon'=>'fas fa-hospital',    'wide'=>true],
        ['key'=>'facility_lab',        'label'=>'Laboratory',           'icon'=>'fas fa-flask'],
        ['key'=>'facility_gene',       'label'=>'GeneXpert Room',       'icon'=>'fas fa-dna'],
        ['key'=>'facility_chemistry',  'label'=>'Chemistry Room',       'icon'=>'fas fa-atom'],
        ['key'=>'facility_ultra',      'label'=>'Ultrasound',           'icon'=>'fas fa-heartbeat'],
        ['key'=>'facility_operation',  'label'=>'Operation Room',       'icon'=>'fas fa-procedures'],
        ['key'=>'facility_xray',       'label'=>'X-Ray',                'icon'=>'fas fa-x-ray'],
        ['key'=>'facility_green',      'label'=>'Green Area',           'icon'=>'fas fa-leaf',        'wide'=>true],
    ];
    @endphp

    {{-- Main photo (full width) --}}
    @php $main = $photos['main_image'] ?? null; @endphp
    <div style="background:white;border-radius:15px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:20px;border:2px solid {{ $main ? '#3b82f6' : '#e5e7eb' }};">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <span style="font-weight:600;color:#1f2937;">Main Hospital Photo</span>
            @if($main)<span style="background:#dbeafe;color:#1d4ed8;font-size:0.75rem;padding:3px 10px;border-radius:20px;font-weight:500;">Uploaded</span>@endif
        </div>
        <div style="width:100%;height:200px;border-radius:10px;overflow:hidden;margin-bottom:12px;background:#f3f4f6;">
            @if($main)
            <img src="{{ asset('storage/'.$main->value) }}" id="prev-main_image" style="width:100%;height:100%;object-fit:cover;"
                 onerror="this.style.display='none'">
            @else
            <div id="prev-main_image" style="width:100%;height:100%;background:linear-gradient(135deg,#1e3a8a,#3b82f6);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;">
                <i class="fas fa-hospital" style="font-size:3rem;color:rgba(255,255,255,0.6);"></i>
                <span style="color:rgba(255,255,255,0.7);font-size:0.85rem;">No photo yet</span>
            </div>
            @endif
        </div>
        <label style="display:block;width:100%;padding:10px;background:#eff6ff;border:2px dashed #93c5fd;border-radius:8px;text-align:center;cursor:pointer;font-size:0.85rem;color:#3b82f6;font-weight:500;">
            <i class="fas fa-upload" style="margin-right:6px;"></i> {{ $main ? 'Replace Photo' : 'Upload Photo' }}
            <input type="file" name="photos[main_image]" accept="image/*" style="display:none;" onchange="previewPhoto(this,'main_image')">
        </label>
        @if($main)
        <label style="display:flex;align-items:center;gap:8px;margin-top:10px;cursor:pointer;font-size:0.85rem;color:#ef4444;">
            <input type="checkbox" name="delete_main_image" value="1" style="accent-color:#ef4444;"> Remove photo
        </label>
        @endif
    </div>

    {{-- Facility grid --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:20px;">
        @foreach(['facility_lab'=>'Laboratory','facility_gene'=>'GeneXpert Room','facility_chemistry'=>'Chemistry Room','facility_ultra'=>'Ultrasound','facility_operation'=>'Operation Room','facility_xray'=>'X-Ray'] as $fKey => $fLabel)
        @php $rec = $photos[$fKey] ?? null; @endphp
        <div style="background:white;border-radius:12px;padding:15px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:2px solid {{ $rec ? '#3b82f6' : '#e5e7eb' }};">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                <span style="font-weight:600;color:#1f2937;font-size:0.9rem;">{{ $fLabel }}</span>
                @if($rec)<span style="background:#dbeafe;color:#1d4ed8;font-size:0.7rem;padding:2px 8px;border-radius:20px;">✓</span>@endif
            </div>
            <div style="height:120px;border-radius:8px;overflow:hidden;margin-bottom:10px;background:#f3f4f6;position:relative;">
                @if($rec && $rec->value)
                <img src="{{ asset('storage/'.$rec->value) }}" alt="{{ $fLabel }}"
                     id="prev-{{ $fKey }}"
                     style="width:100%;height:100%;object-fit:cover;display:block;"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div style="display:none;width:100%;height:100%;position:absolute;top:0;left:0;background:#fee2e2;align-items:center;justify-content:center;font-size:0.75rem;color:#ef4444;">Load error</div>
                @else
                <div id="prev-{{ $fKey }}" style="width:100%;height:100%;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-image" style="font-size:1.8rem;color:#93c5fd;"></i>
                </div>
                @endif
            </div>
            <label style="display:block;width:100%;padding:8px;background:#eff6ff;border:1px dashed #93c5fd;border-radius:6px;text-align:center;cursor:pointer;font-size:0.8rem;color:#3b82f6;font-weight:500;">
                <i class="fas fa-upload"></i> {{ $rec ? 'Replace' : 'Upload' }}
                <input type="file" name="photos[{{ $fKey }}]" accept="image/*" style="display:none;" onchange="previewPhoto(this,'{{ $fKey }}')">
            </label>
            @if($rec)
            <label style="display:flex;align-items:center;gap:6px;margin-top:8px;cursor:pointer;font-size:0.8rem;color:#ef4444;">
                <input type="checkbox" name="delete_{{ $fKey }}" value="1" style="accent-color:#ef4444;"> Remove
            </label>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Green area (full width) --}}
    @php $green = $photos['facility_green'] ?? null; @endphp
    <div style="background:white;border-radius:15px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-bottom:25px;border:2px solid {{ $green ? '#3b82f6' : '#e5e7eb' }};">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <span style="font-weight:600;color:#1f2937;">Green Area</span>
            @if($green)<span style="background:#dbeafe;color:#1d4ed8;font-size:0.75rem;padding:3px 10px;border-radius:20px;font-weight:500;">Uploaded</span>@endif
        </div>
        <div style="width:100%;height:160px;border-radius:10px;overflow:hidden;margin-bottom:12px;background:#f3f4f6;">
            @if($green)
            <img src="{{ asset('storage/'.$green->value) }}" id="prev-facility_green" style="width:100%;height:100%;object-fit:cover;"
                 onerror="this.style.display='none'">
            @else
            <div id="prev-facility_green" style="width:100%;height:100%;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;">
                <i class="fas fa-leaf" style="font-size:2.5rem;color:#86efac;"></i>
                <span style="color:#6b7280;font-size:0.85rem;">No photo yet</span>
            </div>
            @endif
        </div>
        <label style="display:block;width:100%;padding:10px;background:#eff6ff;border:2px dashed #93c5fd;border-radius:8px;text-align:center;cursor:pointer;font-size:0.85rem;color:#3b82f6;font-weight:500;">
            <i class="fas fa-upload" style="margin-right:6px;"></i> {{ $green ? 'Replace Photo' : 'Upload Photo' }}
            <input type="file" name="photos[facility_green]" accept="image/*" style="display:none;" onchange="previewPhoto(this,'facility_green')">
        </label>
        @if($green)
        <label style="display:flex;align-items:center;gap:8px;margin-top:10px;cursor:pointer;font-size:0.85rem;color:#ef4444;">
            <input type="checkbox" name="delete_facility_green" value="1" style="accent-color:#ef4444;"> Remove photo
        </label>
        @endif
    </div>

    <button type="submit" style="background:#3b82f6;color:white;padding:12px 32px;border:none;border-radius:10px;font-size:0.95rem;font-weight:600;cursor:pointer;">
        <i class="fas fa-save" style="margin-right:8px;"></i> Save Hospital Photos
    </button>
</form>

<script>
function previewPhoto(input, key) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var el = document.getElementById('prev-' + key);
            el.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
            el.style.background = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
