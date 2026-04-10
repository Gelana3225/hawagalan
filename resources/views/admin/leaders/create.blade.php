@extends('layouts.admin')

@section('title', 'Add Leader')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.leaders.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">← Back to Leaders</a>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 700px;">
    <form method="POST" action="{{ route('admin.leaders.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#d1d5db' }}; border-radius: 8px; font-size: 0.9rem;">
            @error('name')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid {{ $errors->has('title') ? '#ef4444' : '#d1d5db' }}; border-radius: 8px; font-size: 0.9rem;">
            @error('title')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Description</label>
            <textarea name="description" rows="5"
                      style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Photo</label>
            <input type="file" name="photo" accept="image/*"
                   onchange="document.getElementById('photo-preview').src = URL.createObjectURL(this.files[0]); document.getElementById('photo-preview').style.display='block';"
                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            <img id="photo-preview" src="" alt="Preview" style="display: none; margin-top: 10px; width: 120px; height: 120px; object-fit: cover; border-radius: 10px;">
            @error('photo')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            </div>
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Visible</label>
                <select name="is_visible" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="1" {{ old('is_visible', '1') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_visible') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            Create Leader
        </button>
    </form>
</div>
@endsection

