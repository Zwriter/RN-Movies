<div>
    <div class="container py-5">

        {{-- Movie Header --}}
        <div class="row g-4">

            {{-- Poster --}}
            <div class="col-md-4">
                <img src="{{ $movie->posterURI }}"
                    class="img-fluid rounded"
                    alt="{{ $movie->title }}"
                    style="width: 100%; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
            </div>

            {{-- Details --}}
            <div class="col-md-8">
                <h1 class="fw-bold mb-1" style="color: #fff;">{{ $movie->title }}</h1>
                <p class="mb-3" style="color: #888;">{{ $movie->year }} · {{ $movie->runtime }} min</p>

                {{-- Rating --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="px-3 py-1 rounded fw-bold" style="background-color: #f5c518; color: #000;">
                        ⭐ {{ round($movie->avg_rating, 1) }} / 5
                    </span>
                    <span style="color: #888;">{{ $movie->reviews->count() }} review{{ $movie->reviews->count() === 1 ? '' : 's' }}</span>
                </div>

                @auth
                    <livewire:movie-actions :movie="$movie" />
                @endauth

                {{-- Excerpt --}}
                <p style="color: #aaa;">{{ $movie->excerpt }}</p>

                {{-- Synopsis --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-2" style="color: #f5c518;">Synopsis</h5>
                    <p style="color: #ccc; line-height: 1.7;">{{ $movie->plot }}</p>
                </div>

                {{-- Genres --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-2" style="color: #888; text-transform: uppercase; letter-spacing: 1px;">Genres</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($movie->genres as $genre)
                            <a href="{{ route('genres.show', $genre) }}" class="badge text-decoration-none"
                                style="background-color: #1a1a2e; color: #f5c518; border: 1px solid #f5c518; font-weight: 400;">
                                {{ $genre->title ?? $genre->genre }}
                            </a>
                        @empty
                            <span style="color: #666;">No genres available</span>
                        @endforelse
                    </div>
                </div>

                <a href="/movies" class="btn btn-sm" style="border: 1px solid #555; color: #aaa;">
                    ← Back to Movies
                </a>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="p-4 rounded"
                    style="background-color: #2a2a3e; border-left: 3px solid #f5c518; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

                    {{-- Reviews Header --}}
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold mb-1" style="color: #fff;">Reviews</h3>
                            <p class="mb-0" style="color: #888;">Share your thoughts and help others discover this movie.</p>
                        </div>
                        <span class="px-3 py-1 rounded fw-bold" style="background-color: #f5c518; color: #000;">
                            {{ number_format($movie->avg_rating, 1) }} / 5
                        </span>
                    </div>

                    {{-- Guest prompt --}}
                    @guest
                        <div class="p-3 rounded mb-4" style="background-color: #1a1a2e; border: 1px solid #444;">
                            <p class="mb-0" style="color: #aaa;">
                                <a href="{{ route('login') }}" style="color: #f5c518; text-decoration: none;">Login</a>
                                or
                                <a href="{{ route('register') }}" style="color: #f5c518; text-decoration: none;">Register</a>
                                to leave a review.
                            </p>
                        </div>
                    @endguest

                    {{-- Auth user review --}}
                    @auth
                        @php
                            $userReview = auth()->user()->reviews()->where('movie_id', $movie->id)->first();
                        @endphp

                        @if($userReview)
                            <div class="p-3 rounded mb-4" style="background-color: #1a1a2e; border: 1px solid #444;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-0" style="color: #fff;">Your Review</h6>
                                        <small style="color: #666;">Posted on {{ $userReview->created_at->format('M j, Y') }}</small>
                                    </div>
                                    <span class="px-2 py-1 rounded small fw-bold" style="background-color: #f5c518; color: #000;">
                                        {{ $userReview->rating }} / 5
                                    </span>
                                </div>
                                <p class="mb-3" style="color: #ccc;">{{ $userReview->review }}</p>
                                <form method="POST" action="{{ route('reviews.destroy', ['movie' => $movie, 'review' => $userReview]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm"
                                        style="border: 1px solid #c0392b; color: #c0392b;"
                                        onclick="return confirm('Remove your review?')">
                                        Delete Review
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Review form --}}
                            <form method="POST" action="{{ route('reviews.store', $movie) }}" class="mb-5">
                                @csrf
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label small" style="color: #aaa;">Your Rating</label>
                                        <select name="rating"
                                            class="form-select @error('rating') is-invalid @enderror"
                                            style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                                            <option value="">Choose a rating</option>
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                                    {{ $i }} star{{ $i === 1 ? '' : 's' }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label small" style="color: #aaa;">Your Review</label>
                                        <textarea name="review"
                                            rows="4"
                                            class="form-control @error('review') is-invalid @enderror"
                                            style="background-color: #1a1a2e; border: 1px solid #444; color: #fff; resize: none;">{{ old('review') }}</textarea>
                                        @error('review')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn fw-bold"
                                        style="background-color: #f5c518; color: #000; border: none;">
                                        Post Review
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endauth

                    {{-- All reviews --}}
                    <div class="mt-4">
                        @forelse($movie->reviews->sortByDesc('created_at') as $review)
                            <div class="pb-3 mb-3" style="border-bottom: 1px solid #444;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold small"
                                            style="width: 36px; height: 36px; background-color: #f5c518; color: #000; flex-shrink: 0;">
                                            {{ strtoupper(substr(optional($review->user)->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-0" style="color: #fff;">{{ optional($review->user)->name ?? 'Anonymous' }}</p>
                                            <small style="color: #666;">{{ $review->created_at->format('M j, Y') }}</small>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 rounded small fw-bold" style="background-color: #f5c518; color: #000;">
                                        {{ $review->rating }} / 5
                                    </span>
                                </div>
                                <p class="mb-0 mt-2" style="color: #ccc;">{{ $review->review }}</p>
                            </div>
                        @empty
                            <p style="color: #666;">No reviews yet. Be the first to share your opinion.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>