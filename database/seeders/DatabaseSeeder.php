<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            ImageSeeder::class,
            PersonSeeder::class,
            MovieSeeder::class,
            ReviewSeeder::class,
            MoviePersonSeeder::class,
        ]);
    }
}
