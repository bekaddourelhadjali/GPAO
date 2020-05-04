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
            $table->string('Stand',50)->nullable();
            $table->string('Du',6);
            $table->string('Au',6);
            $table->string('Durée',5);
            $table->string('Cause',255)->nullable();
            $table->string('NDI',10)->nullable();
            $table->string('Obs',255)->nullable();
            $table->string('Flux_Int',50)->nullable();
            $table->string('Fil_Int',50)->nullable();
            $table->string('Flux_Ext',50)->nullable();
            $table->string('Fil_Ext',50)->nullable();
            $table->double('V_Soudage',50)->nullable();
            $table->double('Larg_CisAlge',50)->nullable();
            $table->string('Relv_Compt',50)->nullable();

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
