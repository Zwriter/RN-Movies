<?php

namespace App\Livewire;

use App\Models\Movie as MovieModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Movie extends Component
{
    public MovieModel $movie;
    public bool $showFullContent = false;

    public function mount(MovieModel $movie)
    {
        $this->movie = $movie;
    }

    public function toggleContent(): void
    {
        $this->showFullContent = ! $this->showFullContent;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.movie');
    }
}
