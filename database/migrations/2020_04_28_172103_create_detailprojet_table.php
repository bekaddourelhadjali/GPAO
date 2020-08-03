<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailprojet', function (Blueprint $table) {
            $table->increments('Did');
            $table->integer('Pid')->unsigned();
            $table->string('Nuance', 10)->nullable();
            $table->double('Epaisseur');
            $table->double('Diametre');
            $table->integer('Psl')->nullable();
            $table->integer('Longueur');
            $table->string('Libelle')->nullable();
            $table->double('PoidsMetrique');
            $table->unique(['Did','Pid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_details');
    }
}
