<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear table
        Genre::truncate();
        Genre::create(['description' => 'Action']);
        Genre::create(['description' => 'Drama']);
        Genre::create(['description' => 'Animation']);
        Genre::create(['description' => 'Sci-Fi']);
    }
}
