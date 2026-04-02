<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;

class MoviePostCard extends Component
{
    public Movie $movie;
    public $showFullContent = false;

    public function mount(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function toggleContent()
    {
        $this->showFullContent = !$this->showFullContent;
    }

    public function render()
    {
        return view('livewire.movie-post-card');
    }
}
