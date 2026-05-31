<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $user = $request->user();

        $existingReview = Review::where('movie_id', $movie->id)
            ->where('user', $user->id)
            ->first();

        if ($existingReview) {
            return back()->with('status', 'You have already posted a review and cannot modify it.');
        }

        Review::create([
            'movie_id' => $movie->id,
            'user' => $user->id,
            'rating' => $data['rating'],
            'review' => $data['review'],
        ]);

        return back()->with('status', 'Your review has been posted.');
    }

    public function destroy(Movie $movie, Review $review)
    {
        if ($review->movie_id !== $movie->id || $review->user !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('status', 'Your review has been removed.');
    }
}
