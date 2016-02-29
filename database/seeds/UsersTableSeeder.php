<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'credit' => 100.0,
            'role_id' => 1,
        ]);

        // add users
        for ($i = 0; $i < 4; $i++)
        {
            User::create([
                'name' => 'user_'.str_random(5),
                'email' => str_random(8).'@gmail.com',
                'password' => bcrypt('secret'),
                'credit' => (float) random_int(0, 100),
                'role_id' => 2,
            ]);
        }
    }
}
