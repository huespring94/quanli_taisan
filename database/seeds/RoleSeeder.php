<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

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
                'name' => Role::ROLE_ADMIN,
            ],
            [
                'name' => Role::ROLE_ACCOUNTANT,
            ],
            [
                'name' => Role::ROLE_FACULTY,
            ],
            [
                'name' => Role::ROLE_ROOM
            ]
        ]);
    }
}
