<?php

use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::truncate();
        Movie::create([
            'title' => 'Movie '.str_random(10),
            'genre_id' => random_int(0, 4),
            'url_trailer' => 'http://www.'.str_random(20).'.com',
            'length' => 90,
            'plot' => 'Set in the 1970 bla bla bla bla bla bla',
            'year' => 2016,
            'country' => 'Italy',
            'director' => 'Martin Scortese',
            'uri_poster' => '/posters/01.jpg'
        ]);
    }
}
