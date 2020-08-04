<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefautsreportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('create view defautsreport as( 
        select d.*,r."Poste",r."Machine" "RMachine",r."User",r."Etat",r."DateSaisie"
         from "detailDef" d join "rapports" r on d."NumRap"=r."Numero" )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    \Illuminate\Support\Facades\DB::statement('Drop View defautsreport');
    }
}
