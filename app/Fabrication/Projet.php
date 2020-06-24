<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projet extends Model
{   public $timestamps=false;
    protected $table = "projet";
    protected $primaryKey='Pid';
    public function client(){
        return $this->hasOne('App\Fabrication\Client','id','Customer');
    }
    public function details(){
        return $this->hasMany('App\Fabrication\detailprojet','Pid','Pid');
    }
}
