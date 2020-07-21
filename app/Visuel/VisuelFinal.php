<?php

namespace App\Visuel;

use Illuminate\Database\Eloquent\Model;

class VisuelFinal extends Model
{   public $timestamps=false;
    protected $table = "visuel_final";
    protected $primaryKey ='Id';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','CodeAgents','Etat']);
    }
    public function tube(){
        return $this->hasOne('App\Fabrication\Tube','NumTube','NumTube');
    }
    public function Defs(){
        return $this->hasMany('App\Visuel\DetailDefauts','NumVisuel','Id')->where("Zone","=","Z10")
            ->select(['id','Opr', 'IdDef', 'Defaut', 'Valeur', 'NbOpr', 'Nombre','Observation']);
    }
}
