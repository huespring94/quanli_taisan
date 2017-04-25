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
            $table->string('store_faculty_id', 30)->unique()->nullable();
            $table->date('date_import');
            $table->integer('quantity_start')->nullable();
            $table->integer('quantity');
            $table->integer('status');
            $table->string('faculty_id', 20);
            $table->string('stuff_id', 100);
//            $table->integer('user_id')->unsigned()->nullable();
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
