<?php

namespace App\Http\Controllers\Dashboard;

use App\Dashboard\Machines;
use App\Visuel\Defauts;
use App\Visuel\Operations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefautsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Dashboard.Defauts_Operations',
            ["defauts"=>Defauts::all()->sortBy("Zone"),"operations"=>Operations::all()->sortBy("Zone")]);
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

        $defaut=new Defauts();
        $defaut->Defaut=$request->Defaut;
        $defaut->Type=$request->Type;
        $defaut->Zone=$request->Zone;
        if($defaut->save()){
            return response()->json(array('defaut'=> $defaut), 200);

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
        $defaut=Defauts::findOrFail($id);
        $defaut->Defaut=$request->Defaut;
        $defaut->Type=$request->Type;
        $defaut->Zone=$request->Zone;
        if($defaut->save()){
            return response()->json(array('defaut'=> $defaut), 200);

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
        if(Defauts::destroy($id)){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
