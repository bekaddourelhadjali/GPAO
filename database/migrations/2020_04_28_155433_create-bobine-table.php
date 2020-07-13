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
            $table->increments('Id');
            $table->integer('Did')->nullable();
            $table->integer('Pid')->nullable();
            $table->string('Arrivage',10)->nullable();
            $table->string('Coulee',10);
            $table->string('Bobine',10);
            $table->double('Poids');
            $table->double('Poids_b')->nullable();
            $table->double('Epaisseur')->nullable();
            $table->double('LargeurBande')->nullable();
            $table->string('Fournisseur',15)->nullable();
            $table->integer('NbReception')->nullable();
            $table->date('DateRec')->nullable();
            $table->string('Source')->nullable();
            $table->string('NbBon',50)->nullable();
            $table->string('Etat',50)->default('NonREC');
            $table->boolean('Test')->default(0);
            $table->integer('Cons')->nullable();
            $table->integer('NbCons')->nullable();
            $table->date('DateCons')->nullable();
            $table->string('Machine')->nullable();
            $table->string('User',50)->nullable();
            $table->string('Computer',50)->nullable();
            $table->dateTime('DateSaisie')->nullable();
            $table->integer('NumeroRap')->nullable();
            $table->unique(['Coulee','Bobine']);
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
