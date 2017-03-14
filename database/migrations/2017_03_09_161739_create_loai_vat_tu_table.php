<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_vat_tu', function (Blueprint $table) {
            $table->string('ma', 10);
            $table->string('ten', 100);
            $table->string('mo_ta', 1000)->nullable();
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
        Schema::dropIfExists('loai_vat_tu');
    }
}
