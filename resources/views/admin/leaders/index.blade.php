@extends('layouts.admin')

@section('title', 'Leaders')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin: 0;">Leaders ({{ $leaders->total() }})</h2>
    <a href="{{ route('admin.leaders.create') }}" style="background: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
        + Add Leader
    </a>
</div>

<div style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Photo</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Name</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Title</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Order</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Visible</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leaders as $leader)
            <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px 20px;">
                    @if($leader->photo)
                    <img src="{{ Storage::url($leader->photo) }}" alt="{{ $leader->name }}"
                         style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;"
                         onerror="this.style.display='none'">
                    @else
                    <div style="width: 45px; height: 45px; border-radius: 50%; background: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user" style="color: #9ca3af;"></i>
                    </div>
                    @endif
                </td>
                <td style="padding: 12px 20px; font-weight: 500; color: #1f2937;">{{ $leader->name }}</td>
                <td style="padding: 12px 20px; color: #6b7280; font-size: 0.9rem;">{{ $leader->title }}</td>
                <td style="padding: 12px 20px; color: #6b7280;">{{ $leader->sort_order }}</td>
                <td style="padding: 12px 20px;">
                    <span style="padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: {{ $leader->is_visible ? '#d1fae5' : '#fee2e2' }}; color: {{ $leader->is_visible ? '#065f46' : '#991b1b' }};">
                        {{ $leader->is_visible ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td style="padding: 12px 20px;">
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.leaders.edit', $leader) }}" style="color: #3b82f6; text-decoration: none; font-size: 0.85rem; font-weight: 500;">Edit</a>
                        <form method="POST" action="{{ route('admin.leaders.destroy', $leader) }}" onsubmit="return confirm('Delete this leader?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-size: 0.85rem; font-weight: 500; padding: 0;">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 40px; text-align: center; color: #9ca3af;">No leaders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $leaders->links() }}
</div>
@endsection

