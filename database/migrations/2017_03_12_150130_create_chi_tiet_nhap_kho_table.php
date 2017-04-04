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
        Schema::create('detail_import_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('price_unit');
            $table->integer('atrophy_rate');
            $table->integer('status');
            $table->integer('import_store_id')->unsigned();
            $table->string('stuff_id', 100);
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
        Schema::dropIfExists('detail_import_stores');
    }
}
