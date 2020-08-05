<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view repreport as(
         SELECT rep."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", rep."NumeroRap",rep."Tube",rep."Observation"
         ,rep."Pid", rep."Did", rep."Machine", "Ntube" ,"Bis", "Defauts"  , rep."User", raps."DateSaisie"
            FROM "reparation" rep join "rapports" raps on rep."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=rep."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View repreport');
    }
}
