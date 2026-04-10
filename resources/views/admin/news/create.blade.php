@extends('layouts.admin')

@section('title', 'New Post')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.news.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 0.9rem;">← Back to News</a>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 700px;">
    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            @error('title')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Body *</label>
            <textarea name="body" rows="8" required
                      style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('body') }}</textarea>
            @error('body')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Image</label>
            <input type="file" name="image" accept="image/*"
                   onchange="document.getElementById('img-preview').src = URL.createObjectURL(this.files[0]); document.getElementById('img-preview').style.display='block';"
                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            <img id="img-preview" src="" alt="Preview" style="display: none; margin-top: 10px; width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Published At</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            </div>
            <div style="display: flex; align-items: flex-end; padding-bottom: 2px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #374151;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                           style="width: 18px; height: 18px; cursor: pointer;">
                    Publish now
                </label>
            </div>
        </div>

        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            Create Post
        </button>
    </form>
</div>
@endsection

