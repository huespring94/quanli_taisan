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
            $table->string('ma', 100);
            $table->string('ma_vat_tu', 100)->unique();
            $table->string('ten', 200);
            $table->string('mo_ta', 2000)->nullable();
            $table->string('don_vi_tinh', 10);
            $table->string('ma_loai_vat_tu', 10);
            $table->integer('ma_hao_mon')->unsigned();
            $table->timestamps();
            $table->primary('ma');
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
