<?php

namespace App\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Locations extends Model
{
    public $timestamps=false;
    protected $table = "Locations";
    public function agents(){
//        return $this->belongsToMany('App\Dashboard\Agents',"Affectations",
//            "AdresseIp","idAgent","AdresseIp");
        return DB::select('select a."id",a."NomPrenom" from "agents" a join "Affectations" aff on a."id"=aff."idAgent"
                where aff."AdresseIp"=? and aff."Zone"=?',[$this->AdresseIp,$this->Zone]);
    }
}
