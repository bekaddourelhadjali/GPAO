<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapprod', function (Blueprint $table) {
            $table->increments('Numero');
            $table->integer('NumeroRap');
            $table->string('NumTube',10);
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->integer('Nord')->nullable();
            $table->string('Coulee',50);
            $table->string('Bobine',50);
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->string('IdOpr',10)->nullable();
            $table->integer('NbOpr')->nullable();
            $table->string('IdDef')->nullable();
            $table->double('Longueur');
            $table->string('macro',20)->nullable();
            $table->string('U')->nullable();
            $table->Boolean('S')->nullable();
            $table->Boolean('AC')->nullable();
            $table->Boolean('RB');
            $table->string('W',4)->nullable();
            $table->string('Motif',50)->nullable();
            $table->string('NumRec',50)->nullable();
            $table->string('Observation')->nullable();
            $table->string('Computer',50)->nullable();
            $table->string('User',50)->nullable();
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
        Schema::dropIfExists('rapprod');
    }
}
