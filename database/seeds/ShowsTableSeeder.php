<?php

use App\Show;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++)
        {
            Show::create([
                'id_movie' => $i + 1,
                'id_room' => $i + 1,
                'date_time' => Carbon::createFromDate(random_int(2016, 2030), random_int(1, 12), random_int(1, 31))
            ]);
        }
    }
}
