<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\FarmingItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FarmingItemController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.farming.index', [
            'items' => FarmingItem::ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.farming.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'label'      => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'alt_text'   => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'nullable|boolean',
        ]);

        $data['image']      = $this->uploadImage($request, 'image');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible', true);

        FarmingItem::create($data);

        return redirect()->route('admin.farming.index')->with('success', 'Farming item created successfully.');
    }

    public function edit(FarmingItem $farming): View
    {
        return view('admin.farming.edit', ['item' => $farming]);
    }

    public function update(Request $request, FarmingItem $farming): RedirectResponse
    {
        $data = $request->validate([
            'label'      => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'alt_text'   => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($farming->image);
            $data['image'] = $this->uploadImage($request, 'image');
        } else {
            unset($data['image']);
        }

        $data['sort_order'] = $data['sort_order'] ?? $farming->sort_order;
        $data['is_visible'] = $request->boolean('is_visible', true);

        $farming->update($data);

        return redirect()->route('admin.farming.index')->with('success', 'Farming item updated successfully.');
    }

    public function destroy(FarmingItem $farming): RedirectResponse
    {
        $this->deleteImage($farming->image);
        $farming->delete();

        return redirect()->route('admin.farming.index')->with('success', 'Farming item deleted.');
    }
}
