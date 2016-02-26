<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $faker = Faker\Factory::create();

         $appPages = [
            '/user/register',
            '/user/login',
            '/message/add',
            '/message/list',
            '/user/logout',
         ];

         for($i=0; $i<5; $i++)
         {
           DB::table('pages')->insert([
               'page_number' => $i,
               'page_name' => $appPages[$i]
           ]);
         }
     }
}
