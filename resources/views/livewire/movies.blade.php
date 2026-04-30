<div>
    <div class="container mt-5 text-center">
        <h1>Movies</h1>
    </div>

    <div class="container mt-4">
        <div class="row g-3 align-items-end">

            {{-- Search bar --}}
            <div class="col-md-5">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="form-control"
                    placeholder="Search movies..."
                />
            </div>

            {{-- Filters --}}
            <div class="col-md-5">
                <div class="row g-2">
                    <div class="col-4">
                        <select wire:model.live="filterGenre" class="form-select">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select wire:model.live="filterRating" class="form-select">
                            <option value="">All Ratings</option>
                            @foreach(range(1, 5) as $r)
                                <option value="{{ $r }}">{{ $r }}+</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select wire:model.live="filterYear" class="form-select">
                            <option value="">All Years</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Sort --}}
            <div class="col-md-2">
                <select wire:model.live="sortBy" class="form-select">
                    <option value="name_asc">Name A→Z</option>
                    <option value="name_desc">Name Z→A</option>
                    <option value="year_asc">Year ↑</option>
                    <option value="year_desc">Year ↓</option>
                    <option value="rating_asc">Rating ↑</option>
                    <option value="rating_desc">Rating ↓</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Movies Grid --}}
    <div class="container mt-5">
        <div class="row">
            @forelse($movies as $movie)
                <div class="col-md-3 mb-4">
                    <livewire:movie-post-card :movie="$movie" :key="$movie->id" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No movies found.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="container mt-5">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>
</div>
