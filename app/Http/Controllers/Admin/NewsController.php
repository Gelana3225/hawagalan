<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.news.index', [
            'posts' => NewsPost::latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $data['image']        = $this->uploadImage($request, 'image');
        $data['is_published'] = $request->boolean('is_published', false);
        $data['published_at'] = $data['published_at'] ?? ($data['is_published'] ? now() : null);

        NewsPost::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News post created successfully.');
    }

    public function edit(NewsPost $news): View
    {
        return view('admin.news.edit', ['post' => $news]);
    }

    public function update(Request $request, NewsPost $news): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($news->image);
            $data['image'] = $this->uploadImage($request, 'image');
        } else {
            unset($data['image']);
        }

        $data['is_published'] = $request->boolean('is_published', false);
        if ($data['is_published'] && !$news->published_at && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News post updated successfully.');
    }

    public function destroy(NewsPost $news): RedirectResponse
    {
        $this->deleteImage($news->image);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News post deleted.');
    }
}
