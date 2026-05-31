<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with(['movies.reviews', 'images'])
            ->get()
            ->map(function ($genre) {
                $best = $genre->movies->sortByDesc(fn ($m) => $m->rating)->first();

                return (object) [
                    'genre' => $genre,
                    'best_movie' => $best,
                ];
            })
            ->sortByDesc(fn ($entry) => $entry->genre->movies->count())
            ->values();

        return view('genres.index', compact('genres'));
    }

    public function show(Genre $genre)
    {
        $genre->load(['movies.reviews', 'images']);

        return view('genres.genre', compact('genre'));
    }
}
