<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function toggleWatchlist(Request $request, Movie $movie)
    {
        $user = $request->user();
        $status = $user->movieStatus($movie);

        if ($status && $status->pivot->watchlist) {
            $user->movies()->updateExistingPivot($movie->id, ['watchlist' => false]);

            return back()->with('status', 'Removed from your watchlist.');
        }

        $user->movies()->syncWithoutDetaching([
            $movie->id => [
                'watchlist' => true,
            ],
        ]);

        return back()->with('status', 'Added to your watchlist.');
    }

    public function toggleFavorite(Request $request, Movie $movie)
    {
        $user = $request->user();
        $status = $user->movieStatus($movie);

        if ($status && $status->pivot->favorite) {
            $user->movies()->updateExistingPivot($movie->id, ['favorite' => false]);

            return back()->with('status', 'Removed from favorites.');
        }

        $user->movies()->syncWithoutDetaching([
            $movie->id => [
                'favorite' => true,
            ],
        ]);

        return back()->with('status', 'Added to favorites.');
    }

    public function markWatched(Request $request, Movie $movie)
    {
        $user = $request->user();
        $status = $user->movieStatus($movie);

        if ($status && $status->pivot->watched) {
            $user->movies()->updateExistingPivot($movie->id, ['watched' => false]);

            return back()->with('status', 'Removed from watched history.');
        }

        $user->movies()->syncWithoutDetaching([
            $movie->id => [
                'watched' => true,
                'watchlist' => false,
            ],
        ]);

        return back()->with('status', 'Marked as watched.');
    }
}
