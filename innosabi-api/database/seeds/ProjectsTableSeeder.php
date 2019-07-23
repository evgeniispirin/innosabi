<?php

use App\Project;
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
        $faker = \Faker\Factory::create();
        Project::truncate();
        for ($i = 0; $i < 10; $i++) {
            Project::create([
                'name' => $faker->company,
                'description' => $faker->paragraph
            ]);
        }
    }
}
