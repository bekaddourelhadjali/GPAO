<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparation', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumTube')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('Tube',5);
            $table->Boolean('Bis');
            $table->string('Observation')->nullable();
            $table->string('Defauts')->nullable();
            $table->integer('NumeroRap')->unsigned();
            $table->string('User',50);
            $table->string('Computer',50);
            $table->dateTime('DateSaisie');
            $table->index('Did');
            $table->index('NumeroRap');
            $table->index('Bis');
            $table->index('NumTube');
            $table->index('Tube');
            $table->index('DateSaisie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparation');
    }
}
