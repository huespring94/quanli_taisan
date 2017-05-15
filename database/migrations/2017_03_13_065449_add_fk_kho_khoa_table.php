<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkKhoKhoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_faculties', function (Blueprint $table) {
            $table->foreign('faculty_id')
                ->references('faculty_id')->on('faculties')
                ->onUpdate('cascade')->onDelete('NO ACTION');
//            $table->foreign('user_id')
//                ->references('id')->on('users')
//                ->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreign('detail_import_store_id')
                ->references('id')->on('detail_import_stores')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_faculties', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
//            $table->dropForeign(['user_id']);
            $table->dropForeign(['detail_import_store_id']);
        });
    }
}
