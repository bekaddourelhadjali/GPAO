<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVfrreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view vfrreport as(
         SELECT vfr."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", vfr."NumeroRap",vfr."Tube",vfr."Observation"
         ,vfr."Pid", vfr."Did", Left(vfr."Tube",1) "Machine", "Ntube" ,"Bis", "Defauts"  , vfr."User", raps."DateSaisie"
            FROM "vf_refuses" vfr join "rapports" raps on vfr."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=vfr."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View vfrreport');
    }
}
