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
        $roleIds = Role::all()->pluck('id');
        $facultyIds = Faculty::all()->pluck('faculty_id');
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => $faker->unique()->userName.'@gmail.com',
                'role_id' => $faker->randomElement($roleIds->toArray()),
                'faculty_id' => $faker->randomElement($facultyIds->toArray()),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
