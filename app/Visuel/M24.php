<?php

namespace App\Visuel;

use Illuminate\Database\Eloquent\Model;

class M24 extends Model
{   public $timestamps=false;
    protected $table = "m24";
    protected $primaryKey ='Id';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','CodeAgents','Etat']);
    }
    public function tube(){
        return $this->hasOne('App\Fabrication\Tube','NumTube','NumTube');
    }
}
