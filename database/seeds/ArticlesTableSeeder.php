<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create('pl_PL');
       for($i=1;$i<=100;$i++)
        {

        DB::table('articles')->insert([
            'title'=>$faker->text(20),
            'content'=>$faker->text(1000),
            'created_at'=>$faker->dateTime,
            'user_id'=>$faker->numberBetween(1,19),
            'tourist_object_id'=>$faker->numberBetween(1,19),

        ]);
    }
}
}
