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
            $table->string('NumTube')->unique;
            $table->integer('Pid');
            $table->string('Machine',1);
            $table->string('NTube',4);
            $table->Boolean('Bis');
            $table->Boolean('Sond')->nullable();
            $table->string('Mil',2)->nullable();
            $table->string('Tube',50);
            $table->string('NRecept',50)->nullable();
            $table->integer('Did')->unsigned();
            $table->string('NBord',50)->nullable();
            $table->date('DateRecept')->nullable();
            $table->string('Obs',50)->nullable();
            $table->string('NPV',10)->nullable();
            $table->string('Nord',50)->nullable();
            $table->decimal('Poids')->nullable();
            $table->string('Coulee',50);
            $table->string('Bobine',50);
            $table->date('DateFab')->nullable();
            $table->double('LongFab')->nullable();
            $table->double('LongProd')->nullable();
            $table->double('LongCh')->nullable();
            $table->double('Longueur');
            $table->dateTime('DateRE')->nullable();
            $table->dateTime('DateRI')->nullable();
            $table->double('EpaisD')->nullable();
            $table->double('EpaisF')->nullable();
            $table->double('DiamD')->nullable();
            $table->double('DiamF')->nullable();
            $table->double('Pression')->nullable();
            $table->Boolean('Envoye')->nullable();
            $table->dateTime('DateExped')->nullable();
            $table->string('Computer',50)->nullable();
            $table->string('User',50)->nullable();
            $table->dateTime('DateSaisie')->nullable();
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
