<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('preName');
            $table->string('lastName');
            $table->string('password');
            $table->string('email');
            $table->string('addresse')->nullable();
            $table->string('city')->nullable();
            $table->string('streetNo')->nullable();
            $table->boolean('isActive')->nullable();
            $table->boolean('fieldsRequired')->nullable();
            $table->string('imageUrl')->nullable();
            $table->text('authorities')->nullable();


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
