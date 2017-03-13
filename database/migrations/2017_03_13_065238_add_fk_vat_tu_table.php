<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vat_tu', function (Blueprint $table) {
            $table->foreign('ma_loai_vat_tu')
                ->references('ma')->on('loai_vat_tu')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('ma_hao_mon')
                ->references('ma')->on('hao_mon_vo_hinh')
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
        Schema::table('vat_tu', function (Blueprint $table) {
            $table->dropForeign(['ma_loai_vat_tu']);
            $table->dropForeign(['ma_hao_mon']);
        });
    }
}
