<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ $movie->posterURI }}" class="card-img-top" alt="{{ $movie->title }}">
                </div>
            </div>
            <div class="col-md-7">
                <h1>{{ $movie->title }}</h1>
                <p class="text-muted mb-1">{{ $movie->year }} · {{ $movie->runtime }} min</p>
                <p class="text-muted mb-3">{{ $movie->excerpt }}</p>

                <div class="mb-4">
                    <h5>Synopsis</h5>
                    <p>{{ $movie->plot }}</p>
                </div>

                <div class="mb-4">
                    <h6>Genres</h6>
                    <p class="mb-0">
                        {{ $movie->genres->pluck('name')->join(', ') ?: 'No genres available' }}
                    </p>
                </div>

                <div class="mb-4">
                    <h6>Rating</h6>
                    <p class="mb-0 text-muted">{{ round($movie->rating, 1) }} star{{ $movie->rating === 1 ? '' : 's' }}</p>
                </div>

                <a href="/movies" class="btn btn-secondary">Back to movies</a>
            </div>
        </div>
    </div>
</div>
