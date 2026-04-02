<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Movie;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $users = User::all();

        foreach ($movies as $movie) {
            Review::factory(rand(3, 8))->create([
                'movieID' => $movie->id,
                'user' => $users->random()->id,
            ]);
        }
    }
}