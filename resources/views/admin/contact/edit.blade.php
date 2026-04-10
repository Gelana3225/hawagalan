@extends('layouts.admin')

@section('title', 'Contact Info')

@section('content')
<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); max-width: 700px;">
    <form method="POST" action="{{ route('admin.contact.update') }}">
        @csrf
        @method('PUT')

        @if($contacts->isEmpty())
        <p style="color: #6b7280; margin-bottom: 20px;">No contact entries found. Add them via the seeder first.</p>
        @else
        @foreach($contacts as $index => $contact)
        <div style="background: #f8fafc; border-radius: 10px; padding: 20px; margin-bottom: 15px;">
            <input type="hidden" name="contacts[{{ $index }}][key]" value="{{ $contact->key }}">
            <div style="margin-bottom: 12px;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ $contact->label ?: $contact->key }}
                </label>
                <input type="text" name="contacts[{{ $index }}][value]" value="{{ old("contacts.{$index}.value", $contact->value) }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; background: white;">
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 500; color: #9ca3af; margin-bottom: 4px;">Display Label</label>
                <input type="text" name="contacts[{{ $index }}][label]" value="{{ old("contacts.{$index}.label", $contact->label) }}"
                       style="width: 100%; padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.85rem; background: white;">
            </div>
        </div>
        @endforeach
        @endif

        <button type="submit" style="background: #3b82f6; color: white; padding: 12px 30px; border: none; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer;">
            Save Contact Info
        </button>
    </form>
</div>
@endsection

