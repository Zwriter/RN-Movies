<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class)->name('movies.top-rated');

Route::get('/movies', \App\Livewire\Movies::class);

Route::get('/movies/{movie}', \App\Livewire\Movie::class)->name('movies.show');

