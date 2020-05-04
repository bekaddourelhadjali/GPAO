<?php

namespace App\Http\Controllers\Fabrication;

use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapprodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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


        $rapprod = new Rapprod();
        $tube = new Tube();
        $rapprod->Pid = $request->Pid;
        $rapprod->Did = $request->Did;
        $rapprod->Bobine = $request->bobine;
        $rapprod->Coulee = $request->coulee;
        $rapprod->Machine = $request->machine;
        $rapprod->Tube = $rapprod->Machine . $request->ntube;
        $rapprod->Ntube = $request->ntube;
        $rapprod->IdOpr = 1;
        $rapprod->NbOpr = 1;
        $rapprod->NumeroRap = $request->NumeroRap;
        if ($request->bis) $rapprod->Bis = 1;
        else $rapprod->Bis = 0;
        $rapprod->Longueur = $request->longueur;
        if ($request->rb) $rapprod->RB = 1;
        else $rapprod->RB = 0;
        $rapprod->Macrd = $request->macrd;
        if ($request->sur_mas) $rapprod->Observation = $rapprod->Observation . "Sur Mas, ";
        if ($request->test_1) $rapprod->Observation = $rapprod->Observation . "Test (1), ";
        if ($request->test_2) $rapprod->Observation = $rapprod->Observation . "Test (2), ";
        if ($request->test_3) $rapprod->Observation = $rapprod->Observation . "Test (3), ";
        $rapprod->Observation = rtrim($rapprod->Observation, ', ');

        $tube->Pid = $request->Pid;
        $tube->Did = $request->Did;
        $tube->Machine = $request->machine;
        $tube->NTube = $request->ntube;
        $tube->Tube = $rapprod->Machine . $request->ntube;
        $tube->Longueur = $request->longueur;
        $tube->Bobine = $request->bobine;
        $tube->Coulee = $request->coulee;
        $tube->NumTube = $request->ntube;
        $tube->Bis = $rapprod->Bis;
        $tube->save();
        $rapprod->NumTube= $tube->NumTube;
        $rapprod->DateSaisie= date('Y-m-d H:i:s');
        if($rapprod->save()){
            return redirect(route('rapprod.show',['id'=>$request->NumeroRap]));
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
        $bobines = \App\Fabrication\Bobine::all('Bobine','Coulee');
        $rapport =\App\Fabrication\Rapport::find($id);
        $rapprods= $rapport->rapprods;
//            Rapprod::all('Numero','Tube','Coulee','Bobine','Bis','Longueur','Macro','RB','Observation');
        $projet = DB::select('SELECT * FROM 	public.projet WHERE "EndDate" >= CURRENT_DATE::date')[0];
        return view('fabrication.rapprod',
                ['rapport'=>$rapport,
                    'bobines'=>$bobines,
                    'rapprods'=>$rapprods,
                    'projet'=>$projet]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selectedRapprod = Rapprod::find($id);
        $bobines = \App\Fabrication\Bobine::all('Bobine','Coulee');
        $rapport =\App\Fabrication\Rapport::find($selectedRapprod->NumeroRap);
        $rapprods= $rapport->rapprods;
        $projet = DB::select('SELECT * FROM 	public.projet WHERE "EndDate" >= CURRENT_DATE::date')[0];
       return view('fabrication.rapprod',
                    ['rapport'=>$rapport,
                        'bobines'=>$bobines,
                        'rapprods'=>$rapprods,
                        'selectedRapprod'=>$selectedRapprod,
                        'projet'=>$projet]);
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
        $rapprod = Rapprod::findorFail($id);
        $rapprod->Bobine = $request->bobine;
        $rapprod->Coulee = $request->coulee;
        $rapprod->Machine = $request->machine;
        $rapprod->Tube = $rapprod->Machine . $request->ntube;
        $rapprod->Ntube = $request->ntube;
        if ($request->bis) $rapprod->Bis = 1;
        else $rapprod->Bis = 0;
        $rapprod->Longueur = $request->longueur;
        if ($request->rb) $rapprod->RB = 1;
        else $rapprod->RB = 0;
        $rapprod->Macrd = $request->macrd;
        $rapprod->Observation="";
        if ($request->sur_mas) $rapprod->Observation = $rapprod->Observation . "Sur Mas, ";
        if ($request->test_1) $rapprod->Observation = $rapprod->Observation . "Test (1), ";
        if ($request->test_2) $rapprod->Observation = $rapprod->Observation . "Test (2), ";
        if ($request->test_3) $rapprod->Observation = $rapprod->Observation . "Test (3), ";
        $rapprod->Observation = rtrim($rapprod->Observation, ', ');
        if($rapprod->save()){
            return redirect(route('rapprod.show',['id'=>$request->NumeroRap]));
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
        $rapprod=Rapprod::findOrFail($id);
        $NumeroRap=$rapprod->NumeroRap;
         if($rapprod->delete()){
             return redirect(route('rapprod.show',['id'=>$NumeroRap]));
         };
    }
}
