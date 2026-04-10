@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin: 0;">Services ({{ $services->total() }})</h2>
    <a href="{{ route('admin.services.create') }}" style="background: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">+ Add Service</a>
</div>

<div style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Icon</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Name</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Order</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Visible</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px 20px;">
                    @if($service->icon)
                    <i class="{{ $service->icon }}" style="font-size: 1.3rem; color: #3b82f6;"></i>
                    @else
                    <span style="color: #9ca3af;">—</span>
                    @endif
                </td>
                <td style="padding: 12px 20px; font-weight: 500; color: #1f2937;">{{ $service->name }}</td>
                <td style="padding: 12px 20px; color: #6b7280;">{{ $service->sort_order }}</td>
                <td style="padding: 12px 20px;">
                    <span style="padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: {{ $service->is_visible ? '#d1fae5' : '#fee2e2' }}; color: {{ $service->is_visible ? '#065f46' : '#991b1b' }};">
                        {{ $service->is_visible ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td style="padding: 12px 20px;">
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.services.edit', $service) }}" style="color: #3b82f6; text-decoration: none; font-size: 0.85rem; font-weight: 500;">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-size: 0.85rem; font-weight: 500; padding: 0;">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding: 40px; text-align: center; color: #9ca3af;">No services found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top: 20px;">{{ $services->links() }}</div>
@endsection

