<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkChiTietNhapKhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chi_tiet_nhap_kho', function (Blueprint $table) {
            $table->foreign('ma_nha_cung_cap')
                ->references('ma')->on('nha_cung_cap')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_vat_tu')
                ->references('ma_vat_tu')->on('vat_tu')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_nhap_kho')
                ->references('ma')->on('nhap_kho')
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
        Schema::table('chi_tiet_nhap_kho', function (Blueprint $table) {
            $table->dropForeign(['ma_nha_cung_cap']);
            $table->dropForeign(['ma_vat_tu']);
            $table->dropForeign(['ma_nhap_kho']);
        });
    }
}
