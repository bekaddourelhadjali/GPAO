<?php

namespace App\Fabrication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bobine extends Model
{   public $timestamps=false;
    protected $table = "bobine";
    protected $fillable =['Pid','Did','Bobine','Coulee','Poids','CodeFournis'];
    protected $primaryKey=null;
    public function insertBobine(){
        return DB::table('bobine')->insert(
                                                    ["Pid"=>$this->Pid
                                                    ,"Did"=>$this->Did
                                                    ,"Bobine"=>$this->Bobine
                                                    ,"Coulee"=>$this->Coulee
                                                    ,"Poids"=>$this->Poids
                                                    ,"CodeFournis"=>$this->CodeFournis]);
    }
}
