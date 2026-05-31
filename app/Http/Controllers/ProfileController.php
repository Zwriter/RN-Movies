<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load([
            'watchlistMovies',
            'watchedMovies',
            'favoriteMovies',
        ]);

        return view('profile.profile', ['user' => $user]);
    }
}
