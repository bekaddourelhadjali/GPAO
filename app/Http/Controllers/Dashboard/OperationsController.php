<?php

namespace App\Http\Controllers\Dashboard;

use App\Dashboard\Machines;
use App\Visuel\Defauts;
use App\Visuel\Operations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('Dashboard.Defauts_Operations',["defauts"=>Defauts::all(),"operations"=>Operations::all()]);
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


        $operation=new Operations();
        $operation->Operation=$request->Operation;
        $operation->Type=$request->Type;
        $operation->Zone=$request->Zone;
        if($operation->save()){
            return response()->json(array('operation'=> $operation), 200);

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
        $operation=Operations::findOrFail($id);
        $operation->Operation=$request->Operation;
        $operation->Type=$request->Type;
        $operation->Zone=$request->Zone;
        if($operation->save()){
            return response()->json(array('operation'=> $operation), 200);

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

        if(Operations::destroy($id)){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
