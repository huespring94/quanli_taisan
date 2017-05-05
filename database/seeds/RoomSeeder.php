<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Faculty;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $facultyIds = Faculty::all()->pluck('faculty_id');
        foreach($facultyIds as $facultyId) {
            for ($i = 0; $i < 5; $i++)
            {
                DB::table('rooms')->insert([
                    'name' => $faker->sentence($nbWords = 1),
                    'room_id' => $faker->unique()->text($maxNbChars = 5),
                    'faculty_id' => $facultyId
                ]);
            }
        }
    }
}
