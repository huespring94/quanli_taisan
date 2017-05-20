<?php

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\User;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $faker = Faker::create('vi_VN');
        $facultyId = Faculty::all ()->pluck ('faculty_id')->first();
        $userIds = User::where ('faculty_id', '=', $facultyId)->pluck ('id');
        $data = [
            [
                'name' => 'C103',
                'room_id' => 'C103',
                'faculty_id' => $facultyId,
                'user_id' => $userIds[3]
            ],
            [
                'name' => 'C104',
                'room_id' => 'C104',
                'faculty_id' => $facultyId,
                'user_id' => $userIds[4]
            ],
            [
                'name' => 'C105',
                'room_id' => 'C105',
                'faculty_id' => $facultyId,
                'user_id' => $userIds[5]
            ],
            [
                'name' => 'C205',
                'room_id' => 'C205',
                'faculty_id' => $facultyId,
                'user_id' => $userIds[1]
            ],
            [
                'name' => 'C206',
                'room_id' => 'C206',
                'faculty_id' => $facultyId,
                'user_id' => $userIds[2]
            ],
        ];
        DB::table ('rooms')->insert ($data);
    }
}
