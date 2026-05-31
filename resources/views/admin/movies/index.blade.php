@extends('layouts.app')

@section('content')
<div class="container py-5">
    @include('admin.partials.secondary-nav')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #f5c518;">Manage Movies</h1>
            <p class="text-muted mb-0">Create, update, and remove movies from the catalog.</p>
        </div>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-warning">New Movie</a>
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
                            <th>Title</th>
                            <th>Year</th>
                            <th>Director</th>
                            <th>Genres</th>
                            <th>Reviews</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $movie)
                            <tr>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->year }}</td>
                                <td>{{ optional($movie->people)->pluck('name')->join(', ') }}</td>
                                <td>{{ $movie->genres->pluck('genre')->join(', ') }}</td>
                                <td>{{ $movie->reviews_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.movies.edit', $movie) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                                    <form method="POST" action="{{ route('admin.movies.destroy', $movie) }}" class="d-inline-block" onsubmit="return confirm('Delete this movie?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No movies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
