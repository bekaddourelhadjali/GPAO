<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM25Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m25', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumTube')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('Tube',5);
            $table->Boolean('Bis'); 
            $table->Boolean('Debut');
            $table->Boolean('Fin');
            $table->string('Observation')->nullable();
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
        Schema::dropIfExists('m25');
    }
}
