<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRx1reportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view rx1report as(
         SELECT rx."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", rx."NumeroRap",rx."Tube",rx."Observation"
         ,rx."Pid", rx."Did", rx."Machine", "Ntube" ,"Bis", "Defauts" ,"Integration","CodeSoude", rx."User", raps."DateSaisie"
            FROM "rx1" rx join "rapports" raps on rx."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=rx."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View rx1report');
    }
}
