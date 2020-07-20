<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRx2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rx2', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap')->unsigned();
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Ntube',4);
            $table->Boolean('Bis');
            $table->string('Integration',20);
            $table->string('CodeSoude',20);
            $table->string('Defauts');
            $table->string('Observation')->nullable();
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
        Schema::dropIfExists('rx2');
    }
}
