<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaderController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.leaders.index', [
            'leaders' => Leader::ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.leaders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'sort_order'  => 'nullable|integer|min:0',
            'is_visible'  => 'nullable|boolean',
        ]);

        $data['photo']      = $this->uploadImage($request, 'photo');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_visible'] = $request->boolean('is_visible', true);

        Leader::create($data);

        return redirect()->route('admin.leaders.index')->with('success', 'Leader created successfully.');
    }

    public function edit(Leader $leader): View
    {
        return view('admin.leaders.edit', compact('leader'));
    }

    public function update(Request $request, Leader $leader): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'sort_order'  => 'nullable|integer|min:0',
            'is_visible'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $this->deleteImage($leader->photo);
            $data['photo'] = $this->uploadImage($request, 'photo');
        } else {
            unset($data['photo']);
        }

        $data['sort_order'] = $data['sort_order'] ?? $leader->sort_order;
        $data['is_visible'] = $request->boolean('is_visible', true);

        $leader->update($data);

        return redirect()->route('admin.leaders.index')->with('success', 'Leader updated successfully.');
    }

    public function destroy(Leader $leader): RedirectResponse
    {
        $this->deleteImage($leader->photo);
        $leader->delete();

        return redirect()->route('admin.leaders.index')->with('success', 'Leader deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate(['order' => 'required|array']);

        foreach ($request->input('order') as $index => $id) {
            Leader::where('id', $id)->update(['sort_order' => $index]);
        }

        return back()->with('success', 'Order updated.');
    }
}
