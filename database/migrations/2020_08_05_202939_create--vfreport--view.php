<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVfreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view vfreport as(
         SELECT v."Id",d."Diametre",d."Epaisseur" ,raps."Poste",raps."Etat", v."NumeroRap",v."Tube",v."Observation"
         ,v."Pid", v."Did", Left(v."Tube",1) "Machine", "Ntube" ,"Bis",
		 "Ovalisation","OrthogonaliteD","OrthogonaliteF","Rectitude","ChanfreinD","ChanfreinF",
		 Round( cast(("EpaisseurD"+"EpaisseurC"+"EpaisseurF")/3 as numeric),3) "EpaisseurM",
		 Round( cast(("DiametreD"+"DiametreC"+"DiametreF")/3 as numeric),3) "DiametreM" ,"Defauts"
		 ,v."Longueur"/1000 "Longueur",
         v."User", raps."DateSaisie"
            FROM "visuel_final" v join "rapports" raps on v."NumeroRap"=raps."Numero" join "detailprojet" d on d."Did"=v."Did")'
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View vfreport');
    }
}
