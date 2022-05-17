<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user_pivots', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('project_id');
            $table->integer('user_id');
            $table->tinyInteger('role');
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
        Schema::dropIfExists('project_user_pivots');
    }
}
