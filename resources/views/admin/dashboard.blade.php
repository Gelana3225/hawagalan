@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
    @php
        $cards = [
            ['label' => 'Leaders', 'count' => $counts['leaders'], 'icon' => 'fas fa-users', 'color' => '#3b82f6', 'route' => 'admin.leaders.index'],
            ['label' => 'Services', 'count' => $counts['services'], 'icon' => 'fas fa-cogs', 'color' => '#10b981', 'route' => 'admin.services.index'],
            ['label' => 'Farming Items', 'count' => $counts['farming'], 'icon' => 'fas fa-seedling', 'color' => '#f59e0b', 'route' => 'admin.farming.index'],
            ['label' => 'Tourism', 'count' => $counts['tourism'], 'icon' => 'fas fa-mountain', 'color' => '#8b5cf6', 'route' => 'admin.tourism.index'],
            ['label' => 'News Posts', 'count' => $counts['news'], 'icon' => 'fas fa-newspaper', 'color' => '#ef4444', 'route' => 'admin.news.index'],
            ['label' => 'Media Files', 'count' => $counts['media'], 'icon' => 'fas fa-images', 'color' => '#06b6d4', 'route' => 'admin.media.index'],
        ];
    @endphp

    @foreach($cards as $card)
    <a href="{{ route($card['route']) }}" style="text-decoration: none;">
        <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 20px; transition: transform 0.2s, box-shadow 0.2s;"
             onmouseenter="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
             onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.06)'">
            <div style="width: 55px; height: 55px; border-radius: 12px; background: {{ $card['color'] }}20; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="{{ $card['icon'] }}" style="font-size: 1.4rem; color: {{ $card['color'] }};"></i>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: 700; color: #1f2937; line-height: 1;">{{ $card['count'] }}</div>
                <div style="font-size: 0.85rem; color: #6b7280; margin-top: 3px;">{{ $card['label'] }}</div>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Quick Links -->
<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);">
    <h3 style="font-size: 1.1rem; font-weight: 600; color: #1f2937; margin-bottom: 20px;">Quick Actions</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
        <a href="{{ route('admin.sections.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #f8fafc; border-radius: 10px; text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: background 0.2s;"
           onmouseenter="this.style.background='#e0f2fe'" onmouseleave="this.style.background='#f8fafc'">
            <i class="fas fa-file-alt" style="color: #3b82f6;"></i> Edit Page Sections
        </a>
        <a href="{{ route('admin.leaders.create') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #f8fafc; border-radius: 10px; text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: background 0.2s;"
           onmouseenter="this.style.background='#e0f2fe'" onmouseleave="this.style.background='#f8fafc'">
            <i class="fas fa-user-plus" style="color: #10b981;"></i> Add Leader
        </a>
        <a href="{{ route('admin.news.create') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #f8fafc; border-radius: 10px; text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: background 0.2s;"
           onmouseenter="this.style.background='#e0f2fe'" onmouseleave="this.style.background='#f8fafc'">
            <i class="fas fa-plus" style="color: #ef4444;"></i> New Post
        </a>
        <a href="{{ route('admin.media.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #f8fafc; border-radius: 10px; text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: background 0.2s;"
           onmouseenter="this.style.background='#e0f2fe'" onmouseleave="this.style.background='#f8fafc'">
            <i class="fas fa-upload" style="color: #06b6d4;"></i> Upload Media
        </a>
        <a href="{{ route('admin.contact.edit') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #f8fafc; border-radius: 10px; text-decoration: none; color: #374151; font-size: 0.9rem; font-weight: 500; transition: background 0.2s;"
           onmouseenter="this.style.background='#e0f2fe'" onmouseleave="this.style.background='#f8fafc'">
            <i class="fas fa-address-book" style="color: #8b5cf6;"></i> Edit Contact
        </a>
    </div>
</div>
@endsection

