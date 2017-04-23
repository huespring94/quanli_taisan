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
            $table->string('store_room_id', 20)->unique()->nullable();
            $table->date('date_import');
            $table->integer('quantity');
            $table->integer('status');
            $table->string('room_id', 20);
            $table->string('store_faculty_id', 20);
            $table->string('stuff_id', 100);
//            $table->integer('user_id')->unsigned()->nullable();
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
