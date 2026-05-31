<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;

class MovieActions extends Component
{
    public Movie $movie;
    public bool $inWatchlist = false;
    public bool $inWatched = false;
    public bool $inFavorites = false;
    public string $statusMessage = '';

    public function mount(Movie $movie)
    {
        $this->movie = $movie;
        $this->syncStatus();
    }

    private function syncStatus(): void
    {
        $status = auth()->user()->movieStatus($this->movie);
        $this->inWatchlist  = (bool) optional($status?->pivot)->watchlist;
        $this->inWatched    = (bool) optional($status?->pivot)->watched;
        $this->inFavorites  = (bool) optional($status?->pivot)->favorite;
    }

    public function toggleWatchlist(): void
    {
        $user = auth()->user();
        if ($this->inWatchlist) {
            $user->movies()->updateExistingPivot($this->movie->id, ['watchlist' => false]);
            $this->statusMessage = 'Removed from your watchlist.';
        } else {
            $user->movies()->syncWithoutDetaching([
                $this->movie->id => ['watchlist' => true],
            ]);
            $this->statusMessage = 'Added to your watchlist.';
        }
        $this->syncStatus();
    }

    public function toggleWatched(): void
    {
        $user = auth()->user();
        if ($this->inWatched) {
            $user->movies()->updateExistingPivot($this->movie->id, ['watched' => false]);
            $this->statusMessage = 'Removed from watched history.';
        } else {
            $user->movies()->syncWithoutDetaching([
                $this->movie->id => ['watched' => true, 'watchlist' => false],
            ]);
            $this->statusMessage = 'Marked as watched.';
        }
        $this->syncStatus();
    }

    public function toggleFavorite(): void
    {
        $user = auth()->user();
        if ($this->inFavorites) {
            $user->movies()->updateExistingPivot($this->movie->id, ['favorite' => false]);
            $this->statusMessage = 'Removed from favorites.';
        } else {
            $user->movies()->syncWithoutDetaching([
                $this->movie->id => ['favorite' => true],
            ]);
            $this->statusMessage = 'Added to favorites.';
        }
        $this->syncStatus();
    }

    public function render()
    {
        return view('livewire.movie-actions');
    }
}