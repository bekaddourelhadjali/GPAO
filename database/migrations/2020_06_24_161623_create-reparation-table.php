<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reparation', function (Blueprint $table) {
            //NumTube	Pid	Did	Machine	NTube	Tube	Bis	Nord	IdOpr	NbOpr	IdDef	Longueur	LongCh	DfInt	DfExt	Rep1	Rep2	Rep3	Observation	NumRap	Computer	User	DateSaisie	Visible
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reparation', function (Blueprint $table) {
            //
        });
    }
}
