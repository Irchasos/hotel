<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
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

        DB::table('addresses')->insert([
            'number'=>$faker->numberBetween(100,999),
            'street'=>$faker->streetName,
            'tourist_object_id'=>$faker->unique()->numberBetween(1,20),

        ]);
    }
}
}
