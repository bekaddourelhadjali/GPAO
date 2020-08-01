<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatRapportsEdits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports_edits', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Operation',20);
            $table->string('Item',20);
            $table->string('Zone',20);
            $table->integer('NumeroRap')->nullable();
            $table->integer('ItemId');
            $table->string('User');
            $table->string('Computer')->nullable();
            $table->dateTime('DateSaisie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapports_edits');
    }
}
