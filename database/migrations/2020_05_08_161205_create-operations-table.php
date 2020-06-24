<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Operation',50);
            $table->string('LibStand',80)->nullable();
            $table->string('Zone',5)->nullable();
            $table->integer('Type')->nullable();
            $table->string('OBS',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operations', function (Blueprint $table) {
            //
        });
    }
}
