<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{   public $timestamps=false;
    protected $table = "client";

}
