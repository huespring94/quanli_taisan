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
    public function run ()
    {
        $faker = Faker::create ('vi_VN');
        $atrophyIds = Atrophy::all ()->pluck ('id');

        $k = KindStuff::all ()->pluck ('kind_stuff_id')->first();
        $s = Supplier::all ()->pluck ('supplier_id')->first();
        $data = [
            [
                'name' => 'Máy tính bàn',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 1,
            ],
            [
                'name' => 'Máy tính xách tay',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 2,
            ],
            [
                'name' => 'Máy in laser',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 3,
            ],
            [
                'name' => 'Máy điều hòa',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 4,
            ],
            [
                'name' => 'Máy chiếu',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 5,
            ],
            [
                'name' => 'Router',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 6,
            ],
            [
                'name' => 'Máy hút bụi',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 7,
            ],
            [
                'name' => 'Máy ảnh',
                'atrophy_id' => $faker->randomElement ($atrophyIds->toArray ()),
                'kind_stuff_id' => $k,
                'supplier_id' => $s,
                'stuff_id' => $s . '-' . $k . '-' . 8,
            ],
        ];
        DB::table ('stuffs')->insert ($data);
    }
}
