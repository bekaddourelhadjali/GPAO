<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Affectations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('AdresseIp',15);
            $table->integer('idMachine')->nullable();
            $table->integer('idAgent')->nullable();
            $table->unique(['AdresseIp','idMachine']);
            $table->unique(['AdresseIp','idAgent']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Affectations');
    }
}
