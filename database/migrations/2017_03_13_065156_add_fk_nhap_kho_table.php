<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkNhapKhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nhap_kho', function (Blueprint $table) {
            $table->foreign('ma_kho')
                ->references('ma')->on('kho')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_nguoi_dung')
                ->references('ma')->on('nguoi_dung')
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
        Schema::table('nhap_kho', function (Blueprint $table) {
            $table->dropForeign(['ma_nguoi_dung']);
            $table->dropForeign(['ma_kho']);
        });
    }
}
