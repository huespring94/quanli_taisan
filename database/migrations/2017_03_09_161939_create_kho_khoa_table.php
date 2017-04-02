<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoKhoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_import');
            $table->integer('quantity');
            $table->string('status');
            $table->integer('faculty_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('detail_import_store_id')->unsigned();
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
        Schema::dropIfExists('store_faculties');
    }
}
