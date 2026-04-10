@extends('layouts.admin')

@section('title', 'Page Sections')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
    @foreach($pages as $page)
    <a href="{{ route('admin.sections.edit', $page) }}" style="text-decoration: none;">
        <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); text-align: center; transition: transform 0.2s, box-shadow 0.2s;"
             onmouseenter="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
             onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.06)'">
            <i class="fas fa-file-alt" style="font-size: 2.5rem; color: #3b82f6; margin-bottom: 15px;"></i>
            <h3 style="font-size: 1.1rem; font-weight: 600; color: #1f2937; text-transform: capitalize; margin: 0;">{{ $page }}</h3>
            <p style="color: #6b7280; font-size: 0.85rem; margin-top: 5px;">Edit content</p>
        </div>
    </a>
    @endforeach
</div>
@endsection

