<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <h1>Movies</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            @foreach(\App\Models\Movie::all() as $movie)
                <div class="col-md-3 mb-4">
                    <livewire:movie-post-card :movie="$movie" :key="$movie->id" />
                </div>
            @endforeach
        </div>
    </div>

    @livewireScripts
</body>
</html>