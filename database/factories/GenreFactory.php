<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Image;

class GenreFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6, true);

        return [
            'genre' => fake()->word(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'posterURL' => Image::factory(),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
