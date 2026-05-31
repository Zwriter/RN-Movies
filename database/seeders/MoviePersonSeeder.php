<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Person;
use App\Models\MoviePerson;

class MoviePersonSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $people = Person::all();

        foreach ($movies as $movie) {
            MoviePerson::factory(rand(2, 6))->create([
                'movie_id' => $movie->id,
                'person_id' => $people->random()->id,
            ]);
        }
    }
}