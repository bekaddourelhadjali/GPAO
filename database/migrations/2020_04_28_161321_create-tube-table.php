<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tube', function (Blueprint $table) {
            $table->increments('NumTube');
            $table->integer('Pid');
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('NTube',4);
            $table->Boolean('Bis')->default(0);
            $table->Boolean('Sond')->nullable();
            $table->string('Tube',50);
            $table->string('NRecept',50)->nullable();
            $table->date('DateRecept')->nullable();
            $table->string('Obs',50)->nullable();
            $table->decimal('Poids')->nullable();
            $table->string('Coulee',50)->nullable();
            $table->string('Bobine',50)->nullable();
            $table->date('DateFab')->nullable();
            $table->double('Longueur')->nullable();
            $table->dateTime('DateRE')->nullable();
            $table->dateTime('DateRI')->nullable();
            $table->double('EpaisD')->nullable();
            $table->double('EpaisF')->nullable();
            $table->double('DiamD')->nullable();
            $table->double('DiamF')->nullable();
            $table->double('Pression')->nullable();
            $table->dateTime('DateExped')->nullable();
            $table->string('Computer',50)->nullable();
            $table->string('User',50)->nullable();
            $table->dateTime('DateSaisie')->nullable();
            $table->Boolean('Z01')->default(false);
            $table->Boolean('Z02')->default(false);
            $table->Boolean('Z03')->default(false);
            $table->Boolean('Z04')->default(false);
            $table->Boolean('Z05')->default(false);
            $table->Boolean('Z06')->default(false);
            $table->Boolean('Z07')->default(false);
            $table->Boolean('Z08')->default(false);
            $table->Boolean('Z09')->default(false);
            $table->Boolean('Z10')->default(false);
            $table->Boolean('Z11')->default(false);
            $table->Boolean('Z12')->default(false);
            $table->Boolean('Z13')->default(false);
            $table->Boolean('Z14')->default(false);
            $table->Boolean('Z15')->default(false);
            $table->Boolean('Z16')->default(false);
            $table->unique(['Pid','Did','Machine','NumTube','Bis']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tube');
    }
}
