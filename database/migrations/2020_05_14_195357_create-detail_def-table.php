<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailDefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('detailDef', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Pid');
            $table->integer('Did');
            $table->string('Zone',5);
            $table->integer('NumRap');
            $table->integer('NumVisuel');
            $table->string('Tube',6);
            $table->string('Opr',50);
            $table->integer('IdDef')->nullable();
            $table->string('Defaut',50)->nullable();
            $table->double('Valeur',50)->nullable();
            $table->integer('NbOpr');
            $table->integer('Nombre')->nullable();
            $table->Boolean('Int')->default(0);
            $table->Boolean('Ext')->default(0);
            $table->string('Observation',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('detailDef');
    }
}
