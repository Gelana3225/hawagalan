@extends('layouts.admin')

@section('title', 'News Posts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin: 0;">News Posts ({{ $posts->total() }})</h2>
    <a href="{{ route('admin.news.create') }}" style="background: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">+ New Post</a>
</div>

<div style="background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Title</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Published</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Date</th>
                <th style="padding: 14px 20px; text-align: left; font-size: 0.85rem; font-weight: 600; color: #6b7280;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px 20px; font-weight: 500; color: #1f2937;">{{ Str::limit($post->title, 60) }}</td>
                <td style="padding: 12px 20px;">
                    <span style="padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; background: {{ $post->is_published ? '#d1fae5' : '#fef3c7' }}; color: {{ $post->is_published ? '#065f46' : '#92400e' }};">
                        {{ $post->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td style="padding: 12px 20px; color: #6b7280; font-size: 0.9rem;">
                    {{ $post->published_at?->format('M d, Y') ?? '—' }}
                </td>
                <td style="padding: 12px 20px;">
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.news.edit', $post) }}" style="color: #3b82f6; text-decoration: none; font-size: 0.85rem; font-weight: 500;">Edit</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-size: 0.85rem; font-weight: 500; padding: 0;">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding: 40px; text-align: center; color: #9ca3af;">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top: 20px;">{{ $posts->links() }}</div>
@endsection

