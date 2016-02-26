<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i<10; $i++)
        {
            $username = $faker->userName;
            // hash username
            $hashUsername = md5($username);
            // hex hashed username
            $hexSeq = str_split(unpack('H*', $hashUsername)[1], 2);
            // get the knock sequence
            $sequence = '';
            for($j=0; $j<4; $j++)
            {
              $sequence[$j] = $hexSeq[$j]%4;
            }
            // add to database
            DB::table('users')->insert([
                'username' => $username,
                'password' => bcrypt('secret'),
                'sequence' => serialize($sequence)
            ]);
        }
    }
}
