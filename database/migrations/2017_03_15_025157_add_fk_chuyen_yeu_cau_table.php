<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkChuyenYeuCauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_transfers', function (Blueprint $table) {
            $table->foreign('request_id')
                ->references('id')->on('requests')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('store_room_id')
                ->references('store_room_id')->on('store_rooms')
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
        Schema::table('request_transfers', function (Blueprint $table) {
            $table->dropForeign(['request_id']);
            $table->dropForeign(['store_room_id']);
        });
    }
}
