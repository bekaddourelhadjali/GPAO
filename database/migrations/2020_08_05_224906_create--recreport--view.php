<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   \Illuminate\Support\Facades\DB::statement('create view recreport as(
         SELECT rec."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", rec."NumeroRap",rec."Tube",rec."Observation"
         ,rec."Pid", rec."Did", Left(rec."Tube",1) "Machine", "Ntube" ,"Bis", "NumReception","Coulee","NumLot",rec."Longueur"/1000 "Longueur", Round( cast (float8 ((rec."Longueur"/1000)*d."PoidsMetrique")/1000  as numeric),3) "Poids"
          ,
         rec."User", raps."DateSaisie"
            FROM "reception" rec join "rapports" raps on rec."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=rec."Did"
    )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View recreport');
    }
}
