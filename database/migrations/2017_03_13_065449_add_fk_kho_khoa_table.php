<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkKhoKhoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kho_khoa', function (Blueprint $table) {
            $table->foreign('ma_khoa')
                ->references('ma')->on('khoa')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_nguoi_dung')
                ->references('ma')->on('nguoi_dung')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_chi_tiet_nhap_kho')
                ->references('ma')->on('chi_tiet_nhap_kho')
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
        Schema::table('kho_khoa', function (Blueprint $table) {
            $table->dropForeign(['ma_khoa']);
            $table->dropForeign(['ma_nguoi_dung']);
            $table->dropForeign(['ma_chi_tiet_nhap_kho']);
        });
    }
}
