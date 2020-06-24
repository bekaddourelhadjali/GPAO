<?php

namespace App\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    public $timestamps=false;
    protected $table = "Locations";
    public function machines(){
        return $this->belongsToMany('App\Dashboard\Machines',"Affectations",
            "AdresseIp","idMachine","AdresseIp");
    }
    public function agents(){
        return $this->belongsToMany('App\Dashboard\Agents',"Affectations",
            "AdresseIp","idAgent","AdresseIp");
    }
}
