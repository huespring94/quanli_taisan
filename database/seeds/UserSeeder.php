<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Role;

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
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'password' => bcrypt('123456789'),
                'firstname' => $faker->lastName,
                'lastname' => $faker->firstName,
                'avatar' => 'user.jpg',
                'email' => $faker->unique()->userName.'@gmail.com',
                'role_id' => $faker->randomElement($roleIds->toArray()),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
