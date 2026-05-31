@extends('layouts.app')

@section('content')
<div>
    {{-- Genre Header --}}
    <div class="container pt-5 pb-4">
        <div class="row align-items-center g-4">
            <div class="col-md-2">
                @if(optional($genre->images)->URL)
                    <img src="{{ $genre->images->URL }}"
                        class="img-fluid rounded"
                        style="max-height: 120px; object-fit: cover;"
                        alt="{{ $genre->title }}">
                @endif
            </div>
            <div class="col-md-10">
                <h1 class="fw-bold mb-1" style="color: #f5c518;">{{ $genre->title }}</h1>
                <p class="text-white-50 mb-3">{{ $genre->description }}</p>
                <a href="{{ route('genres.index') }}" class="btn btn-sm" style="border: 1px solid #555; color: #aaa;">
                    ← Back to Genres
                </a>
            </div>
        </div>
    </div>

    {{-- Movies Grid --}}
    <div class="container pb-5">
        <div class="row">
            @forelse($genre->movies as $movie)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('movies.show', $movie) }}" class="text-decoration-none">
                        <div class="card border-0 overflow-hidden h-100"
                            style="background-color: #2a2a3e; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

                            {{-- Poster --}}
                            <div class="position-relative">
                                <img src="{{ $movie->posterURI }}"
                                    class="card-img-top"
                                    alt="{{ $movie->title }}"
                                    style="height: 280px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-2 px-2 py-1 rounded fw-bold small"
                                    style="background-color: #f5c518; color: #000;">
                                    ⭐ {{ round($movie->avg_rating, 1) }}
                                </div>
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold mb-1" style="color: #fff;">{{ $movie->title }}</h6>
                                <small style="color: #888;">{{ $movie->year }} · {{ $movie->runtime }} min</small>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-white-50">No movies in this genre yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection