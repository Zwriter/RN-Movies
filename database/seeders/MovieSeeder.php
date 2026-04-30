<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::factory(20)->create();
        
        // Attach genres to movies
        $movies = Movie::all();
        $genres = Genre::all();
        
        foreach ($movies as $movie) {
            $randomGenres = $genres->random(rand(1, 3))->pluck('id');
            $movie->genres()->attach($randomGenres);
        }
    }
}