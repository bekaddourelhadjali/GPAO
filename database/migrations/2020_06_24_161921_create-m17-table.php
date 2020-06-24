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
        Schema::table('m17', function (Blueprint $table) {
            //NumTube	Pid	Did	Machine	NTube	Tube	Bis	IdOpr	Nord	NbOpr	LongCh	Oxyc	RB	Eprouv	NdHt	Vis	Scop	Final	DdbFt	Observation	NumRap	Computer	User	DateSaisie	Visible
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
