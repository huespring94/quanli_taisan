<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KindStuffSeeder extends Seeder {

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
            DB::table('kind_stuffs')->insert([
                'id' => $faker->unique()->word,
                'name' => $faker->sentence($nbWords = 3, $variableNbWords = true)
            ]);
        }
    }
}
