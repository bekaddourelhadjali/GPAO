<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{   public $timestamps=false;
    protected $table = "tube";
    protected $primaryKey = "NumTube";
    public function rapprod(){
        return $this->belongsTo('App\Fabrication\Rapprod','NTube','NumTube')->select(['Numero','Tube','Coulee','Bobine','Bis','Longueur','Macrd','RB','Observation']);
    }
}
