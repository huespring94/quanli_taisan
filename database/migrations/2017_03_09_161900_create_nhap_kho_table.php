<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhapKhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhap_kho', function (Blueprint $table) {
            $table->increments('ma');
            $table->datetime('ngay_nhap');
            $table->integer('so_tien');
            $table->integer('ma_nguoi_dung')->unsigned();
            $table->integer('ma_kho')->unsigned();
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
        Schema::dropIfExists('nhap_kho');
    }
}
