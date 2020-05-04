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
    public function currentProject(){
        return DB::select('select * from projet where EndDate> now()');
    }
    public function rapprods(){
        return $this->hasMany('App\Fabrication\Rapprod','NumeroRap')
            ->select(['Numero','Tube','Coulee','Bobine','Bis','Longueur','Macrd','RB','Observation']);
    }
    public function arrets(){
        return $this->hasMany('App\Fabrication\ArretMachine','NumRap')
            ->select(['id','TypeArret','Du','Au','Durée','Cause','NDI','Obs','Relv_Compt']);
    }
    public function operateurs(){
        return $this->hasMany('App\Fabrication\Operateur','NumRap');
    }
}
