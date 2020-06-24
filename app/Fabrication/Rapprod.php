<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class Rapprod extends Model
{   public $timestamps=false;
    protected $table = "rapprod";
    protected $primaryKey ='Numero';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','Etat']);
    }
    public function tube(){
        return $this->hasOne('App\Fabrication\Tube','NumTube','NumTube');
    }
}
