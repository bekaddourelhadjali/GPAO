<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{   public $timestamps=false;
    protected $table = "tube";
    protected $primaryKey = "NumTube";
    public function rapprod(){
        return $this->hasOne('App\Fabrication\Rapprod','NumTube','NumTube')->select(['Numero','Tube','Coulee','Bobine','Bis','Longueur','macro','RB','Observation']);
    }
    public function visuels(){
        return $this->hasMany('App\Visuel\Visuels','NumTube','NumTube') ;
    }
    public function RX1(){
        return $this->hasMany('App\Visuel\RX1','NumTube','NumTube');
    }
    public function Reparation(){
        return $this->hasMany('App\Visuel\Rep','NumTube','NumTube');
    }
    public function M17(){
        return $this->hasMany('App\Visuel\M17','NumTube','NumTube');
    }
    public function M24(){
        return $this->hasMany('App\Visuel\M24','NumTube','NumTube');
    }
    public function M25(){
        return $this->hasMany('App\Visuel\M25','NumTube','NumTube');
    }
    public function NDT(){
        return $this->hasMany('App\Visuel\NDT','NumTube','NumTube');
    }
    public function RX2(){
        return $this->hasMany('App\Visuel\RX2','NumTube','NumTube');
    }
    public function VisuelFinal(){
        return $this->hasMany('App\Visuel\VisuelFinal','NumTube','NumTube');
    }
    public function VFRefuses(){
        return $this->hasOne('App\Visuel\VFRefuses','NumTube','NumTube');
    }
    public function Reception(){
        return $this->hasOne('App\Visuel\Reception','NumTube','NumTube');
    }
    public function RevInt(){
        return $this->hasMany('App\Visuel\RevInt','NumTube','NumTube');
    }
    public function RevExt(){
        return $this->hasMany('App\Visuel\RevExt','NumTube','NumTube');
    }
    public function Expedition(){
        return $this->hasOne('App\Visuel\Expedition','NumTube','NumTube');
    }

}
