<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouleeDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view CouleeDetails as( select * , Case When q1."nbTest"<q1."TestDem" then \'Oui\' else \'Non\' end "BesoinTest",
  (sum(q1."PoidsTotal")/(((q1."Epaisseur")*pi()*7.85*((q1."Diametre"-q1."Epaisseur")))/1000)) "Lang" from
    (SELECT b."Did",b."Epaisseur",d."Diametre",b."Coulee" ,sum(b."Poids") "PoidsTotal",count(b."Test") filter (where  b."NumTest"=\'test1\' or b."NumTest"=\'test2\') "nbTest"
,count(b."Test") filter (where b."Test"=true  ) "nbTestTotal"
,CASE WHEN (sum(b."Poids")/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))>=575 THEN 2   ELSE 1 END "TestDem" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" and d."Did"=d."Did"
group by b."Coulee",b."Epaisseur",d."Diametre",b."Did",b."Poids")   q1 
group by q1."Coulee",q1."Epaisseur",q1."Diametre",q1."Did",q1."PoidsTotal",q1."nbTest",q1."TestDem",q1."nbTestTotal")');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View CouleeDetails');
    }
}
