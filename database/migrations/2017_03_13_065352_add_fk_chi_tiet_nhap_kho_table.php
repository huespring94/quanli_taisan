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
        Schema::table('detail_import_stores', function (Blueprint $table) {
            $table->foreign('stuff_id')
                ->references('stuff_id')->on('stuffs')
                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('import_store_id')
                ->references('id')->on('import_stores')
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
        Schema::table('detail_import_stores', function (Blueprint $table) {
            $table->dropForeign(['stuff_id']);
            $table->dropForeign(['import_store_id']);
        });
    }
}
