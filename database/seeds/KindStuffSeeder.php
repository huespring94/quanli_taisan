<?php
use Illuminate\Database\Seeder;

class KindStuffSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        DB::table ('kind_stuffs')->insert ([
            'kind_stuff_id' => 'TB',
            'name' => 'Thiết bị'
        ]);
    }
}
