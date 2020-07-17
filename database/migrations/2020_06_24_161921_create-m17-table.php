<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM17Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m17', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumTube')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('Tube',5);
            $table->Boolean('Bis');
            $table->double('LongCh');
            $table->string('Defauts',50);
            $table->string('Observation',50)->nullable();
            $table->integer('NumeroRap')->unsigned();
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
        Schema::table('m17', function (Blueprint $table) {
            //
        });
    }
}
