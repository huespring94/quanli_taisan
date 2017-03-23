<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
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
            DB::table('suppliers')->insert([
                'id' => $faker->unique()->word,
                'name' => $faker->company,
                'address' => $faker->address,
            ]);
        }
    }
}
