<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeablesTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker\Factory::create('pl_PL');
       for($i=1;$i<=20;$i++)
        {

        DB::table('likeables')->insert([
            'likeable_type'=>$faker->randomElement(['App\Touristobject','App\Article']),
            'likeable_id'=>$faker->numberBetween(1,10),
            'user_id'=>$faker->numberBetween(1,10),


        ]);
    }
}
}
