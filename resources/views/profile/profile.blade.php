@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row gy-4">

        {{-- User Info Card --}}
        <div class="col-lg-4">
            <div class="card border-0"
                style="background-color: #2a2a3e; border-left: 3px solid #f5c518 !important; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4"
                            style="width: 56px; height: 56px; background-color: #f5c518; color: #000; flex-shrink: 0;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0" style="color: #fff;">{{ $user->name }}</h4>
                            <small style="color: #888;">{{ $user->email }}</small>
                        </div>
                    </div>

                    <hr style="border-color: #444;">

                    <dl class="row mb-0">
                        <dt class="col-sm-5 mb-3" style="color: #888;">Name</dt>
                        <dd class="col-sm-7 mb-3" style="color: #fff;">{{ $user->name }}</dd>

                        <dt class="col-sm-5 mb-3" style="color: #888;">Email</dt>
                        <dd class="col-sm-7 mb-3" style="color: #fff;">{{ $user->email }}</dd>

                        <dt class="col-sm-5 mb-3" style="color: #888;">Role</dt>
                        <dd class="col-sm-7 mb-3">
                            <span class="badge" style="background-color: #1a1a2e; color: #f5c518; border: 1px solid #f5c518;">
                                {{ $user->role }}
                            </span>
                        </dd>

                        <dt class="col-sm-5 mb-3" style="color: #888;">Watchlist</dt>
                        <dd class="col-sm-7 mb-3" style="color: #fff;">{{ $user->watchlistMovies->count() }}</dd>

                        <dt class="col-sm-5 mb-3" style="color: #888;">Watched</dt>
                        <dd class="col-sm-7 mb-3" style="color: #fff;">{{ $user->watchedMovies->count() }}</dd>

                        <dt class="col-sm-5 mb-0" style="color: #888;">Favorites</dt>
                        <dd class="col-sm-7 mb-0" style="color: #fff;">{{ $user->favoriteMovies->count() }}</dd>
                    </dl>

                    <hr style="border-color: #444;">

                    <a href="{{ route('movies.index') }}" class="btn btn-sm"
                        style="border: 1px solid #555; color: #aaa;">
                        ← Back to Movies
                    </a>
                </div>
            </div>
        </div>

        {{-- Lists --}}
        <div class="col-lg-8 d-flex flex-column gap-4">

            <div class="p-4 rounded" style="background-color: #2a2a3e; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <h5 class="fw-bold mb-3" style="color: #f5c518;">Watchlist</h5>
                <x-profile-carousel
                    id="watchlistCarousel"
                    :movies="$user->watchlistMovies"
                    empty="No movies in your watchlist yet." />
            </div>

            <div class="p-4 rounded" style="background-color: #2a2a3e; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <h5 class="fw-bold mb-3" style="color: #f5c518;">Watched History</h5>
                <x-profile-carousel
                    id="watchedCarousel"
                    :movies="$user->watchedMovies"
                    empty="Your watched history is empty."
                        :subtitleCallback="fn($m) => 'Watched'" />
            </div>

            <div class="p-4 rounded" style="background-color: #2a2a3e; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <h5 class="fw-bold mb-3" style="color: #f5c518;">Favorites</h5>
                <x-profile-carousel
                    id="favoritesCarousel"
                    :movies="$user->favoriteMovies"
                    empty="No favorites yet." />
            </div>

        </div>
    </div>
</div>
@endsection