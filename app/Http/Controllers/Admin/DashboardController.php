<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $totalMovies = Movie::count();
        $totalGenres = Genre::count();
        $totalReviews = Review::count();

        $usersByRole = [
            'Admins' => $totalAdmins,
            'Regular Users' => max(0, $totalUsers - $totalAdmins),
        ];

        $popularGenres = Genre::withCount('movies')
            ->orderByDesc('movies_count')
            ->take(6)
            ->get();

        $reviewsByRating = Review::selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $ratingLabels = range(1, 5);
        $ratingCounts = array_map(fn ($rating) => $reviewsByRating[$rating] ?? 0, $ratingLabels);

        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('M Y'));
        }

        $usersByMonthRaw = User::where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->get()
            ->groupBy(fn (User $user) => $user->created_at->format('M Y'))
            ->map->count();

        $usersByMonth = $months->map(fn ($month) => $usersByMonthRaw[$month] ?? 0)->toArray();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalMovies' => $totalMovies,
            'totalGenres' => $totalGenres,
            'totalReviews' => $totalReviews,
            'usersByRole' => $usersByRole,
            'genreLabels' => $popularGenres->pluck('title')->toArray(),
            'genreCounts' => $popularGenres->pluck('movies_count')->toArray(),
            'ratingLabels' => $ratingLabels,
            'ratingCounts' => $ratingCounts,
            'months' => $months->toArray(),
            'usersByMonth' => $usersByMonth,
        ]);
    }
}
