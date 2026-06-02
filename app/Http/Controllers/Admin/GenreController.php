<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('movies')->paginate(20);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'genre' => 'required|string|max:60',
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'img' => 'nullable|string|max:255',
        ]);

        $genre = Genre::create($data);

        Log::info('Admin created genre', ['genre_id' => $genre->id, 'genre' => $genre->genre, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.genres.index')->with('status', 'Genre created successfully.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'genre' => 'required|string|max:60',
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'img' => 'nullable|string|max:255',
        ]);

        $genre->update($data);

        Log::info('Admin updated genre', ['genre_id' => $genre->id, 'genre' => $genre->genre, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.genres.index')->with('status', 'Genre updated successfully.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        Log::warning('Admin deleted genre', ['genre_id' => $genre->id, 'admin_id' => auth()->id()]);

        return back()->with('status', 'Genre deleted successfully.');
    }
}
