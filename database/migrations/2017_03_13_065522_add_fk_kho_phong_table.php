<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkKhoPhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kho_phong', function (Blueprint $table) {
            $table->foreign('ma_phong')
                ->references('ma')->on('phong')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_nguoi_dung')
                ->references('ma')->on('nguoi_dung')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_kho_khoa')
                ->references('ma')->on('kho_khoa')
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
        Schema::table('kho_phong', function (Blueprint $table) {
            $table->dropForeign(['ma_phong']);
            $table->dropForeign(['ma_nguoi_dung']);
            $table->dropForeign(['ma_kho_khoa']);
        });
    }
}
