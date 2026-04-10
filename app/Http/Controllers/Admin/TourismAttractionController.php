<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\TourismAttraction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TourismAttractionController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.tourism.index', [
            'attractions' => TourismAttraction::ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.tourism.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'category'    => 'nullable|string|max:100',
            'features'    => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
            'is_visible'  => 'nullable|boolean',
        ]);

        $data['image']      = $this->uploadImage($request, 'image');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible', true);
        $data['features']   = $this->parseFeatures($request->input('features', ''));

        TourismAttraction::create($data);

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism attraction created successfully.');
    }

    public function edit(TourismAttraction $tourism): View
    {
        return view('admin.tourism.edit', ['attraction' => $tourism]);
    }

    public function update(Request $request, TourismAttraction $tourism): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'category'    => 'nullable|string|max:100',
            'features'    => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
            'is_visible'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($tourism->image);
            $data['image'] = $this->uploadImage($request, 'image');
        } else {
            unset($data['image']);
        }

        $data['sort_order'] = $data['sort_order'] ?? $tourism->sort_order;
        $data['is_visible'] = $request->boolean('is_visible', true);
        $data['features']   = $this->parseFeatures($request->input('features', ''));

        $tourism->update($data);

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism attraction updated successfully.');
    }

    public function destroy(TourismAttraction $tourism): RedirectResponse
    {
        $this->deleteImage($tourism->image);
        $tourism->delete();

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism attraction deleted.');
    }

    private function parseFeatures(string $input): array
    {
        if (empty(trim($input))) {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode(',', $input))));
    }
}
