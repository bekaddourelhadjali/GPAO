<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBobineDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('Create View BobineDetails as ( SELECT b."Did",b."Epaisseur",d."Diametre", b."Coulee",b."Bobine",b."Poids",
round (cast((b."Poids"/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))  as numeric),2) "langueur",
round (cast(((sum(t."Longueur")/1000)*(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000)) as numeric),2) "PoidsCons",
round(cast(sum(t."Longueur")/1000 as numeric),2) "LangCons" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" left join tube t on b."Did"=t."Did" and
    t."Bobine"=b."Bobine" and t."Coulee"=t."Coulee"  
group by b."Did",b."Epaisseur",d."Diametre", b."Coulee",b."Bobine",b."Poids")');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View BobineDetails');
    }
}
