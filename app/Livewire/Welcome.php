<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Welcome extends Component
{
    public $movies;

    public function mount()
    {
        $this->movies = Movie::with('reviews')
            ->get()
            ->sortByDesc(fn($m) => $m->rating)
            ->take(5)
            ->values();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('components.welcome');
    }
}