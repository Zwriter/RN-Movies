<div>
    {{-- Hero Carousel --}}
    <div id="topRatedCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($movies as $index => $movie)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <a href="{{ route('movies.show', $movie) }}" class="d-block" style="text-decoration: none;">
                        <div style="
                            background-image: url('{{ $movie->posterURI }}');
                            background-size: cover;
                            background-position: center;
                            height: 500px;
                            position: relative;
                        ">
                            <div style="
                                position: absolute;
                                bottom: 0; left: 0; right: 0;
                                background: linear-gradient(transparent, rgba(0,0,0,0.85));
                                padding: 2rem;
                                color: white;
                            ">
                                <h2 class="fw-bold mb-1">{{ $movie->title }}</h2>
                                <p class="mb-0">
                                    <span class="fw-bold" style="color: #f5c518;">⭐ {{ round($movie->avg_rating, 1) }} / 5</span>
                                    <span class="text-white-50 ms-2">· {{ $movie->year }}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#topRatedCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#topRatedCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Popular Genres --}}
    <div class="container py-5">
        <h3 class="fw-bold mb-4" style="color: #f5c518; letter-spacing: 1px;">Popular Genres</h3>

        <div class="row g-4">
            @foreach($genres as $entry)
                <div class="col-md-4">
                    @include('genres.genre-card', ['genre' => $entry->genre, 'best_movie' => $entry->best_movie])
                </div>
            @endforeach
        </div>
    </div>
</div>