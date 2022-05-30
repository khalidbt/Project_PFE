<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\project;
use Illuminate\Database\Seeder;

class MeetingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Meeting::create([

                'object' => $faker->domainName,
                'date' => $faker->numberBetween(10000000,1000000000)
            ]);
        }
    }
}
