<div>
    <div class="card" style="width: 18rem;">
        <img src="{{ $movie->posterURI }}" class="card-img-top" alt="{{ $movie->title }}">
        <div class="card-body">
            <h5 class="card-title">{{ $movie->title }}</h5>
            <p class="card-text">
                @if($showFullContent)
                    {{ $movie->plot }}
                @else
                    {{ $movie->excerpt }}
                @endif
            </p>
            <p class="text-muted">{{ $movie->year }} · {{ $movie->runtime }} min</p>
            <p class="text-muted">⭐ {{ round($movie->rating, 1) }} / 5</p>
            @if($movie->genres->count() > 0)
                <p class="card-text">
                    <small class="text-muted">
                        @foreach($movie->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->genre }}</span>
                        @endforeach
                    </small>
                </p>
            @endif
            <button wire:click="toggleContent" class="btn btn-secondary btn-sm">
                {{ $showFullContent ? 'Show Less' : 'Read More' }}
            </button>
            <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary btn-sm">View</a>
        </div>
    </div>
</div>