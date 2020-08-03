<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view FABReport as(  SELECT rp."Numero",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", rp."NumeroRap","Tube",rp."Observation" ,rp."Pid", rp."Did", "Coulee", "Bobine", rp."Machine", "Ntube", rp."Longueur"/1000 "Longueur", Round( cast (float8 ((rp."Longueur"/1000)*d."PoidsMetrique")/1000  as numeric),3) "Poids", "Macro", "RB",  rp."User", rp."DateSaisie"
    FROM "rapprod" rp join "rapports" raps on rp."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=rp."Did" )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View FABReport');
    }
}
