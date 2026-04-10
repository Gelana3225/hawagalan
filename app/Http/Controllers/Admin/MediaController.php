<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.media.index', [
            'media' => Media::latest()->paginate(24),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:20480',
            'alt_text' => 'nullable|string|max:500',
        ]);

        $file = $request->file('image');
        $path = $file->store('images', 'public');

        Media::create([
            'filename'  => $file->getClientOriginalName(),
            'path'      => $path,
            'disk'      => 'public',
            'mime_type' => $file->getMimeType(),
            'size'      => $file->getSize(),
            'alt_text'  => $request->input('alt_text', ''),
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        $this->deleteImage($media->path);
        $media->delete();

        return back()->with('success', 'Image deleted.');
    }
}
