<?php

use Illuminate\Database\Seeder;

class VisitedPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $faker = Faker\Factory::create();

         for($i=0; $i<100; $i++)
         {
             DB::table('visited_pages')->insert([
                 'user_id' => $faker->numberBetween($min = 1, $max = 10),
                 'page_id' => $faker->numberBetween($min = 1, $max = 5),
             ]);
         }
     }
}
