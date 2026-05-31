<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->query('q', ''));

        if ($query === '') {
            return response()->json([]);
        }

        $movies = Movie::where('title', 'like', "%{$query}%")
            ->orderBy('title')
            ->limit(8)
            ->get(['title', 'slug']);

        return response()->json($movies->map(fn ($movie) => [
            'title' => $movie->title,
            'url' => route('movies.show', $movie),
        ]));
    }
}
