<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevIntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rev_int', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap')->unsigned();
            $table->integer('NumTube')->unsigned();
            $table->integer('NumReception')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Ntube',4);
            $table->integer('Langueur');
            $table->Boolean('Bis');
            $table->string('Aspect');
            $table->Boolean('Accepte');
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
        Schema::dropIfExists('rev_int');
    }
}
