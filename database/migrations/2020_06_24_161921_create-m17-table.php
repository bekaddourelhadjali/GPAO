<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM17Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m17', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('NumTube')->unsigned();
            $table->integer('Pid')->unsigned();
            $table->integer('Did')->unsigned();
            $table->string('Machine',1);
            $table->string('Ntube',4);
            $table->string('Tube',5);
            $table->Boolean('Bis');
            $table->double('LongCh');
            $table->string('Operation',30);
            $table->Boolean('Oxyc')->default(0);
            $table->Boolean('RB')->default(0);
            $table->Boolean('Eprouv')->default(0);
            $table->Boolean('NdHt')->default(0);
            $table->Boolean('Vis')->default(0);
            $table->Boolean('Scop')->default(0);
            $table->Boolean('Final')->default(0);
            $table->Boolean('DdbFt')->default(0);
            $table->string('Observation')->nullable();
            $table->integer('NumeroRap')->unsigned();
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
        Schema::table('m17', function (Blueprint $table) {
            //
        });
    }
}
