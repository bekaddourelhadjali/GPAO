<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM24Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m24', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumTube')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('Tube',5);
            $table->Boolean('Bis');
            $table->integer('NbOpr');
            $table->string('Operation',30);
            $table->double('Pression');
            $table->string('Observation')->nullable();
            $table->integer('NumeroRap')->unsigned();
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
        Schema::dropIfExists('m24');
    }
}
