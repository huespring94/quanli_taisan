<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Kế toán vật tư',
            ],
            [
                'name' => 'Quản lí CSVC phòng',
            ],
            [
                'name' => 'Quản lí CSVC khoa',
            ],
            [
                'name' => 'Admin'
            ]
        ]);
    }
}
