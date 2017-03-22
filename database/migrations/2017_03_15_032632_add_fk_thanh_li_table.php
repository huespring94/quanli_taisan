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
        Schema::table('liquidations', function (Blueprint $table) {
            $table->foreign('detail_import_store_id')
                ->references('id')->on('detail_import_stores')
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
        Schema::table('liquidations', function (Blueprint $table) {
            $table->dropForeign(['detail_import_store_id']);
        });
    }
}
