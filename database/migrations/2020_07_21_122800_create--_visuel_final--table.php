<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisuelFinalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visuel_final', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap')->unsigned();
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->double('EpaisseurD');
            $table->double('EpaisseurC');
            $table->double('EpaisseurF');
            $table->double('DiametreD');
            $table->double('DiametreC');
            $table->double('DiametreF');
            $table->string('Ovalisation',20);
            $table->string('OrthogonaliteD',20);
            $table->string('OrthogonaliteF',20);
            $table->string('Rectitude',20);
            $table->string('ChanfreinD',20);
            $table->string('ChanfreinF',20);
            $table->integer('Longueur');
            $table->string('Defauts');
            $table->string('Observation',50)->nullable();
            $table->string('User',50);
            $table->string('Computer',50);
            $table->dateTime('DateSaisie');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visuel_final');
    }
}
