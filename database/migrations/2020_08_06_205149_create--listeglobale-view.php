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
         SELECT t."Did",rap."Coulee",rap."Bobine", t."Tube",t."Z01",t."Z02",t."Z03",t."Z04",t."Z05",t."Z06",t."Z07",t."Z08",t."Z09",
t."Z10",t."Z11",t."Z12",t."Z13",t."Z14" 
,t."Bis",\'Mas \'||Left(t."Tube",1) "Machine",rap."Longueur" "LongFab",rap."DateSaisie" "DateFab"
,vis."Longueur" "LongVis",vis."DateSaisie" "DateVis",vis."ObsMetal"||\' // \'||vis."ObsSoudure" "VisDefauts",
rx1."Defauts" "DefautsRX1",rx1."DateSaisie" "DateRX1",
rep."Defauts" "DefautsRep",rep."DateSaisie" "DateRep",
m17."LongCh",m17."Defauts" "DefautsM17",m17."DateSaisie" "DateM17"
,m24."Pression" ,m24."DateSaisie" "DateM24" 
,rx2."Defauts" "DefautsRX2",rx2."DateSaisie" "DateRX2"
,vf."Longueur" "LongueurVF",vf."ChanfreinD",vf."ChanfreinF",vf."Defauts" "DefautsVF",vf."DateSaisie" "DateVF"
,vfr."Defauts" "DefautsVFR",vfr."DateSaisie" "DateVFR"
,rec."Longueur" ,rec."NumReception",rec."DateSaisie" "DateRec"
,revint."Longueur"  "LongueurRI",revint."Accepte" "AccepteI",revint."DateSaisie" "DateRevInt" 
,revext."Longueur"  "LongueurRE",revext."Accepte" "AccepteE",revext."DateSaisie" "DateRevExt" 
,exp."Longueur" "LongueurExp" ,exp."Poids" "PoidsExp",exp."NumExpedition",exp."DateExpedition"  
FROM public.tube t left join "rapprod" rap on rap."NumTube"=t."NumTube" 
left join "visuels" vis  on t."NumTube"=vis."NumTube" 
left join "rx1" rx1 on t."NumTube"=rx1."NumTube"
left join "reparation" rep on t."NumTube"=rep."NumTube"
left join "m17" m17 on t."NumTube"=m17."NumTube"
left join "m24" m24 on t."NumTube"=m24."NumTube"  
left join "rx2" rx2 on t."NumTube"=rx2."NumTube"
left join "visuel_final" vf on t."NumTube"=vf."NumTube"
left join "vf_refuses" vfr on t."NumTube"=vfr."NumTube"
left join "reception" rec on t."NumTube"=rec."NumTube"
left join "rev_int" revint on t."NumTube"=revint."NumTube"
left join "rev_ext" revext on t."NumTube"=revext."NumTube"
left join "expedition" exp on t."NumTube"=exp."NumTube"
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
