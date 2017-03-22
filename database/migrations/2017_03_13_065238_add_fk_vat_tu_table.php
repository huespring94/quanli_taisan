<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stuffs', function (Blueprint $table) {
            $table->foreign('kind_stuff_id')
                ->references('id')->on('kind_stuffs')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('atrophy_id')
                ->references('id')->on('atrophies')
                ->onUpdate('cascade')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stuffs', function (Blueprint $table) {
            $table->dropForeign(['kind_stuff_id']);
            $table->dropForeign(['atrophy_id']);
        });
    }
}
