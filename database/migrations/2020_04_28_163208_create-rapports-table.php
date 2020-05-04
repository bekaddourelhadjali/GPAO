<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->increments('Numero');
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->date('DateRapport');
            $table->string('Zone',10);
            $table->string('Equipe',1);
            $table->string('Machine',1);
            $table->string('Poste',2);
            $table->string('NomAgents',100);
            $table->string('NomAgents1',100)->nullable();
            $table->string('CodeAgent',100)->nullable();
            $table->string('CodeAgent1',100)->nullable();
            $table->string('Tension',10)->nullable();
            $table->string('Intensite',10)->nullable();
            $table->string('TmpPose',10)->nullable();
            $table->string('DisBras',10)->nullable();
            $table->string('NLot',10)->nullable();
            $table->string('Proc',10)->nullable();
            $table->string('TSIFlux',20)->nullable();
            $table->string('TSIFil',20)->nullable();
            $table->string('TSEFlux',20)->nullable();
            $table->string('TSEFil',20)->nullable();
            $table->string('VSoudage',20)->nullable();
            $table->string('LargCisAlge',20)->nullable();
            $table->string('Flux',20)->nullable();
            $table->string('Fil',20)->nullable();
            $table->string('Computer',50)->nullable();
            $table->string('User',50)->nullable();
            $table->dateTime('DateSaisie')->nullable();
            $table->string('Etat',1)->nullable();
            $table->text('ObsRap')->nullable();
            $table->double('MinNRecep')->nullable();
            $table->double('MaxNRecep')->nullable();
            $table->string('MaxTube',5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapports');
    }
}
