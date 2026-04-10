@extends('layouts.admin')

@section('title', 'Tourism Attractions')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin: 0;">Tourism Attractions ({{ $attractions->total() }})</h2>
    <a href="{{ route('admin.tourism.create') }}" style="background: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">+ Add Attraction</a>
</div>

<div style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Image</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Name</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Category</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Visible</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attractions as $attraction)
            <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px 20px;">
                    @if($attraction->image)
                    <img src="{{ Storage::url($attraction->image) }}" alt="{{ $attraction->name }}"
                         style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;"
                         onerror="this.style.display='none'">
                    @endif
                </td>
                <td style="padding: 12px 20px; font-weight: 500; color: #1f2937;">{{ $attraction->name }}</td>
                <td style="padding: 12px 20px; color: #6b7280;">{{ $attraction->category ?? '—' }}</td>
                <td style="padding: 12px 20px;">
                    <span style="padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: {{ $attraction->is_visible ? '#d1fae5' : '#fee2e2' }}; color: {{ $attraction->is_visible ? '#065f46' : '#991b1b' }};">
                        {{ $attraction->is_visible ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td style="padding: 12px 20px;">
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.tourism.edit', $attraction) }}" style="color: #3b82f6; text-decoration: none; font-size: 0.85rem; font-weight: 500;">Edit</a>
                        <form method="POST" action="{{ route('admin.tourism.destroy', $attraction) }}" onsubmit="return confirm('Delete this attraction?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-size: 0.85rem; font-weight: 500; padding: 0;">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding: 40px; text-align: center; color: #9ca3af;">No attractions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top: 20px;">{{ $attractions->links() }}</div>
@endsection

