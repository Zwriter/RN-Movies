<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Person;
use App\Models\Image;


class MovieFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3, true);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(2),
            'year' => fake()->year(),
            'runtime' => fake()->numberBetween(60, 180),
            'favorites' => fake()->optional(0.5)->numberBetween(0, 50),
            'plot' => fake()->paragraph(3),
            'poster_id' => Image::factory(),
            'director_id' => Person::inRandomOrder()->first()?->id ?? Person::factory(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
