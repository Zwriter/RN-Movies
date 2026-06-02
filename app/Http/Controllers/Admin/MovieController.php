<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['poster', 'people', 'genres'])
            ->withCount('reviews')
            ->paginate(15);

        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::orderBy('genre')->get();
        $images = Image::orderByDesc('id')->get();
        $directors = Person::orderBy('name')->get();

        return view('admin.movies.create', compact('genres', 'images', 'directors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:60',
            'slug' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1888|max:' . (date('Y') + 1),
            'runtime' => 'required|integer|min:1',
            'plot' => 'required|string|max:300',
            'poster_id' => 'required|exists:images,id',
            'director_id' => 'required|exists:people,id',
            'genres' => 'nullable|array',
            'genres.*' => 'nullable|exists:genres,id',
        ]);

        $movie = Movie::create($data);
        $movie->genres()->sync($data['genres'] ?? []);

        Log::info('Admin created movie', ['movie_id' => $movie->id, 'title' => $movie->title, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.movies.index')->with('status', 'Movie created successfully.');
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::orderBy('genre')->get();
        $images = Image::orderByDesc('id')->get();
        $directors = Person::orderBy('name')->get();
        $movie->load('genres');

        return view('admin.movies.edit', compact('movie', 'genres', 'images', 'directors'));
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title' => 'required|string|max:60',
            'slug' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1888|max:' . (date('Y') + 1),
            'runtime' => 'required|integer|min:1',
            'plot' => 'required|string|max:300',
            'poster_id' => 'required|exists:images,id',
            'director_id' => 'required|exists:people,id',
            'genres' => 'nullable|array',
            'genres.*' => 'nullable|exists:genres,id',
        ]);

        $movie->update($data);
        $movie->genres()->sync($data['genres'] ?? []);

        Log::info('Admin updated movie', ['movie_id' => $movie->id, 'title' => $movie->title, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.movies.index')->with('status', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        Log::warning('Admin deleted movie', ['movie_id' => $movie->id, 'admin_id' => auth()->id()]);

        return back()->with('status', 'Movie deleted successfully.');
    }
}
