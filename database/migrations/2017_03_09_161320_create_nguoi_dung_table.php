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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password', 255);
            $table->string('firstname', 20);
            $table->string('lastname', 50);
            $table->string('avatar');
            $table->date('dob')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('email')->unique();
            $table->string('address', 500)->nullable();
            $table->integer('role_id')->unsigned();
            $table->string('faculty_id', 10)->nullable();
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
        Schema::dropIfExists('users');
    }
}
