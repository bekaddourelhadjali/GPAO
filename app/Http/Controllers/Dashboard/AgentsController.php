<?php

namespace App\Http\Controllers\Dashboard;

use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Dashboard\Machines;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $locations=Locations::all()->sortBy("Zone");
        $agents=Agents::all();
        $machines=Machines::all();
        $target="agents";
        return view('Dashboard.Locations',["projet"=>$projet,
            "locations"=>$locations,
            "agents"=>$agents,
            "machines"=>$machines,
            "target"=>$target

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
        $agent=new Agents();
        $agent->NomPrenom=$request->NomPrenom;
        $agent->Code=Hash::make($request->Code);
        if($agent->save()){
            return response()->json(array('agent'=> $agent), 200);

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
        $agent=Agents::findOrFail($id);
        $agent->NomPrenom=$request->NomPrenom;
        if($request->Code!=""&&$request->Code!=null){
        $agent->Code=Hash::make($request->Code);
        }
        if($agent->save()){
            return response()->json(array('agent'=> $agent), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Agents::destroy($id)){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
