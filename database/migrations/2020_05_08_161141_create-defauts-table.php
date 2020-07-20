<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefautsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('defauts', function (Blueprint $table) {
           $table->increments('id');
           $table->string('Defaut',50);
           $table->string('Zone',5);
           $table->string('Type',10)->nullable();
           $table->unique(['Defaut','Zone','Type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defauts', function (Blueprint $table) {
            //
        });
    }
}
