@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="fw-bold" style="color: #f5c518;">Genres</h1>
            <p class="text-white-50 mb-0">Browse all genres and discover top picks for each.</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($genres as $entry)
            <div class="col-md-4">
                @include('genres.genre-card', ['genre' => $entry->genre, 'best_movie' => $entry->best_movie])
            </div>
        @endforeach
    </div>
</div>
@endsection
