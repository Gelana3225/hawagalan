@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
<!-- Upload Form -->
<div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-bottom: 25px;">
    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 15px;">Upload Image</h3>
    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data"
          style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
        @csrf
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Image *</label>
            <input type="file" name="image" accept="image/*" required
                   style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
        </div>
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 6px;">Alt Text</label>
            <input type="text" name="alt_text" placeholder="Describe the image..."
                   style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
        </div>
        <button type="submit" style="background: #3b82f6; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; white-space: nowrap;">
            Upload
        </button>
    </form>
    @error('image')<p style="color: #ef4444; font-size: 0.8rem; margin-top: 8px;">{{ $message }}</p>@enderror
</div>

<!-- Media Grid -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin: 0;">All Images ({{ $media->total() }})</h3>
</div>

@if($media->isEmpty())
<div style="background: white; border-radius: 15px; padding: 60px; text-align: center; color: #9ca3af; box-shadow: 0 2px 10px rgba(0,0,0,0.06);">
    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 15px; color: #d1d5db;"></i>
    <p>No images uploaded yet.</p>
</div>
@else
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px;">
    @foreach($media as $item)
    <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); position: relative; group;">
        <div style="height: 140px; overflow: hidden; background: #f3f4f6;">
            <img src="{{ Storage::url($item->path) }}" alt="{{ $item->alt_text ?: $item->filename }}"
                 style="width: 100%; height: 100%; object-fit: cover;"
                 onerror="this.src=''; this.style.display='none'">
        </div>
        <div style="padding: 10px;">
            <p style="font-size: 0.75rem; color: #6b7280; margin: 0 0 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $item->filename }}">
                {{ $item->filename }}
            </p>
            <p style="font-size: 0.7rem; color: #9ca3af; margin: 0 0 8px;">
                {{ number_format($item->size / 1024, 1) }} KB
            </p>
            <div style="display: flex; gap: 8px; align-items: center;">
                <button onclick="navigator.clipboard.writeText('{{ Storage::url($item->path) }}')"
                        style="flex: 1; background: #f3f4f6; color: #374151; border: none; padding: 5px 8px; border-radius: 6px; font-size: 0.75rem; cursor: pointer;">
                    Copy URL
                </button>
                <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Delete this image?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background: #fee2e2; color: #ef4444; border: none; padding: 5px 8px; border-radius: 6px; font-size: 0.75rem; cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top: 25px;">{{ $media->links() }}</div>
@endif
@endsection

