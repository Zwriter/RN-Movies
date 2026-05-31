@if($movies->count())
    <div id="{{ $id }}" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
            @foreach($movies->chunk(3) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($chunk as $movie)
                            <x-profile-movie-card
                                :movie="$movie"
                                :subtitle="$subtitleCallback ? $subtitleCallback($movie) : $movie->year" />
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @if($movies->count() > 3)
            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-sm" data-bs-target="#{{ $id }}" data-bs-slide="prev"
                    style="border: 1px solid #555; color: #aaa;">‹ Prev</button>
                <button class="btn btn-sm" data-bs-target="#{{ $id }}" data-bs-slide="next"
                    style="border: 1px solid #555; color: #aaa;">Next ›</button>
            </div>
        @endif
    </div>
@else
    <p style="color: #666;">{{ $empty }}</p>
@endif