<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecBobReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('Create View RecBobReport as (select p."Nom",d."Did",d."Diametre",d."Epaisseur","DateRec","Arrivage","LargeurBande","Fournisseur","Source",count(*) "NbTotal",sum("Poids") "PoidsTotal"
from "bobine" b join "detailprojet" d on b."Did"=d."Did" join "projet" p  on d."Pid"=p."Pid" where "DateRec" is not null group by p."Nom",d."Did",d."Diametre",d."Epaisseur","DateRec","Arrivage","LargeurBande","Fournisseur","Source" order by "DateRec" desc  )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('Drop View RecBobReport');
    }
}
