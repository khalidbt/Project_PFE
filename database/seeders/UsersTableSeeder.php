<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Seeder;
use phpseclib3\Crypt\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            user::create([
                'email' => $faker->email,
                'password' => \Illuminate\Support\Facades\Hash::make($faker->password(10 , 15)),
                'preName' => $faker->firstName ,
                'lastName' => $faker->lastName ,
            ]);
        }
    }
}
