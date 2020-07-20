<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{   public $timestamps=false;
    protected $table = "rapports";
    protected $primaryKey = 'Numero';
    protected $fillable =['Numero','Pid','Did','DateRapport','Equipe','Machine','Poste','NomAgents','CodeAgent'];
    public function details(){
        return $this->belongsTo('App\Fabrication\detailprojet', 'Did');
    }
    public function Project(){
        return $this->belongsTo('App\Fabrication\Projet','Pid');
    }
    public function rapprods(){
        return $this->hasMany('App\Fabrication\Rapprod','NumeroRap')
            ->select(['Numero','Ntube','Coulee','Bobine','Longueur','Macro','RB','Observation']);
    }
    public function ultrasons(){
        return $this->hasMany('App\Fabrication\Ultrason','NumeroRap') ;
    }
    public function visuels(){
        return $this->hasMany('App\Visuel\Visuels','NumeroRap') ;
    }
    public function rx1(){
        return $this->hasMany('App\Visuel\RX1','NumeroRap') ;
    }
    public function m3(){
        return $this->hasMany('App\Fabrication\M3','NumeroRap') ;
    }
    public function m17(){
        return $this->hasMany('App\Visuel\M17','NumeroRap') ;
    }
    public function m24(){
        return $this->hasMany('App\Visuel\M24','NumeroRap') ;
    }
    public function m25(){
        return $this->hasMany('App\Visuel\M25','NumeroRap') ;
    }
    public function ndt(){
        return $this->hasMany('App\Visuel\Ndt','NumeroRap') ;
    }
    public function rx2(){
        return $this->hasMany('App\Visuel\RX2','NumeroRap') ;
    }
    public function recTubes(){
        return $this->hasMany('App\Visuel\Reception','NumeroRap') ;
    }
    public function revInt(){
        return $this->hasMany('App\Visuel\RevInt','NumeroRap') ;
    }
    public function revExt(){
        return $this->hasMany('App\Visuel\RevExt','NumeroRap') ;
    }
    public function Expedition(){
        return $this->hasMany('App\Visuel\Expedition','NumeroRap') ;
    }
    public function RecBob(){
        return $this->hasMany('App\Fabrication\Bobine','NumeroRap') ;
    }
    public function Reparations(){
        return $this->hasMany('App\Visuel\Rep','NumeroRap') ;
    }
    public function arrets(){
        return $this->hasMany('App\Fabrication\ArretMachine','NumRap');
    }
    public function operateurs(){
        return $this->hasMany('App\Fabrication\Operateur','NumRap');
    }
}
