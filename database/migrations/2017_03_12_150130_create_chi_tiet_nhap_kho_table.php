<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietNhapKhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_nhap_kho', function (Blueprint $table) {
            $table->increments('ma');
            $table->integer('so_luong');
            $table->integer('don_gia');
            $table->string('trang_thai', 100);
            $table->integer('ma_nhap_kho')->unsigned();
            $table->string('ma_vat_tu', 100);
            $table->string('ma_nha_cung_cap', 10);
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
        Schema::dropIfExists('chi_tiet_nhap_kho');
    }
}
