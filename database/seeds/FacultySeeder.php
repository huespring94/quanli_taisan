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
        DB::table('faculties')->insert([
                'faculty_id' => 'CNTT',
                'name' => 'Công nghệ thông tin'
        ]);
        for ($i = 0; $i < 10; $i++)
        {
            DB::table('faculties')->insert([
                'faculty_id' => $faker->unique()->text($maxNbChars = 10),
                'name' => $faker->sentence($nbWords = 2)
            ]);
        }
    }
}
