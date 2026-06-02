<div class="mb-4">
    <nav class="nav nav-pills flex-row gap-2 flex-wrap">
        <a class="btn btn-sm {{ request()->routeIs('admin.dashboard') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.dashboard') }}">Overview</a>
        <a class="btn btn-sm {{ request()->routeIs('admin.movies.*') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.movies.index') }}">Movies</a>
        <a class="btn btn-sm {{ request()->routeIs('admin.genres.*') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.genres.index') }}">Genres</a>
        <a class="btn btn-sm {{ request()->routeIs('admin.users.*') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.users.index') }}">Users</a>
        <a class="btn btn-sm {{ request()->routeIs('admin.reviews.*') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.reviews.index') }}">Reviews</a>
        <a class="btn btn-sm {{ request()->routeIs('admin.logs') ? 'btn-warning' : 'btn-outline-secondary' }}" href="{{ route('admin.logs') }}">Logs</a>
    </nav>
</div>
