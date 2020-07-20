<?php

namespace App\Http\Controllers\Reception;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\M24;
use App\Visuel\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecTubeController extends Controller
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
        $rec = new Reception();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $rec->NumTube = $tube->NumTube;
        $rec->Pid = $request->Pid;
        $rec->Did = $request->Did;
        $rec->NumeroRap = $request->NumeroRap;
        $rec->Ntube = $tube->NTube;
        $rec->Tube = $tube->Tube;
        $rec->Bis = $tube->Bis;
        $rec->Coulee = $request->Coulee;
        $rec->NumReception = $request->NumReception;
        $rec->Langueur = $request->Langueur;
        $rec->Observation = $request->Observation;
        $rec->Computer = gethostname();
        $rec->User = $rapport->NomAgents;
        $rec->DateSaisie = date('Y-m-d H:i:s');
        if ($rec->save()) {
            $tube->Z10 = true;
            $tube->save();
            if ($rec->Bis == "true") $rec->Bis_t = 'checked'; else $rec->Bis_t = "";
           
            return response()->json(array('rec' => $rec), 200);
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
            if ($rapport->Zone == 'Z10') {
                if ($rapport->Etat == 'N') {
                    $tubes = DB::select('select t."NumTube" ,t."Tube",t."Bis",t."Coulee" from "tube" t where "NumTube" not in (
                   select "NumTube" from "reception" r where r."Did"=?) and t."Did"=?',[$rapport->Did,$rapport->Did]);
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $maxNumRec=Reception::where('Did','=',$rapport->Did)->max('NumReception');
                    return view('Reception.RecTube',
                        ['rapport' => $rapport,
                            'maxNumRec'=>$maxNumRec+1,
                            'recTubes' => $rapport->recTubes,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_Reception.index'));
                }

            } else {
                return redirect(route('rapports_Reception.index'));
            }
        } else {
            return redirect(route('rapports_Reception.index'));
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
        $rec = Reception::find($id);
        $rec->Langueur = $request->Langueur;
        $rec->NumReception = $request->NumReception;
        $rec->Observation = $request->Observation;
        $rec->DateSaisie = date('Y-m-d H:i:s');
        if ($rec->save()) {
            if ($rec->Bis == "true") $rec->Bis_t = 'checked'; else $rec->Bis_t = "";
            return response()->json(array('rec' => $rec), 200);
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
        $rec = \App\Visuel\Reception::findOrFail($id);

        if ($rec->delete()) {
            $rec->tube->Z10 = false;
            $rec->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}