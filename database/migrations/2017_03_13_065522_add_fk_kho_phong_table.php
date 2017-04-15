<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkKhoPhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_rooms', function (Blueprint $table) {
            $table->foreign('room_id')
                ->references('id')->on('rooms')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('store_faculty_id')
                ->references('store_faculty_id')->on('store_faculties')
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
        Schema::table('store_rooms', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['store_faculty_id']);
        });
    }
}
