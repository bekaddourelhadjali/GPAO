<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM24reportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  \Illuminate\Support\Facades\DB::statement('create view m24report as(
         SELECT m."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", m."NumeroRap",m."Tube",m."Observation"
         ,m."Pid", m."Did", m."Machine", "Ntube" ,"Bis", m."Pression"  , m."User", raps."DateSaisie"
            FROM "m24" m join "rapports" raps on m."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=m."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View m24report');
    }
}
