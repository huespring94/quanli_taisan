<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AtrophySeeder extends Seeder
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
            DB::table('atrophies')->insert([
                'name' => $faker->sentence($nbWords = 3),
                'description' => $faker->paragraph($nbSentences = 3),
                'atrophy_rate' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
