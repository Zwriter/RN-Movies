<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class)->name('movies.top-rated');

Route::get('/movies', function () {
    $movies = \App\Models\Movie::paginate(12);

    return view('movies', compact('movies'));
});

Route::get('/movies/{movie}', \App\Livewire\Movie::class)->name('movies.show');

