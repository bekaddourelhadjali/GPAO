<?php

namespace App\Http\Controllers\Fabrication;

use App\Fabrication\Bobine;
use App\Fabrication\M3;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasEPrepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {return redirect(route('rapports.index'));

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
    {    $bobine = Bobine::where("Bobine", '=', $request->bobine)->where('Coulee', '=', $request->coulee)->first();
         $m3=new M3();
         $m3->IdBobine=$bobine->Id;
         $m3->LargeurD= $request->LargeurD;
         $m3->LargeurF= $request->LargeurF;
         $m3->EpaisseurD= $request->EpaisseurD;
         $m3->EpaisseurC= $request->EpaisseurC;
         $m3->EpaisseurF= $request->EpaisseurF;
         $m3->DDB= ($request->DDB ? true :false);
         $m3->DDB_R= ($request->DDB_R ? true :false);
         $m3->FT= ($request->FT ? true :false);
         $m3->GB_MB= ($request->GB_MB ? true :false);
         $m3->Test1= ($request->Test1 ? true :false);
         $m3->ChutesT= $request->ChutesT;
         $m3->ChutesQ= $request->ChutesQ;
         $m3->NumeroRap= $request->NumRap;
         $m3->Observation= $request->observation;
         $m3->Computer= gethostname();
         $m3->DateSaisie= date('Y-m-d H:i:s');
        if ($m3->save()) {
            $bobine->Etat='MasEPrep';
            $bobine->save();
            $m3->BobineT=$m3->Bobine->Bobine;
            $m3->CouleeT=$m3->Bobine->Coulee;
            $m3->PoidsT=$m3->Bobine->Poids;
            if($m3->DDB) $m3->DDB_t='checked'; else $m3->DDB_t='';
            if($m3->DDB_R) $m3->DDB_R_t='checked'; else $m3->DDB_R_t='';
            if($m3->FT) $m3->FT_t='checked'; else $m3->FT_t='';
            if($m3->GB_MB) $m3->GB_MB_t='checked'; else $m3->GB_MB_t='';
            if($m3->Test1) $m3->Test1_t='checked'; else $m3->Test1_t='';
            $bobines = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Bobine')->get();
            $coulees = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Coulee')->distinct('Coulee')->get();
            return response()->json(array('m3' => $m3,"bobines"=>$bobines,"coulees"=>$coulees), 200);
        } else {
            return response()->json(array('error' => error), 404);
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
        $rapport =\App\Fabrication\Rapport::find($id);
        if($rapport!=null) {
        if($rapport->Zone=='Z01'&&$rapport->Machine=="E"){
                $bobines = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Bobine')->get();
                $coulees = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Coulee')->distinct('Coulee')->get();
                if($rapport->Etat=='N'){
                    $rapprods= $rapport->rapprods;
                     return view('Fabrication.MasEPrep',
                        ['rapport'=>$rapport,
                            'bobines'=>$bobines,
                            'coulees'=>$coulees,
                            'M3s'=>$rapport->m3]);
                }elseif($rapport->Etat=='C'){
                    return redirect(route('rapports.index'));
                }
            }else{
                return redirect(route('rapports.index'));
            }
        }else{
            return redirect(route('rapports.index'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bobines = Bobine::where('NbReception', '=', null)->where('Did', '=', $id)->select('Bobine')->get();
        $coulees = Bobine::where('NbReception', '=', null)->where('Did', '=', $id)->select('Coulee')->distinct('Coulee')->get();
        return response()->json(array('bobines' => $bobines, 'coulees' => $coulees), 200);
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

        $m3=M3::find($id);
        $m3->LargeurD= $request->LargeurD;
        $m3->LargeurF= $request->LargeurF;
        $m3->EpaisseurD= $request->EpaisseurD;
        $m3->EpaisseurC= $request->EpaisseurC;
        $m3->EpaisseurF= $request->EpaisseurF;
        $m3->DDB= ($request->DDB ? true :false);
        $m3->DDB_R= ($request->DDB_R ? true :false);
        $m3->FT= ($request->FT ? true :false);
        $m3->GB_MB= ($request->GB_MB ? true :false);
        $m3->Test1= ($request->Test1 ? true :false);
        $m3->ChutesT= $request->ChutesT;
        $m3->ChutesQ= $request->ChutesQ;
        $m3->Observation= $request->observation;
        if ($m3->save()) {
            $m3->BobineT=$m3->Bobine->Bobine;
            $m3->CouleeT=$m3->Bobine->Coulee;
            $m3->PoidsT=$m3->Bobine->Poids;
            if($m3->DDB) $m3->DDB_t='checked'; else $m3->DDB_t='';
            if($m3->DDB_R) $m3->DDB_R_t='checked'; else $m3->DDB_R_t='';
            if($m3->FT) $m3->FT_t='checked'; else $m3->FT_t='';
            if($m3->GB_MB) $m3->GB_MB_t='checked'; else $m3->GB_MB_t='';
            if($m3->Test1) $m3->Test1_t='checked'; else $m3->Test1_t='';
            return response()->json(array('m3' => $m3), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    $m3=M3::find($id);
        if ($m3->delete()) {
            if($m3->Bobine->NbReception!=null)
            $m3->Bobine->Etat='REC';
            else $m3->Bobine->Etat='MasE';
            $m3->Bobine->save();
            $m3->Bobine;
            $bobines = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Bobine')->get();
            $coulees = Bobine::where('Etat','=','MasE')->orWhere('Etat','=','REC')->select('Coulee')->distinct('Coulee')->get();
            return response()->json(array('success' => true,"bobines"=>$bobines,"coulees"=>$coulees), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }
}
