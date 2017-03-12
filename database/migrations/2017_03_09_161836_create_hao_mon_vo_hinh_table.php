<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaoMonVoHinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hao_mon_vo_hinh', function (Blueprint $table) {
            $table->increments('ma');
            $table->string('ten', 1000);
            $table->string('mo_ta', 2000);
            $table->integer('ty_le_hao_mon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hao_mon_vo_hinh');
    }
}
