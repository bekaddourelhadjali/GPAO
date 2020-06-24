<?php

namespace App\Http\Controllers\Dashboard;

use App\Dashboard\Affectations;
use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Dashboard\Machines;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AffectationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $locations=Locations::orderBy("Zone")->paginate(5);
        $agents=Agents::all();
        $machines=Machines::all();
        return view('Dashboard.affectations',["projet"=>$projet,
                        "locations"=>$locations,
                        "agents"=>$agents,
                        "machines"=>$machines

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $affectation=new Affectations();
        $affectation->AdresseIp=$request->AdresseIp;
        $affectation->idMachine=$request->idMachine;
        $affectation->idAgent=$request->idAgent;
        if($affectation->save()){
            if($affectation->idMachine!=null){
                $machine=Machines::find($affectation->idMachine);
                     return response()->json(array('machine'=> $machine), 200);
            }else if( $affectation->idAgent!=null){
                $agent=Agents::find($affectation->idAgent);
                    return response()->json(array('agent'=> $agent), 200);
            }
        }else{
            return response()->json(array('error'=> error), 404);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request){
        $res=Affectations::where("AdresseIp",$request->AdresseIp)->where("idMachine",$request->idMachine)->
        where("idAgent",$request->idAgent)->delete();
        if($res){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
