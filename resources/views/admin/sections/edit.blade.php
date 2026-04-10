@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst($page) . ' Page')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.sections.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">
        ← Back to Pages
    </a>
</div>

<form method="POST" action="{{ route('admin.sections.update', $page) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if($sections->isEmpty())
    <div style="background: white; border-radius: 15px; padding: 40px; text-align: center; color: #6b7280; box-shadow: 0 2px 10px rgba(0,0,0,0.06);">
        <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 15px; color: #93c5fd;"></i>
        <p>No sections found for this page yet. Use the form below to add content.</p>
    </div>
    @else
    @foreach($sections as $sectionName => $items)
    <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px;">
        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; text-transform: capitalize; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb;">
            {{ $sectionName }}
        </h3>
        @foreach($items as $item)
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px; text-transform: capitalize;">
                {{ str_replace('_', ' ', $item->key) }}
            </label>
            @if(str_contains($item->key, 'image') || str_contains($item->key, 'photo') || str_contains($item->key, 'logo') || str_contains($item->key, 'slide_'))
                @if($item->value)
                <div style="margin-bottom: 8px;">
                    <img src="{{ Storage::url($item->value) }}" alt="{{ $item->key }}"
                         style="height: 80px; width: auto; border-radius: 8px; object-fit: cover;"
                         onerror="this.style.display='none'">
                </div>
                @endif
                <input type="file" name="{{ $sectionName }}__{{ $item->key }}" accept="image/*"
                       style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            @elseif(str_contains($item->key, 'body') || strlen($item->value ?? '') > 100)
                <textarea name="sections[{{ $sectionName }}][{{ $item->key }}]" rows="5"
                          style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ $item->value }}</textarea>
            @else
                <input type="text" name="sections[{{ $sectionName }}][{{ $item->key }}]"
                       value="{{ $item->value }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            @endif
            @error("sections.{$sectionName}.{$item->key}")
            <p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>
        @endforeach
    </div>
    @endforeach
    @endif

    <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
        Save Changes
    </button>
</form>

{{-- Quick-add missing section keys for home page --}}
@if($page === 'home' || $page === 'biography')
@php
$predefined = $page === 'biography' ? [
    'default' => ['hero_title','hero_subtitle','profile_image','intro','early_life','military_career','legacy','gallery_1','gallery_2','gallery_3','gallery_4'],
] : [
    'hero' => ['title','subtitle'],
    'hero_slides' => ['slide_1','slide_2','slide_3','slide_4','slide_5'],
    'site' => ['logo'],
    'about' => ['title','body','image','invitations_title'],
    'city_leader_invite' => ['city_leader_image','city_leader_text','city_leader_btn'],
    'prosperity_invite' => ['prosperity_image','prosperity_text','prosperity_btn'],
    'investor_invite' => ['investor_image','investor_text','investor_btn'],
    'charity' => ['main_image','main_title','main_text','gallery_1_image','gallery_1_title','gallery_2_image','gallery_2_title','gallery_3_image','gallery_3_title','gallery_4_image','gallery_4_title','gallery_5_image','gallery_5_title','gallery_6_image','gallery_6_title'],
    'hospital' => ['title','main_image','description','facility_lab','facility_gene','facility_chemistry','facility_ultra','facility_operation','facility_xray','facility_green'],
    'football' => ['title','subtitle','body','main_image','gallery_1','gallery_2','gallery_3','gallery_4','gallery_5','gallery_6'],
];
$existing = \App\Models\PageSection::where('page','home')->get()->groupBy('section')->map(fn($g)=>$g->pluck('value','key'));
$missing = [];
foreach($predefined as $sec => $keys) {
    foreach($keys as $k) {
        if(!isset($existing[$sec][$k])) $missing[$sec][] = $k;
    }
}
@endphp
@if(count(array_filter($missing)))
<div style="background:#fefce8;border:1px solid #fde68a;border-radius:15px;padding:25px;margin-top:30px;">
    <h3 style="font-size:1rem;font-weight:600;color:#92400e;margin-bottom:15px;">
        <i class="fas fa-plus-circle"></i> Add Missing Section Fields
    </h3>
    <form method="POST" action="{{ route('admin.sections.update', $page) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @foreach($missing as $sec => $keys)
        @if(count($keys))
        <div style="margin-bottom:20px;">
            <h4 style="font-size:0.9rem;font-weight:600;color:#374151;text-transform:capitalize;margin-bottom:10px;">{{ str_replace('_',' ',$sec) }}</h4>
            @foreach($keys as $k)
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:0.8rem;font-weight:500;color:#6b7280;margin-bottom:4px;">{{ str_replace('_',' ',$k) }}</label>
                @if(str_contains($k,'image') || str_contains($k,'photo') || str_contains($k,'logo') || str_contains($k,'slide_'))
                <input type="file" name="{{ $sec }}__{{ $k }}" accept="image/*"
                       style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;">
                @elseif(str_contains($k,'text') || str_contains($k,'body'))
                <textarea name="sections[{{ $sec }}][{{ $k }}]" rows="4"
                          style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;resize:vertical;"></textarea>
                @else
                <input type="text" name="sections[{{ $sec }}][{{ $k }}]"
                       style="width:100%;padding:10px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;">
                @endif
            </div>
            @endforeach
        </div>
        @endif
        @endforeach
        <button type="submit" style="background:#d97706;color:white;padding:10px 24px;border:none;border-radius:8px;font-size:0.9rem;font-weight:600;cursor:pointer;">
            Add Fields
        </button>
    </form>
</div>
@endif
@endif
@endsection

