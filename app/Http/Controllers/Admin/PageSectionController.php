<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    public function heroSlides(): View
    {
        $slides = \App\Models\PageSection::where('page', 'home')
            ->where('section', 'hero_slides')
            ->orderBy('key')
            ->get()
            ->keyBy('key');

        return view('admin.hero-slides', compact('slides'));
    }

    public function updateHeroSlides(Request $request): RedirectResponse
    {
        $request->validate([
            'slides.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $key = 'slide_' . $i;

            // Handle delete checkbox
            if ($request->has('delete_' . $key)) {
                $existing = \App\Models\PageSection::where('page', 'home')
                    ->where('section', 'hero_slides')
                    ->where('key', $key)
                    ->first();
                if ($existing) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->value);
                    $existing->delete();
                }
                continue;
            }

            // Handle new upload
            if ($request->hasFile('slides.' . $i) && $request->file('slides.' . $i)->isValid()) {
                $file = $request->file('slides.' . $i);

                // Delete old file if exists
                $existing = \App\Models\PageSection::where('page', 'home')
                    ->where('section', 'hero_slides')
                    ->where('key', $key)
                    ->first();
                if ($existing) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->value);
                }

                $path = $file->store('images', 'public');
                \App\Models\PageSection::updateOrCreate(
                    ['page' => 'home', 'section' => 'hero_slides', 'key' => $key],
                    ['value' => $path]
                );
            }
        }

        return back()->with('success', 'Hero slideshow updated successfully.');
    }

    public function footballPhotos(): View
    {
        $photos = \App\Models\PageSection::where('page','home')
            ->where('section','football')->get()->keyBy('key');
        return view('admin.football-photos', compact('photos'));
    }

    public function updateFootballPhotos(Request $request): RedirectResponse
    {
        $request->validate(['photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480']);

        // Only process image fields that actually have a new file uploaded
        $imageFields = ['main_image','gallery_1','gallery_2','gallery_3','gallery_4','gallery_5','gallery_6'];

        foreach ($imageFields as $field) {
            // Delete if checkbox checked
            if ($request->input('delete_'.$field) == '1') {
                $rec = \App\Models\PageSection::where('page','home')
                    ->where('section','football')->where('key',$field)->first();
                if ($rec) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($rec->value);
                    $rec->delete();
                }
                continue;
            }

            // Only store if a real file was uploaded
            $file = $request->file('photos.'.$field);
            if ($file && $file->isValid() && $file->getSize() > 0) {
                $existing = \App\Models\PageSection::where('page','home')
                    ->where('section','football')->where('key',$field)->first();
                if ($existing && $existing->value) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->value);
                }
                $path = $file->store('images','public');
                \App\Models\PageSection::updateOrCreate(
                    ['page'=>'home','section'=>'football','key'=>$field],
                    ['value'=>$path]
                );
            }
            // If no file uploaded, do nothing — keep existing record untouched
        }

        // Only update text fields if they have actual content
        foreach (['title','subtitle','body'] as $k) {
            $val = $request->input('text.'.$k);
            if ($val !== null && $val !== '') {
                \App\Models\PageSection::updateOrCreate(
                    ['page'=>'home','section'=>'football','key'=>$k],
                    ['value'=>$val]
                );
            }
        }

        return back()->with('success', 'Football gallery updated successfully.');
    }

    public function hospitalPhotos(): View
    {
        $photos = \App\Models\PageSection::where('page', 'home')
            ->where('section', 'hospital')
            ->get()->keyBy('key');
        return view('admin.hospital-photos', compact('photos'));
    }

    public function updateHospitalPhotos(Request $request): RedirectResponse
    {
        $request->validate(['photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480']);

        $imageFields = ['main_image','facility_lab','facility_gene','facility_chemistry','facility_ultra','facility_operation','facility_xray','facility_green'];

        foreach ($imageFields as $field) {
            if ($request->input('delete_'.$field) == '1') {
                $rec = \App\Models\PageSection::where('page','home')
                    ->where('section','hospital')->where('key',$field)->first();
                if ($rec) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($rec->value);
                    $rec->delete();
                }
                continue;
            }

            $file = $request->file('photos.'.$field);
            if ($file && $file->isValid() && $file->getSize() > 0) {
                $existing = \App\Models\PageSection::where('page','home')
                    ->where('section','hospital')->where('key',$field)->first();
                if ($existing && $existing->value) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->value);
                }
                $path = $file->store('images','public');
                \App\Models\PageSection::updateOrCreate(
                    ['page'=>'home','section'=>'hospital','key'=>$field],
                    ['value'=>$path]
                );
            }
        }

        foreach (['title','description'] as $k) {
            $val = $request->input('text.'.$k);
            if ($val !== null && $val !== '') {
                \App\Models\PageSection::updateOrCreate(
                    ['page'=>'home','section'=>'hospital','key'=>$k],
                    ['value'=>$val]
                );
            }
        }

        return back()->with('success', 'Hospital photos updated successfully.');
    }

    public function index(): View
    {
        $pages = ['home', 'farming', 'tourism', 'biography'];
        return view('admin.sections.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $sections = PageSection::where('page', $page)
            ->get()
            ->groupBy('section');

        return view('admin.sections.edit', compact('page', 'sections'));
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        foreach ($request->input('sections', []) as $section => $keys) {
            foreach ($keys as $key => $value) {
                PageSection::updateOrCreate(
                    ['page' => $page, 'section' => $section, 'key' => $key],
                    ['value' => $value]
                );
            }
        }

        // Handle image uploads for background images (field name: section__key)
        foreach ($request->allFiles() as $fieldName => $file) {
            if (str_contains($fieldName, '__')) {
                [$section, $key] = explode('__', $fieldName, 2);
                $path = $file->store('images', 'public');
                PageSection::updateOrCreate(
                    ['page' => $page, 'section' => $section, 'key' => $key],
                    ['value' => $path]
                );
            }
        }

        return back()->with('success', 'Page content updated successfully.');
    }
}
