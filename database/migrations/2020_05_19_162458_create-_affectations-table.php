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
            $table->integer('idAgent');
            $table->string('Zone',10);
            $table->unique(['AdresseIp','idAgent','Zone']);
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
