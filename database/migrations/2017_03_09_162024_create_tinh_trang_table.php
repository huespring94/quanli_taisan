<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinhTrangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinh_trang', function (Blueprint $table) {
            $table->increments('ma');
            $table->integer('ma_kho_phong')->unsigned();
            $table->integer('hu_hai_hien_tai')->unsigned()->default(0);
            $table->integer('tong_hu_hai')->unsigned()->default(0);
            $table->date('thoi_gian')->nullable();
            $table->string('ghi_chu', 1000)->nullable();
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
        Schema::dropIfExists('tinh_trang');
    }
}
