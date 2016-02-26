<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $faker = Faker\Factory::create();

         for($i=0; $i<20; $i++)
         {
           DB::table('messages')->insert([
               'title' => $faker->text(10),
               'content' => $faker->text(100),
               'type' => $faker->randomElement($array = array ('secret_mode','simple_mode'))
           ]);
         }
     }
}
