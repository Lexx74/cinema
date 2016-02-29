<?php

use App\Reservation;
use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'user_id' => 1,
            'show_id' => 1,
            'seat_id' => 50,
            'price' => 7.50
        ]);
    }
}
