<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => str_random(10),
            'email' => 'test@gmail.com',
            'password' => bcrypt('secret'),
            'gender' => 'm',
            'firstname' => str_random(7),
            'lastname' => str_random(7),
            'country' => 'fr',
            'birthdate' => Carbon::createFromDate(1993,1,5)
        ]);

        DB::table('clusters')->insert([
            'level' => 1,
            'status' => true,
            'open' => true,
            'type' => 1
        ]);
    }
}
