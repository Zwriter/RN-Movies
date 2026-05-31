<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RNM') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1a1a2e; border-bottom: 2px solid #f5c518; z-index: 2000;">
        <div class="container-fluid px-4">

            {{-- Brand --}}
            <a class="navbar-brand fw-bold fs-4" href="/" style="color: #f5c518; letter-spacing: 1px;">
                {{ config('app.name', 'RNM') }}
            </a>

            {{-- Search --}}
            <div class="mx-auto position-relative" style="width: 100%; max-width: 480px;">
                <input id="movie-search-input"
                    class="form-control form-control-sm"
                    type="search"
                    placeholder="Search movies..."
                    aria-label="Search movies"
                    autocomplete="off"
                    style="background-color: #2a2a3e; border: 1px solid #444; color: #fff;">
                <div id="movie-search-results"
                    class="list-group position-absolute w-100 mt-1 d-none"
                    style="z-index: 1050; background-color: #2a2a3e;">
                </div>
            </div>

            {{-- Links --}}
            <div class="d-flex align-items-center gap-3 ms-4">
                <a class="nav-link text-white-50 hover-white" href="{{ route('movies.index') }}">Movies</a>
                <a class="nav-link text-white-50 hover-white" href="{{ route('genres.index') }}">Genres</a>

                @guest
                    <a class="nav-link text-white-50" href="{{ route('login') }}">Login</a>
                @else

                    @if(auth()->user()->isAdmin())
                        <a class="nav-link text-white-50" href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    
                    <a class="nav-link text-white-50" href="{{ route('profile') }}">Profile</a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm" style="border: 1px solid #f5c518; color: #f5c518;">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>

        </div>
    </nav>

    <main>
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>

    @include('layouts.footer')

    @livewireScripts
</body>
</html>