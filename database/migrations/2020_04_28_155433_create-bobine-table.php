<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBobineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobine', function (Blueprint $table) {
            $table->integer('Did')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->string('Coulee',40);
            $table->string('Bobine',40);
            $table->integer('CodeFournis')->unsigned();
            $table->double('Poids');
            $table->string('Arrivage',10)->nullable();
            $table->string('NBon',50)->nullable();
            $table->string('Etat',50)->nullable();
            $table->string('InitDep')->nullable();
            $table->string('InitArr')->nullable();
            $table->dateTime('DateAcc')->nullable();
            $table->integer('Test')->nullable();
            $table->dateTime('DateEff')->nullable();
            $table->string('User',50)->nullable();
            $table->string('Computer',50)->nullable();
            $table->integer('Cons')->nullable();
            $table->dateTime('DateArr')->nullable();
            $table->string('Nord',10)->nullable();
            $table->string('Ana',50)->nullable();
            $table->integer('Selec')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bobine');
    }
}
