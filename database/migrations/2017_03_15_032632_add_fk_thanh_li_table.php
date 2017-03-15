<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkThanhLiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thanh_ly', function (Blueprint $table) {
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
        Schema::table('thanh_ly', function (Blueprint $table) {
            $table->dropForeign(['ma_chi_tiet_nhap_kho']);
        });
    }
}
