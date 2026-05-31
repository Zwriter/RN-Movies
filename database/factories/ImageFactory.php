<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{

    public function definition(): array
    {
        return [
            'URL' => 'https://picsum.photos/800/400?random=' . fake()->numberBetween(1, 1000),
            'title' => fake()->sentence(3, true),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
