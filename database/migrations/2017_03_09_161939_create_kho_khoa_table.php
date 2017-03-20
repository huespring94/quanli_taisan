<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoKhoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kho_khoa', function (Blueprint $table) {
            $table->increments('ma');
            $table->datetime('ngay_nhap');
            $table->integer('so_luong');
            $table->string('tinh_trang');
            $table->integer('ma_khoa')->unsigned();
            $table->integer('ma_nguoi_dung')->unsigned();
            $table->integer('ma_chi_tiet_nhap_kho')->unsigned();
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
        Schema::dropIfExists('kho_khoa');
    }
}
