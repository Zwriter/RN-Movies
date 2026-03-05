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

    <div class="container mt-5">
        <h1>Hello, Bootstrap!</h1>
        <p class="lead">Your Laravel app is up and running.</p>
        <a href="#" class="btn btn-primary">Get Started</a>
    </div>

    <div class="container mt-5">
        <livewire:counter />
    </div>

    @livewireScripts
</body>
</html>