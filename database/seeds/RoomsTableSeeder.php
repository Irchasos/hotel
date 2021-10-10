<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create('pl_PL');
       for($i=1;$i<=199;$i++)
        {

        DB::table('rooms')->insert([
            'room_number'=>$faker->unique()->numberBetween(1,200),
            'room_size'=>$faker->numberBetween(1,5),
            'price'=>$faker->numberBetween(100,600),
            'description'=>$faker->text(1000),
            'tourist_object_id'=>$faker->numberBetween(1,20),


        ]);
    }
}
}
