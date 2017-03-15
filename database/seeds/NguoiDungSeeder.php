<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PhanQuyen;

class NguoiDungSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create('vi_VN');
        $phanQuyenIds = PhanQuyen::all()->pluck('ma');
        for ($i = 0; $i < 10; $i++) {
            DB::table('nguoi_dung')->insert([
                'mat_khau' => bcrypt('123456'),
                'ten' => $faker->lastName,
                'ho' => $faker->firstName,
                'hinh_anh' => 'nguoidung.jpg',
                'email' => $faker->unique()->userName.'@gmail.com',
                'ma_phan_quyen' => $faker->randomElement($phanQuyenIds->toArray()),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
