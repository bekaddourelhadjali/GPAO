<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m3', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Did')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->string('Coulee',10);
            $table->string('Bobine',10);
            $table->integer('CodeFournis')->nullable();
            $table->integer('Poids');
            $table->integer('LargeurD');
            $table->integer('LargeurF');
            $table->integer('EpaisseurD');
            $table->integer('EpaisseurC');
            $table->integer('EpaisseurF');
            $table->string('DDB',10);
            $table->string('DDB/R',10);
            $table->string('FT',10);
            $table->string('GB/MB',10);
            $table->boolean('Test1');
            $table->integer('ChutesT');
            $table->integer('ChutesQ');
            $table->string('Observation',100);
            $table->integer('NumeroRap');
            $table->string('Computer',25)->nullable();
            $table->string('DateSaisie',20)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m3');
    }
}
