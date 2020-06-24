<?php

namespace App\Http\Controllers\Fabrication;

use App\Fabrication\ArretMachine;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ArretMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
        $arret_machine=new ArretMachine();
        $arret_machine->Pid=$request->Pid;
        $arret_machine->Did=$request->Did;
        $arret_machine->NumRap=$request->NumRap;
        $arret_machine->Machine=$request->Machine;
        $arret_machine->TypeArret=$request->type_arret;
        $arret_machine->Du=$request->du;
        $arret_machine->Au=$request->au;
        $arret_machine->Durée=$request->duree;
        $arret_machine->Cause=$request->cause;
        $arret_machine->NDI=$request->ndi;
        $arret_machine->Obs=$request->obs;
        $arret_machine->Relv_Compt=$request->relv;
//        if($arret_machine->save()){
//            return redirect(route('arret_machine.show',['id'=>$request->NumRap]));
//        }
        if ($arret_machine->save()){
        return response()->json(array('arret'=> $arret_machine), 200);

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
        $rapport =  Rapport::findOrFail($id);
        $projet= \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $arrets=$rapport->arrets;
        $operateurs= $rapport->operateurs;
        return view('Fabrication.arret_machine',['rapport'=>$rapport,'projet'=>$projet,'arrets'=>$arrets,'operateurs'=>$operateurs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selectedArret = ArretMachine::findOrFail($id);
        $rapport =  Rapport::findOrFail($selectedArret->NumRap);
        $projet= \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $arrets=$rapport->arrets;
        $operateurs= $rapport->operateurs;
        return view('Fabrication.arret_machine',
            ['rapport'=>$rapport
                ,'projet'=>$projet
                ,'arrets'=>$arrets
                ,'selectedArret'=>$selectedArret
                ,'operateurs'=>$operateurs
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $arret_machine= ArretMachine::find($id);
        $arret_machine->Pid=$request->Pid;
        $arret_machine->Did=$request->Did;
        $arret_machine->NumRap=$request->NumRap;
        $arret_machine->Machine=$request->Machine;
        $arret_machine->TypeArret=$request->type_arret;
        $arret_machine->Du=$request->du;
        $arret_machine->Au=$request->au;
        $arret_machine->Durée=$request->duree;
        $arret_machine->Cause=$request->cause;
        $arret_machine->NDI=$request->ndi;
        $arret_machine->Obs=$request->obs;
        $arret_machine->Relv_Compt=$request->relv;

        if ($arret_machine->save()){
            return response()->json(array('arret'=> $arret_machine), 200);

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
        $arret=ArretMachine::findOrFail($id);
        if ($arret->delete()){
            return response()->json(array('success'=> true), 200);

        }else{
            return response()->json(array('error'=> true), 404);
        }
    }
}
