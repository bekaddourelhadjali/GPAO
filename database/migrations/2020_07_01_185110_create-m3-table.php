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
            $table->increments('Id');
            $table->integer('IdBobine')->unsigned();
            $table->integer('LargeurD');
            $table->integer('LargeurF');
            $table->double('EpaisseurD');
            $table->double('EpaisseurC');
            $table->double('EpaisseurF');
            $table->boolean('DDB',10);
            $table->boolean('DDB_R',10);
            $table->boolean('FT',10);
            $table->boolean('GB_MB',10);
            $table->boolean('Test1');
            $table->double('ChutesT');
            $table->double('ChutesQ');
            $table->string('Observation',100)->nullable();
            $table->integer('NumeroRap');
            $table->string('Computer',25)->nullable();
            $table->string('DateSaisie',20);
            $table->index('NumeroRap');
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
        Schema::dropIfExists('m3');
    }
}
