<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoPhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_room_id', 20)->unique();
            $table->date('date_import');
            $table->integer('quantity');
            $table->integer('status');
            $table->integer('room_id')->unsigned();
            $table->string('store_faculty_id', 20);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_rooms');
    }
}
