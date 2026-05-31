@extends('layouts.app')

@section('content')
<div class="container py-5">
    @include('admin.partials.secondary-nav')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Users</h6>
                    <h2 class="mt-2">{{ $totalUsers }}</h2>
                    <p class="mb-0 text-muted">Total registered users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Admins</h6>
                    <h2 class="mt-2">{{ $totalAdmins }}</h2>
                    <p class="mb-0 text-muted">Users with admin access</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Movies</h6>
                    <h2 class="mt-2">{{ $totalMovies }}</h2>
                    <p class="mb-0 text-muted">Movies in the catalog</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted">Reviews</h6>
                    <h2 class="mt-2">{{ $totalReviews }}</h2>
                    <p class="mb-0 text-muted">Total reviews submitted</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title mb-3">User Signups (Last 6 months)</h5>
                    <canvas id="userGrowthChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title mb-3">Movies by Genre</h5>
                    <canvas id="moviesGenreChart" height="220"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const userGrowthCtx = document.getElementById('userGrowthChart');
    new Chart(userGrowthCtx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'New Users',
                data: @json($usersByMonth),
                borderColor: '#f5c518',
                backgroundColor: 'rgba(245, 197, 24, 0.2)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: '#f5c518',
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.06)' } },
                y: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.06)' }, beginAtZero: true }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    const moviesGenreCtx = document.getElementById('moviesGenreChart');
    new Chart(moviesGenreCtx, {
        type: 'bar',
        data: {
            labels: @json($genreLabels),
            datasets: [{
                label: 'Movies per genre',
                data: @json($genreCounts),
                backgroundColor: '#4b6cb7',
                borderColor: '#1a1a2e',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: '#fff' }, grid: { display: false } },
                y: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.06)' }, beginAtZero: true }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
