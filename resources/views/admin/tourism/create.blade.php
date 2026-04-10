@extends('layouts.admin')

@section('title', 'Add Tourism Attraction')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.tourism.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">← Back to Tourism</a>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 700px;">
    <form method="POST" action="{{ route('admin.tourism.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            @error('name')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Description</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Image</label>
            <input type="file" name="image" accept="image/*"
                   onchange="document.getElementById('img-preview').src = URL.createObjectURL(this.files[0]); document.getElementById('img-preview').style.display='block';"
                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            <img id="img-preview" src="" alt="Preview" style="display: none; margin-top: 10px; width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
            @error('image')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Category</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. nature, culture, history"
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Features (comma-separated)</label>
            <input type="text" name="features" value="{{ old('features') }}" placeholder="e.g. Hiking, Photography, Wildlife"
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
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
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            Create Attraction
        </button>
    </form>
</div>
@endsection

