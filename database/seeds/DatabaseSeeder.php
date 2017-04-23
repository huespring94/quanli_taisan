<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AtrophySeeder::class);
        $this->call(KindStuffSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(StuffSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(RoomSeeder::class);
    }
}
