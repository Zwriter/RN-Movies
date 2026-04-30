<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Genre as GenreModel;
use App\Models\Movie as MovieModel;
use Illuminate\Database\Eloquent\Builder;

class Movies extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterGenre = '';
    public string $filterRating = '';
    public string $filterYear = '';
    public string $sortBy = 'name_asc';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterGenre(): void { $this->resetPage(); }
    public function updatingFilterRating(): void { $this->resetPage(); }
    public function updatingFilterYear(): void { $this->resetPage(); }
    public function updatingSortBy(): void { $this->resetPage(); }

    public function render()
    {
        [$column, $direction] = explode('_', $this->sortBy, 2);

        $movies = MovieModel::query()
            ->with('genres')
            ->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
            ->select('movies.*')
            ->selectRaw('COALESCE(AVG(reviews.rating), 0) as avg_rating')
            ->when($this->search, fn($q) => $q->where('movies.title', 'like', "%{$this->search}%"))
            ->when($this->filterGenre, fn($q) => $q->whereRelation('genres', 'genre_id', '=', $this->filterGenre))
            ->when($this->filterYear, fn($q) => $q->where('movies.year', $this->filterYear))
            ->groupBy('movies.id')
            ->when($this->filterRating, fn($q) => $q->having('avg_rating', '>=', $this->filterRating))
            ->when(
                $column === 'rating',
                fn($q) => $q->orderBy('avg_rating', $direction),
                fn($q) => $q->orderBy($column === 'name' ? 'movies.title' : 'movies.year', $direction)
            )
            ->paginate(12);

        $genres = GenreModel::orderBy('genre')->get();
        $years  = MovieModel::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('livewire.movies', compact('movies', 'genres', 'years'));
    }
}


