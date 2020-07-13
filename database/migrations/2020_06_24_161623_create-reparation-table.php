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
            $table->double('Longueur');
            $table->Boolean('DfInt')->default(0);
            $table->Boolean('DfExt')->default(0);
            $table->Boolean('Rep1')->default(0);
            $table->Boolean('Rep2')->default(0);
            $table->Boolean('Rep3')->default(0);
            $table->string('Observation')->nullable();
            $table->string('Defauts')->nullable();
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
        Schema::table('reparation', function (Blueprint $table) {
            //
        });
    }
}
