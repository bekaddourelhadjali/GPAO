<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{   public $timestamps=false;
    protected $fillable=['name'];
    public function products(){
        return $this->hasMany('App\Product');
    }

}
