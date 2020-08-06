<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevextreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view revextreport as(
         SELECT re."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", re."NumeroRap",re."Tube",re."Observation"
         ,re."Pid", re."Did", Left(re."Tube",1) "Machine", "Ntube" ,"Bis", "NumReception","Aspect","Accepte",re."Longueur"/1000 "Longueur", Round( cast (float8 ((re."Longueur"/1000)*d."PoidsMetrique")/1000  as numeric),3) "Poids"
          ,re."User", raps."DateSaisie" FROM "rev_ext" re join "rapports" raps on re."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=re."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View revextreport');
    }
}
