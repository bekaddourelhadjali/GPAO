<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view usreport as(  SELECT us."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", us."NumeroRap",us."Tube",us."Observation"
 ,us."Pid", us."Did", us."Coulee", us."Bobine", us."Machine", "Ntube" 
 , us."S", us."MB", us."RB", 
 us."User", us."DateSaisie"
    FROM "ultrason" us join "rapports" raps on us."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=us."Did" )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View usreport');
    }
}
