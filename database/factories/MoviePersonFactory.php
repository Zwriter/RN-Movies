<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;
use App\Models\Person;

class MoviePersonFactory extends Factory
{
    public function definition(): array
    {
        $ocupation = fake()->randomElement(['actor', 'director', 'producer']);

        return [
            'movie_id' => Movie::factory(),
            'person_id' => Person::factory(),
            'ocupation' => $ocupation,
            'characterName' => $ocupation === 'actor' ? fake()->optional()->name() : null,
            'role' => $ocupation === 'actor' ? fake()->optional()->randomElement(['lead', 'supporting', 'cameo']) : null,
            'sex' => fake()->optional()->randomElement(['male', 'female', null]),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}