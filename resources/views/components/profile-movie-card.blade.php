<div class="col-4">
    <a href="{{ route('movies.show', $movie) }}" class="text-decoration-none">
        <div class="position-relative">
            <img src="{{ $movie->posterURI }}"
                alt="{{ $movie->title }}"
                class="w-100 rounded"
                style="height: 160px; object-fit: cover;">
            <div class="position-absolute top-0 end-0 m-1 px-2 py-1 rounded small fw-bold"
                style="background-color: #f5c518; color: #000;">
                ⭐ {{ round($movie->avg_rating, 1) }}
            </div>
        </div>
        <p class="mt-2 mb-0 small fw-bold text-truncate" style="color: #fff;">{{ $movie->title }}</p>
        @if($subtitle ?? null)
            <small style="color: #888;">{{ $subtitle }}</small>
        @endif
    </a>
</div>