<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\KindStuff;
use App\Models\Atrophy;
use App\Models\Supplier;

class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        $atrophyIds = Atrophy::all()->pluck('id');
        $kindStuffIds = KindStuff::all()->pluck('kind_stuff_id');
        $supplierIds = Supplier::all()->pluck('supplier_id');
        for ($i = 0; $i < 10; $i++)
        {
            $k = $faker->randomElement($kindStuffIds->toArray());
            $s = $faker->randomElement($supplierIds->toArray());
            DB::table('stuffs')->insert([
                'name' => $faker->sentence($nbWords = 5),
                'atrophy_id' => $faker->randomElement($atrophyIds->toArray()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s, 
                'stuff_id' => $s.$k.$i,
            ]);
        }
    }
}
