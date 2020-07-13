<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class M3 extends Model
{   public $timestamps=false;
    protected $table = "m3";
    protected $primaryKey ='Id';
    public function rapport(){
        return $this->belongsTo('App\Fabrication\Rapport','NumeroRap' )->select(['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','Etat']);
    }
    public function Bobine(){
        return $this->hasOne('App\Fabrication\Bobine','Id','IdBobine');
    }
}
