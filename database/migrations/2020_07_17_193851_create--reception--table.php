<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap')->unsigned();
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->integer('Langueur');
            $table->integer('Coulee')->nullable();
            $table->integer('NumReception');
            $table->integer('NumLot');
            $table->string('Observation')->nullable();
            $table->string('User',50);
            $table->string('Computer',50);
            $table->dateTime('DateSaisie');
            $table->unique(['NumReception','Did']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reception');
    }
}
