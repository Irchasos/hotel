<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
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

        DB::table('notifications')->insert([
            'user_id'=>$faker->numberBetween(1,20),
            'content'=>$faker->sentence,
            'status'=>$faker->boolean(50),
            'shown'=>$faker->boolean(0),

        ]);
    }
}
}
