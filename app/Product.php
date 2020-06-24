<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{   public $timestamps=false;
    protected $fillable=['name','description','quantity','price','images'];


    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function sales(){
        return $this->belongsToMany('App\Sale');
    }
    public function avis(){
        return $this->hasMany('App\Avis');
    }
}
