<?php

namespace Database\Seeders;

use App\Models\project;
use App\Models\user;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //project::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            project::create([
                'projectName' => $faker->streetName,
                'constructionType' => $faker->domainName,
                'addresse' => $faker->realText(150) ,
                'description' => $faker->realText ,
                'image_url' => $faker->imageUrl
            ]);
        }
    }
}
