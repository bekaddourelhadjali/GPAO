<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bobine extends Model
{   public $timestamps=false;
    protected $table = "bobine";
    protected $fillable =['Pid','Did','Bobine','Coulee','Poids','CodeFournis'];
    protected $primaryKey="Id";
}
