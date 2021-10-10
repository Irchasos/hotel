<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create('pl_PL');
       for($i=1;$i<=20;$i++)
        {

        DB::table('reservations')->insert([
            'user_id'=>$faker->numberBetween(1,20),
            'city_id'=>$faker->numberBetween(1,20),
            'room_id'=>$faker->numberBetween(1,20),
            'status'=>$faker->boolean(50),
            'day_in'=>$faker->dateTimeBetween('-10 days','now'),
            'day_out'=>$faker->dateTimeBetween('now','+10 days'),

        ]);
    }
}
}
