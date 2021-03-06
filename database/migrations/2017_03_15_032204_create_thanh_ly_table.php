<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanhLyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_liquidation');
            $table->integer('quantity');
//            $table->integer('detail_import_store_id')->unsigned()->nullable();
            $table->string('store_liquidation_id', 50)->nullable();
            $table->string('store_type', 50);
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
        Schema::dropIfExists('liquidations');
    }
}
