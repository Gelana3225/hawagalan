<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInfoController extends Controller
{
    public function edit(): View
    {
        $contacts = ContactInfo::all();
        return view('admin.contact.edit', compact('contacts'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'contacts'          => 'nullable|array',
            'contacts.*.key'    => 'required|string|max:100',
            'contacts.*.value'  => 'nullable|string|max:500',
            'contacts.*.label'  => 'nullable|string|max:100',
        ]);

        foreach ($request->input('contacts', []) as $item) {
            if (!empty($item['key'])) {
                ContactInfo::updateOrCreate(
                    ['key' => $item['key']],
                    ['value' => $item['value'] ?? '', 'label' => $item['label'] ?? '']
                );
            }
        }

        return back()->with('success', 'Contact information updated successfully.');
    }
}
