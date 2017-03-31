<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 5; $i++)
        {
            DB::table('stores')->insert([
                'name' => $faker->company,
            ]);
        }
    }
}
