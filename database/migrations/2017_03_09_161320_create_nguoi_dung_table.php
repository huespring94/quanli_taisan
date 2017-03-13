<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoiDungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->increments('ma');
            $table->string('mat_khau', 255);
            $table->string('ten', 20);
            $table->string('ho'. 50);
            $table->date('ngay_sinh')->nullable();
            $table->string('dien_thoai', 11)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('dia_chi', 500)->nullable();
            $table->integer('ma_phan_quyen')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguoi_dung');
    }
}
