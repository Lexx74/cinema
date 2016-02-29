<?php

use App\Seat;
use Illuminate\Database\Seeder;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for each 4 rooms
        for($i = 0; $i < 10; $i++)
        {
            // columns
            for($j = 0; $j < 10; $j++)
            {
                // rows
                for ($k = 0; $k < 10; $k++)
                {
                    Seat::create([
                        'room_id' => $i + 1,
                        'row' => $j + 1,
                        'column' => $k + 1,
                        'exist' => true
                    ]);
                }
            }
        }
    }
}
