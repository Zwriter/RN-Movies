<div>
    <!-- <div class="container mt-5 text-center mb-4">
        <h1>Top Rated Movies</h1>
    </div> -->

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
                                background: linear-gradient(transparent, rgba(0,0,0,0.8));
                                padding: 2rem;
                                color: white;
                            ">
                                <h2 class="mb-1">{{ $movie->title }}</h2>
                                <p class="mb-0">⭐ {{ round($movie->rating, 1) }} / 5 · {{ $movie->year }}</p>
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

    <div>
        <div class="m-3">
            <h3>
                Popular Genres
            </h3>
        </div>
        <div>
            <!-- top 3 genres -->
            <div>
                <!-- genre -->
                <!-- see more (button) -->
            </div>
            <div>
                <!-- best movie in genre -->
            </div>
        </div>
    </div>
</div>