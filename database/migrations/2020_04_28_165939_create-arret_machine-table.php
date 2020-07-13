<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArretMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arret_machine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Pid');
            $table->integer('Did');
            $table->integer('NumRap');
            $table->string('Machine',50);
            $table->string('TypeArret',10);
            $table->string('Du',6);
            $table->string('Au',6);
            $table->string('Durée',5);
            $table->string('Cause',255)->nullable();
            $table->string('NDI',10)->nullable();
            $table->string('Obs',255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arret_machine');
    }
}
