<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    @extends('layouts.app')

    @section('content')
        <div class="container mt-5 text-center">
            <h1>Movies</h1>
        </div>

        <div>
            <div>
                    <!-- search bar -->
            </div>
            <div>
                    <!-- filter by:
                     -genre
                     -rating
                     -year
                      -->
                     
                     <!-- sort by:
                     -name asc/desc
                     -year asc/desc
                     -rating asc/desc
                      -->
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-md-3 mb-4">
                        <livewire:movie-post-card :movie="$movie" :key="$movie->id" />
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                @if($movies->onFirstPage())
                    <button type="button" class="btn btn-secondary" disabled>Previous</button>
                @else
                    <a href="{{ $movies->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                @endif

                <span>Page {{ $movies->currentPage() }} of {{ $movies->lastPage() }}</span>

                @if($movies->hasMorePages())
                    <a href="{{ $movies->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @else
                    <button type="button" class="btn btn-secondary" disabled>Next</button>
                @endif
            </div>
        </div>
        
    @endsection
</div>