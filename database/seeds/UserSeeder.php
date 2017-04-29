<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Role;
use App\Models\Faculty;

class UserSeeder extends Seeder
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
        DB::table('users')->insert([
            [
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => 'admin@gmail.com',
                'role_id' => Role::where('name', '=', Role::ROLE_ADMIN)->first()->id,
                'faculty_id' => $faker->randomElement($facultyIds->toArray()),
                'remember_token' => str_random(10)
            ],
            [
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => 'ketoan@gmail.com',
                'role_id' => Role::where('name', '=', Role::ROLE_ACCOUNTANT)->first()->id,
                'faculty_id' => $faker->randomElement($facultyIds->toArray()),
                'remember_token' => str_random(10)
            ],
            [
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => 'quanlikhoa@gmail.com',
                'role_id' => Role::where('name', '=', Role::ROLE_FACULTY)->first()->id,
                'faculty_id' => Faculty::first()->faculty_id,
                'remember_token' => str_random(10)
            ],
            [
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => 'quanliphong@gmail.com',
                'role_id' => Role::where('name', '=', Role::ROLE_ROOM)->first()->id,
                'faculty_id' => Faculty::first()->faculty_id,
                'remember_token' => str_random(10)
            ]
        ]);
        $roleIds = Role::all()->pluck('id');
        for ($i = 0; $i < 6; $i++) {
            DB::table('users')->insert([
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => $faker->unique()->userName . '@gmail.com',
                'role_id' => $faker->randomElement($roleIds->toArray()),
                'faculty_id' => $faker->randomElement($facultyIds->toArray()),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
