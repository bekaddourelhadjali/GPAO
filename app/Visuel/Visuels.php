<?php

namespace App\Visuel;

use Illuminate\Database\Eloquent\Model;

class Visuels extends Model
{   public $timestamps=false;
    protected $table = "visuels";
    protected $primaryKey ='Numero';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','CodeAgents','Etat']);
    }
    public function tube(){
        return $this->hasOne('App\Fabrication\Tube','NumTube','NumTube');
    }
    public function Defauts(){
        return $this->hasMany('App\Visuel\DetailDefauts','NumVisuel','Numero')->where("Zone","=","Z02")->get();
    }
}
