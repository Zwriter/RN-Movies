@extends('layouts.app')

@section('content')
<div class="container py-5">
    @include('admin.partials.secondary-nav')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #f5c518;">Review Moderation</h1>
            <p class="text-muted mb-0">Review list for review management and removal.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card bg-dark border-0 shadow-sm text-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Rating</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ optional($review->user)->name ?? 'Unknown' }}</td>
                                <td>{{ optional($review->movie)->title ?? 'Unknown' }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->created_at->format('M j, Y') }}</td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" class="d-inline-block" onsubmit="return confirm('Delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-muted small">{{ \Illuminate\Support\Str::limit($review->review, 150) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No reviews available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $reviews->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
