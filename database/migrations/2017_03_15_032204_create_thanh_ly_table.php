<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanhLyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thanh_ly', function (Blueprint $table) {
            $table->increments('ma');
            $table->date('ngay_thanh_ly');
            $table->integer('so_luong');
            $table->integer('ma_chi_tiet_nhap_kho')->unsigned();
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
        Schema::dropIfExists('thanh_ly');
    }
}
