<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisuelreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view visuelreport as(
         SELECT v."Numero",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", v."NumeroRap",v."Tube",v."Observation"
         ,v."Pid", v."Did", v."Machine", "Ntube" ,"Bis","Sond","E","Y","EY","RB",v."Longueur"
         ,"ObsSoudure","ObsMetal","DiamD","DiamF" ,
         v."User", v."DateSaisie"
            FROM "visuels" v join "rapports" raps on v."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=v."Did"
    )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View visuelreport');
           }
}
