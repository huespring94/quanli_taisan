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
        Schema::create('kho_phong', function (Blueprint $table) {
            $table->increments('ma');
            $table->datetime('ngay_nhap');
            $table->string('tinh_trang');
            $table->integer('ma_phong')->unsigned();
            $table->integer('ma_kho_khoa')->unsigned();
            $table->integer('ma_nguoi_dung')->unsigned();
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
        Schema::dropIfExists('kho_phong');
    }
}
