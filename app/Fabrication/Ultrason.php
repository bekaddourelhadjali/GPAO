<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class Ultrason extends Model
{   public $timestamps=false;
    protected $table = "ultrason";
    protected $primaryKey ='Id';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','Etat']);
    }
    public function tube(){
        return $this->hasOne('App\Fabrication\Tube','NumTube','NumTube');
    }
}
