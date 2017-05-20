<?php

use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        $data = [
            [
                'faculty_id' => 'CNTT',
                'name' => 'Công nghệ thông tin',
            ],
            [
                'faculty_id' => 'DTVT',
                'name' => 'Điện tử viễn thông',
            ],
            [
                'faculty_id' => 'CK',
                'name' => 'Cơ khí',
            ],
            [
                'faculty_id' => 'D',
                'name' => 'Điện',
            ],
        ];

        DB::table('faculties')->insert($data);
    }
}
