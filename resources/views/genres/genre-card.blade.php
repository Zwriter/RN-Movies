<div class="card h-100 border-0 overflow-hidden"
    style="background-color: #2a2a3e; border-left: 3px solid #f5c518 !important; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

    {{-- Genre Image --}}
    @if(optional($genre->images)->URL ?? false)
        <img src="{{ $genre->images->URL }}"
            class="card-img-top"
            alt="{{ $genre->title ?? $genre->genre }}"
            style="height: 180px; object-fit: cover;">
    @elseif(! empty($genre->img))
        <img src="{{ $genre->img }}"
            class="card-img-top"
            alt="{{ $genre->title ?? $genre->genre }}"
            style="height: 180px; object-fit: cover;">
    @endif

    <div class="card-body d-flex flex-column gap-2">

        {{-- Genre Title & Description --}}
        <h5 class="fw-bold mb-0" style="color: #f5c518;">
            {{ $genre->title ?? $genre->genre }}
        </h5>
        <p class="small mb-0" style="color: #aaa;">
            {{ $genre->description ?? '' }}
        </p>

        <a href="{{ route('genres.show', $genre) }}"
            class="btn btn-sm align-self-start"
            style="border: 1px solid #f5c518; color: #f5c518; background: transparent;">
            See more
        </a>

        @if(isset($best_movie) && $best_movie)
            <hr style="border-color: #444;">
            <p class="small fw-bold mb-2" style="color: #888; text-transform: uppercase; letter-spacing: 1px;">
                Top Pick
            </p>
            <a href="{{ route('movies.show', $best_movie) }}" class="text-decoration-none">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $best_movie->posterURI }}"
                        alt="{{ $best_movie->title }}"
                        style="width: 50px; height: 75px; object-fit: cover; border-radius: 4px;">
                    <div>
                        <p class="fw-bold mb-0" style="color: #fff;">{{ $best_movie->title }}</p>
                        <small style="color: #888;">
                            <span style="color: #f5c518;">⭐ {{ round($best_movie->avg_rating, 1) }}</span>
                            · {{ $best_movie->year }}
                        </small>
                    </div>
                </div>
            </a>
        @endif

    </div>
</div>
