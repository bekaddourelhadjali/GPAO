<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operateur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Pid');
            $table->integer('Did');
            $table->integer('NumRap');
            $table->String('Nom', 60);
            $table->index('NumRap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operateur');
    }
}
