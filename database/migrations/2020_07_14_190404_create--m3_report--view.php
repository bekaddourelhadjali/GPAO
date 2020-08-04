<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateM3ReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view M3Report as( select m."Id", b."Etat",d."Did",d."Pid",d."Diametre",b."Arrivage",b."Epaisseur",b."Coulee",b."Bobine",b."Poids",b."LargeurBande",r."DateSaisie"
	 , m."DDB", m."DDB_R", m."FT", m."GB_MB", m."Test1",m."Observation",r."User",r."Poste",r."Etat" "rapEtat",m."NumeroRap",(m."ChutesT"+m."ChutesQ")/1000 "Chutes",
	ROUND(CAST (float8 (((m."LargeurD"+m."LargeurF")/2)/1000) as numeric),3) "LargeMoy" ,
	ROUND(CAST (float8 ((m."EpaisseurD"+m."EpaisseurC"+m."EpaisseurF")/3)  as numeric),3) "EpMoy"

FROM public.m3 m join "bobine" b on m."IdBobine"=b."Id" join "rapports" r on m."NumeroRap" =r."Numero" 
join "detailprojet" d on d."Did"=b."Did"   
)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View M3Report');
    }
}
