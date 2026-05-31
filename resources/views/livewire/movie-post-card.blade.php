<div>
    <div class="card h-100 border-0 overflow-hidden"
        style="background-color: #2a2a3e; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

        {{-- Poster --}}
        <div class="position-relative">
            <img src="{{ $movie->posterURI }}"
                class="card-img-top"
                alt="{{ $movie->title }}"
                style="height: 320px; object-fit: cover;">

            {{-- Rating badge overlay --}}
            <div class="position-absolute top-0 end-0 m-2 px-2 py-1 rounded fw-bold small"
                style="background-color: #f5c518; color: #000;">
                ⭐ {{ round($movie->avg_rating, 1) }} / 5
            </div>
        </div>

        <div class="card-body d-flex flex-column gap-2">

            {{-- Title --}}
            <h5 class="card-title fw-bold mb-0" style="color: #fff;">
                {{ $movie->title }}
            </h5>

            {{-- Meta --}}
            <p class="mb-0 small" style="color: #888;">
                {{ $movie->year }} · {{ $movie->runtime }} min
            </p>

            {{-- Plot --}}
            <p class="small mb-0" style="color: #aaa; line-height: 1.5;">
                @if($showFullContent)
                    {{ $movie->plot }}
                @else
                    {{ $movie->excerpt }}
                @endif
            </p>

            {{-- Genres --}}
            @if($movie->genres->count() > 0)
                <div class="d-flex flex-wrap gap-1">
                    @foreach($movie->genres as $genre)
                        <span class="badge"
                            style="background-color: #1a1a2e; color: #f5c518; border: 1px solid #f5c518; font-weight: 400;">
                            {{ $genre->genre }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Actions --}}
            <div class="d-flex gap-2 mt-auto pt-2">
                <button wire:click="toggleContent"
                    class="btn btn-sm"
                    style="background-color: transparent; border: 1px solid #555; color: #aaa;">
                    {{ $showFullContent ? 'Show Less' : 'Read More' }}
                </button>
                <a href="{{ route('movies.show', $movie) }}"
                    class="btn btn-sm fw-bold"
                    style="background-color: #f5c518; color: #000; border: none;">
                    View
                </a>
            </div>

        </div>
    </div>
</div>