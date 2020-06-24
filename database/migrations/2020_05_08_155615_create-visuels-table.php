<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('visuels', function (Blueprint $table) {
            $table->increments('Numero');
            $table->integer('NumeroRap');
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->Boolean('Sond');
            $table->integer('E');
            $table->integer('Y');
            $table->string('IdOpr',10)->nullable();
            $table->integer('NbOpr')->nullable();
            $table->double('Longueur');
            $table->string('ObsSoudure');
            $table->string('ObsMetal');
            $table->string('IdDef')->nullable();
            $table->decimal('LongCh')->nullable();
            $table->double('DiamD');
            $table->double('DiamF');
            $table->double('Val3')->nullable();
            $table->double('Val4')->nullable();
            $table->double('Pression')->nullable();
            $table->string('Motif',50)->nullable();
            $table->string('NumRec',50)->nullable();
            $table->string('Observation')->nullable();
            $table->string('Computer',50)->nullable();
            $table->string('User',50)->nullable();
            $table->dateTime('DateSaisie');
            $table->Boolean('Visible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visuels', function (Blueprint $table) {
            //
        });
    }
}
