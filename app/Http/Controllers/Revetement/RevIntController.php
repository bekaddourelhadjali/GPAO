<?php

namespace App\Http\Controllers\Revetement;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\Defauts;
use App\Visuel\M24;
use App\Visuel\Operations;
use App\Visuel\RevInt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RevIntController extends Controller
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
        $revInt = new RevInt();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $revInt->NumTube = $tube->NumTube;
        $revInt->Pid = $request->Pid;
        $revInt->Did = $request->Did;
        $revInt->NumeroRap = $request->NumeroRap;
        $revInt->Ntube = $tube->NTube;
        $revInt->Tube = $tube->Tube;
        $revInt->Bis = $tube->Bis;
        $revInt->Longueur = $request->Longueur;
        $revInt->NumReception = $request->NumReception;
        $revInt->Aspect = $request->Aspect;
        $revInt->Accepte = $request->Accepte;
        $revInt->Observation = $request->Observation;
        $revInt->Computer = gethostname();
        $revInt->User = $rapport->NomAgents;
        $revInt->DateSaisie = date('Y-m-d H:i:s');
        if ($revInt->save()) {
            $tube->Z12 = true;
            $tube->save();
            if ($revInt->Bis == "true") $revInt->Bis_t = 'checked'; else $revInt->Bis_t = "";
           
            return response()->json(array('revInt' => $revInt), 200);
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
            if ($rapport->Zone == 'Z12') {
                if ($rapport->Etat == 'N') {
                    $tubes = DB::select('select r."NumTube",r."Tube",r."Bis",r."NumReception" from "reception" r where
r."Did"=? and r."NumReception" not in (select ri."NumReception" from "rev_int" ri
						  where ri."Did"=? and ri."Accepte"=true ) ',[$rapport->Did,$rapport->Did]);
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    $defauts=Operations::where('Zone','=','Z11')->select('Operation')->get();
                    return view('Revetement.RevInt',
                        ['rapport' => $rapport,
                            'revInt' => $rapport->revInt,
                            'detailP' => $detailP,
                            'details' => $details,
                            'tubes' => $tubes,
                            'defauts' => $defauts,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_RevInt.index'));
                }

            } else {
                return redirect(route('rapports_RevInt.index'));
            }
        } else {
            return redirect(route('rapports_RevInt.index'));
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
        $revInt = RevInt::find($id);
        $revInt->Longueur = $request->Longueur;
        $revInt->Aspect = $request->Aspect;
        $revInt->Accepte = $request->Accepte;
        $revInt->Observation = $request->Observation;
        $revInt->DateSaisie = date('Y-m-d H:i:s');
        if ($revInt->save()) {
            if ($revInt->Bis == "true") $revInt->Bis_t = 'checked'; else $revInt->Bis_t = "";
            return response()->json(array('revInt' => $revInt), 200);
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
        $revInt = \App\Visuel\RevInt::findOrFail($id);

        if ($revInt->delete()) {
            $revInt->tube->Z12= false;
            $revInt->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
