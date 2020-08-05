<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdtreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view ndtreport as(
         SELECT n."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", n."NumeroRap",n."Tube",n."Observation"
         ,n."Pid", n."Did", n."Machine", "Ntube" ,"Bis", n."OPR"  ,n."Snup", n."Repd"  ,n."Repg", n."User", raps."DateSaisie"
            FROM "ndt" n join "rapports" raps on n."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=n."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View ndtreport');
    }
}
