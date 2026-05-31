<div>

    {{-- Page Header --}}
    <div class="container pt-5 pb-3">
        <h1 class="fw-bold" style="color: #f5c518; letter-spacing: 1px;">Movies</h1>
        <p class="text-white-50 mb-0">Browse and discover films</p>
    </div>

    {{-- Filters Bar --}}
    <div class="container pb-4">
        <div class="row g-3 align-items-end p-3 rounded" style="background-color: #2a2a3e; border: 1px solid #333;">

            {{-- Search --}}
            <div class="col-md-5">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="form-control"
                    placeholder="Search movies..."
                    style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;"
                />
            </div>

            {{-- Filters --}}
            <div class="col-md-5">
                <div class="row g-2">
                    <div class="col-4">
                        <select wire:model.live="filterGenre" class="form-select"
                            style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select wire:model.live="filterRating" class="form-select"
                            style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            <option value="">All Ratings</option>
                            @foreach(range(1, 5) as $r)
                                <option value="{{ $r }}">{{ $r }}+</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select wire:model.live="filterYear" class="form-select"
                            style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
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
                <select wire:model.live="sortBy" class="form-select"
                    style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
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
    <div class="container pb-5">
        <div class="row">
            @forelse($movies as $movie)
                <div class="col-md-3 mb-4">
                    <livewire:movie-post-card :movie="$movie" :key="$movie->id" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-white-50 fs-5">No movies found.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="container pb-5 d-flex justify-content-center">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>

</div>