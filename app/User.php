<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','daten','address','phone','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function questions(){
        return $this->hasMany('App\Question');
    }
    public function responses(){
        return $this->hasMany('App\Response');
    }
    public function sales(){
        return $this->belongsToMany('App\Sale');
    }
    public function avis(){
        return $this->belongsToMany('App\Avis');
    }
}











































































