<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevintreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view revintreport as(
         SELECT ri."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", ri."NumeroRap",ri."Tube",ri."Observation"
         ,ri."Pid", ri."Did", Left(ri."Tube",1) "Machine", "Ntube" ,"Bis", "NumReception","Aspect","Accepte",ri."Longueur"/1000 "Longueur", Round( cast (float8 ((ri."Longueur"/1000)*d."PoidsMetrique")/1000  as numeric),3) "Poids"
          ,ri."User", raps."DateSaisie" FROM "rev_int" ri join "rapports" raps on ri."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=ri."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View revintreport');
    }
}
