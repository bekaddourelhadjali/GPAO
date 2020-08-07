<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListeglobaleView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view listeglobale as(
         SELECT rap."DateSaisie"::date "DateFab",t."NumTube" ,t."Tube",t."Bis",rap."Coulee",
         rap."Bobine",\'Mas\'||Left(t."Tube",1) "Machine",rap."Longueur" "LongFab"
,vis."Longueur" "LongVis", rec."NumReception",rec."Longueur" "LongueurRec",
exp."Longueur" "LongueurExp" ,exp."Poids" "PoidsExp"
,exp."NumExpedition" ,rec."DateSaisie"::date "DateRec" ,exp."DateExpedition",t."Did",
t."Z01",t."Z02",t."Z03",t."Z04",t."Z05",t."Z06",t."Z07",t."Z08",t."Z09",
t."Z10",t."Z11",t."Z12",t."Z13",t."Z14" 
FROM public.tube t left join "rapprod" rap on rap."NumTube"=t."NumTube" 
left join "visuels" vis  on t."NumTube"=vis."NumTube"  
left join "reception" rec on t."NumTube"=rec."NumTube"
left join "expedition" exp on t."NumTube"=exp."NumTube"  
order by rap."DateSaisie"::date,t."Tube",t."Bis",rap."Bobine",rap."Coulee" asc
 )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View listeglobale');
    }
}
