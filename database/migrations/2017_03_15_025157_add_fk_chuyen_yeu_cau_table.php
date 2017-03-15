<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkChuyenYeuCauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chuyen_yeu_cau', function (Blueprint $table) {
            $table->foreign('ma_yeu_cau')
                ->references('ma')->on('yeu_cau')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_kho_phong')
                ->references('ma')->on('kho_phong')
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
        Schema::table('chuyen_yeu_cau', function (Blueprint $table) {
            $table->dropForeign(['ma_yeu_cau']);
            $table->dropForeign(['ma_kho_phong']);
        });
    }
}
