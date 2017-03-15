<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYeuCauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeu_cau', function (Blueprint $table) {
            $table->increments('ma');
            $table->integer('so_luong');
            $table->string('loai_yeu_cau', 50);
            $table->integer('trang_thai');
            $table->string('ghi_chu', 1000);
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
        Schema::dropIfExists('yeu_cau');
    }
}
