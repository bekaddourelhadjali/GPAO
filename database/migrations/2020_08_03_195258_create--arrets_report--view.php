<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArretsReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { \Illuminate\Support\Facades\DB::statement('create view arretsreport as(  select a.*,r."Poste",r."Machine" "RMachine",r."Zone",r."User",r."Etat",r."DateSaisie" from "arret_machine" a join "rapports" r on a."NumRap"=r."Numero" )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View arretsreport');
    }
}
