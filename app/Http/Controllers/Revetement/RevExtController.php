<?php

namespace App\Http\Controllers\Revetement;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\Defauts;
use App\Visuel\M24;
use App\Visuel\Operations;
use App\Visuel\RevExt;
use App\Visuel\RevInt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RevExtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $revExt = new RevExt();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $revExt->NumTube = $tube->NumTube;
        $revExt->Pid = $request->Pid;
        $revExt->Did = $request->Did;
        $revExt->NumeroRap = $request->NumeroRap;
        $revExt->Ntube = $tube->NTube;
        $revExt->Tube = $tube->Tube;
        $revExt->Bis = $tube->Bis;
        $revExt->Longueur = $request->Longueur;
        $revExt->NumReception = $request->NumReception;
        $revExt->Aspect = $request->Aspect;
        $revExt->Accepte = $request->Accepte;
        $revExt->Observation = $request->Observation;
        $revExt->Computer = gethostname();
        $revExt->User = $rapport->NomAgents;
        $revExt->DateSaisie = date('Y-m-d H:i:s');
        if ($revExt->save()) {
            $tube->Z13 = true;
            $tube->save();
            if ($revExt->Bis == "true") $revExt->Bis_t = 'checked'; else $revExt->Bis_t = "";
           
            return response()->json(array('revExt' => $revExt), 200);
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
        $rapport = \App\Fabrication\Rapport::find($id);
        if ($rapport != null) {
            if ($rapport->Zone == 'Z13') {
                if ($rapport->Etat == 'N') {
                    $tubes = DB::select('select r."NumTube",r."Tube",r."Bis",r."NumReception" from "reception" r where
r."Did"=? and r."NumReception" not in (select re."NumReception" from "rev_ext" re
						  where re."Did"=? and re."Accepte"=true ) ',[$rapport->Did,$rapport->Did]);
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];

                    $defauts=Operations::where('Zone','=','Z12')->select('Operation')->get();
                    return view('Revetement.RevExt',
                        ['rapport' => $rapport,
                            'revExt' => $rapport->revExt,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'defauts' => $defauts,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_RevExt.index'));
                }

            } else {
                return redirect(route('rapports_RevExt.index'));
            }
        } else {
            return redirect(route('rapports_RevExt.index'));
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
        $revExt = RevExt::find($id);
        $revExt->Longueur = $request->Longueur;
        $revExt->Aspect = $request->Aspect;
        $revExt->Accepte = $request->Accepte;
        $revExt->Observation = $request->Observation;
        $revExt->DateSaisie = date('Y-m-d H:i:s');
        if ($revExt->save()) {
            if ($revExt->Bis == "true") $revExt->Bis_t = 'checked'; else $revExt->Bis_t = "";
            return response()->json(array('revExt' => $revExt), 200);
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
    {
        $revExt = \App\Visuel\RevExt::findOrFail($id);

        if ($revExt->delete()) {
            $revExt->tube->Z13 = false;
            $revExt->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
