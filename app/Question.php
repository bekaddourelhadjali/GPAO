<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $fillable=['subject','text'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function responses(){
        return $this->hasMany('App\Response');
    }
}
