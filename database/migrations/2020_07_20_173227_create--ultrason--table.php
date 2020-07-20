<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUltrasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ultrason', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumeroRap');
            $table->integer('NumTube')->unsigned();
            $table->string('Tube',5);
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Coulee',50);
            $table->string('Bobine',50);
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('S')->default(0);
            $table->string('MB')->default(0);
            $table->Boolean('RB')->default(0);
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
        Schema::dropIfExists('ultrason');
    }
}
