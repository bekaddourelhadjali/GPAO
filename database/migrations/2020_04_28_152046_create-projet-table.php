<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet', function (Blueprint $table) {
            $table->increments('Pid');
            $table->string('Nom', 25)->unique();
            $table->date('StartDate');
            $table->date('EndDate');
            $table->char('Etat',1)->nullable();
            $table->text('OrderNo')->nullable();
            $table->text('Comments')->nullable();
            $table->date('CompletedDate')->nullable();
            $table->integer('Customer');
            $table->index([\Illuminate\Support\Facades\DB::raw('(ARRAY["Etat"])')], 'Etat_index')->algorithm('btree');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet');
    }
}
