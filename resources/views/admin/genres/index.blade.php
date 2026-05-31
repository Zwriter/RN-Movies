@extends('layouts.app')

@section('content')
<div class="container py-5">
    @include('admin.partials.secondary-nav')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #f5c518;">Manage Genres</h1>
            <p class="text-muted mb-0">Create and edit genre categories for movies.</p>
        </div>
        <a href="{{ route('admin.genres.create') }}" class="btn btn-warning">New Genre</a>
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
                            <th>Genre</th>
                            <th>Title</th>
                            <th>Movies</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($genres as $genre)
                            <tr>
                                <td>{{ $genre->genre }}</td>
                                <td>{{ $genre->title }}</td>
                                <td>{{ $genre->movies_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                                    <form method="POST" action="{{ route('admin.genres.destroy', $genre) }}" class="d-inline-block" onsubmit="return confirm('Delete this genre?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No genres found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $genres->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
