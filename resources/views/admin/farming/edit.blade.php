@extends('layouts.admin')

@section('title', 'Edit Farming Item')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.farming.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">← Back to Farming Items</a>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 600px;">
    <form method="POST" action="{{ route('admin.farming.update', $item) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Label *</label>
            <input type="text" name="label" value="{{ old('label', $item->label) }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            @error('label')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Image</label>
            @if($item->image)
            <img id="img-preview" src="{{ asset('images/'.$item->image) }}" alt="{{ $item->label }}"
                 style="display: block; margin-bottom: 10px; width: 120px; height: 90px; object-fit: cover; border-radius: 8px;"
                 onerror="this.style.display='none'">
            @else
            <img id="img-preview" src="" alt="Preview" style="display: none; margin-bottom: 10px; width: 120px; height: 90px; object-fit: cover; border-radius: 8px;">
            @endif
            <input type="file" name="image" accept="image/*"
                   onchange="document.getElementById('img-preview').src = URL.createObjectURL(this.files[0]); document.getElementById('img-preview').style.display='block';"
                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            <p style="color: #9ca3af; font-size: 0.8rem; margin-top: 4px;">Leave empty to keep current image.</p>
            @error('image')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Alt Text</label>
            <input type="text" name="alt_text" value="{{ old('alt_text', $item->alt_text) }}"
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            </div>
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Visible</label>
                <select name="is_visible" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="1" {{ $item->is_visible ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$item->is_visible ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            Update Item
        </button>
    </form>
</div>
@endsection

