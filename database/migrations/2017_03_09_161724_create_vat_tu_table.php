<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat_tu', function (Blueprint $table) {
            $table->increments('ma');
            $table->string('ten', 200);
            $table->string('mo_ta', 2000)->nullable();
            $table->string('don_vi_tinh', 10);
            $table->integer('ma_loai_vat_tu')->unsigned();
            $table->integer('ma_hao_mon')->unsigned();
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
        Schema::dropIfExists('vat_tu');
    }
}
