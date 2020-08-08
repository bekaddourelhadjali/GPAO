<?php

namespace App\Http\Controllers\Dashboard;

use App\Dashboard\Affectations;
use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Dashboard\Machines;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations=Locations::all()->sortBy("Zone");
        $agents=Agents::all();
        $target="locations";
        return view('Dashboard.Locations',[
            "locations"=>$locations,
            "agents"=>$agents,
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
        $location=new Locations();
        $location->Designation=$request->Designation;
        $location->Zone=$request->Zone;
        $location->AdresseIp=$request->IPAddress;
        if($location->save()){
            return response()->json(array('location'=> $location), 200);

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
        $location=Locations::findOrFail($id);
        $location->Designation=$request->Designation;
        $location->Zone=$request->Zone;
        $location->AdresseIp=$request->IPAddress;
        if($location->save()){
            return response()->json(array('location'=> $location), 200);

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
    {   $location=Locations::find($id);
        Affectations::where('AdresseIp',$location->AdresseIp)->where("Zone",'=',$location->Zone)->delete();
        if($location->delete()){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
