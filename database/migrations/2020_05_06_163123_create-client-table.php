<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->unique();
            $table->string('address',50)->nullable();
            $table->string('city',10)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('state',10)->nullable();
            $table->string('country',10)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('web_url',40)->nullable();
            $table->string('comment',100)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
