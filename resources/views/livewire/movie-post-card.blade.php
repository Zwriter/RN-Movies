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
            <button wire:click="toggleContent" class="btn btn-secondary btn-sm">
                {{ $showFullContent ? 'Show Less' : 'Read More' }}
            </button>
            <a href="/movies/{{ $movie->slug }}" class="btn btn-primary btn-sm">View</a>
        </div>
    </div>
</div>