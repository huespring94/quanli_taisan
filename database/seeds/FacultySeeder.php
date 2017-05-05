<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 10; $i++)
        {
            DB::table('faculties')->insert([
                'faculty_id' => $faker->unique()->text($maxNbChars = 5),
                'name' => $faker->sentence($nbWords = 2)
            ]);
        }
    }
}
