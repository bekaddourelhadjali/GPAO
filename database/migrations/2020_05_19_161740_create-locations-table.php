<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Designation',60);
            $table->string('Zone',10);
            $table->string('AdresseIp',15);
            $table->unique(['Zone','AdresseIp']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Locations');
    }
}
