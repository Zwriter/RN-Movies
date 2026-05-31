<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

class PersonFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sex' => fake()->randomElement(['male', 'female']),
            'imageURL' => Image::factory(),
            'birthDay' => fake()->date(),
            'created_at' => fake()->dateTimeBetween('-5 months', 'now'),
        ];
    }
}
