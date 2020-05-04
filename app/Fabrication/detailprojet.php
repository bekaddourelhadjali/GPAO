<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;

class detailprojet extends Model
{
    protected $primaryKey = 'Did';
    protected $table = "detailprojet";
    public function rapports(){
        return $this->hasMany('App\Fabrication\Rapport');
    }
}
