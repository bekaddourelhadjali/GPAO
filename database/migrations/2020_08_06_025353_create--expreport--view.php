<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view expreport as(
         SELECT ex."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", ex."NumeroRap",ex."Tube",ex."Observation"
         ,ex."Pid", ex."Did", Left(ex."Tube",1) "Machine", "Ntube" ,"Bis", "NumBon", "Coulee","NumExpedition","DateExpedition","Site","Transporteur"
         ,ex."Longueur"/1000 "Longueur",    Round(cast("Poids" as numeric)/1000 ,3)"Poids" 
          ,ex."User", raps."DateSaisie" FROM "expedition" ex join "rapports" raps on ex."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=ex."Did"
    )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View expreport');
    }
}
