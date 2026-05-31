<?php

namespace App\Livewire;

use App\Models\Movie;
use App\Models\Genre;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Welcome extends Component
{
    public $movies;
    public $genres;

    public function mount()
    {
        $this->movies = Movie::with('reviews')
            ->get()
            ->sortByDesc(fn($m) => $m->rating)
            ->take(5)
            ->values();

        $genres = Genre::with(['movies.reviews', 'images'])->get();

        $this->genres = $genres->map(function ($genre) {
            $best = $genre->movies->sortByDesc(fn ($m) => $m->rating)->first();

            return (object) [
                'genre' => $genre,
                'best_movie' => $best,
            ];
        })->sortByDesc(fn ($g) => $g->genre->movies->count())->take(3)->values();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('components.welcome');
    }
}