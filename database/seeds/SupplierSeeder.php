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
    public function run ()
    {
        $faker = Faker::create ('vi_VN');
        $data = [
            [
                'supplier_id' => 'VN',
                'name' => 'Việt Nam',
                'address' => $faker->address,
            ],
            [
                'supplier_id' => 'HL',
                'name' => 'Hà Lan',
                'address' => $faker->address,
            ],
            [
                'supplier_id' => 'HQ',
                'name' => 'Hàn Quốc',
                'address' => $faker->address,
            ],
        ];
        DB::table ('suppliers')->insert ($data);
    }
}
