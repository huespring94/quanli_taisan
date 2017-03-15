<?php

use Illuminate\Database\Seeder;

class PhanQuyenSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('phan_quyen')->insert([
            [
                'ten' => 'Kế toán vật tư',
            ],
            [
                'ten' => 'Quản lí CSVC phòng',
            ],
            [
                'ten' => 'Quản lí CSVC khoa',
            ],
            [
                'ten' => 'Admin'
            ]
        ]);
    }
}
