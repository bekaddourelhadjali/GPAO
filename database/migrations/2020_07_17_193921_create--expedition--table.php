<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpeditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedition', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap')->unsigned();
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->integer('Langueur');
            $table->integer('Poids')->nullable();
            $table->integer('NumLot')->nullable();
            $table->integer('Coulee')->nullable();
            $table->integer('NumExpedition')->nullable();
            $table->string('Observation')->nullable();
            $table->string('User',50);
            $table->string('Computer',50);
            $table->dateTime('DateSaisie');
            $table->unique(['NumExpedition','Did']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedition');
    }
}
