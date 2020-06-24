<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class avis extends Model
{
    protected $fillable=['text','user_id','product_id'];
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
