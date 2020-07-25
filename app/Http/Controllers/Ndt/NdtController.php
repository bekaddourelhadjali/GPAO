<?php

namespace App\Http\Controllers\Ndt;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\Ndt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NdtController extends Controller
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
        $ndt = new Ndt();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $ndt->NumTube = $tube->NumTube;
        $ndt->Pid = $request->Pid;
        $ndt->Did = $request->Did;
        $ndt->NumeroRap = $request->NumeroRap;
        $ndt->Machine = $tube->Machine;
        $ndt->Ntube = $tube->NTube;
        $ndt->Tube = $tube->Tube;
        $ndt->Bis = $tube->Bis;
        $ndt->Snup = $request->Snup;
        $ndt->OPR = $request->OPR;
        $ndt->Repd = $request->Repd;
        $ndt->Repg = $request->Repg;
        $ndt->Observation = $request->Observation;
        $ndt->Computer = gethostname();
        $ndt->User = $rapport->NomAgents;
        $ndt->DateSaisie = date('Y-m-d H:i:s');
        if ($ndt->save()) {
            $tube->Z08 = true;
            $tube->save();
            if ($ndt->Bis == "true") $ndt->Bis_t = 'checked'; else $ndt->Bis_t = "";

            return response()->json(array('ndt' => $ndt), 200);
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
            if ($rapport->Zone == 'Z08') {
                if ($rapport->Etat == 'N') {
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('Ndt.Ndt',
                        ['rapport' => $rapport,
                            'ndts' => $rapport->Ndt,
                            'detailP' => $detailP,
                            'details' => $details,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_Ndt.index'));
                }

            } else {
                return redirect(route('rapports_Ndt.index'));
            }
        } else {
            return redirect(route('rapports_Ndt.index'));
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
        $ndt = Ndt::find($id);
        $ndt->Snup = $request->Snup;
        $ndt->OPR = $request->OPR;
        $ndt->Repd = $request->Repd;
        $ndt->Repg = $request->Repg;
        $ndt->Observation = $request->Observation;
        $ndt->DateSaisie = date('Y-m-d H:i:s');
        if ($ndt->save()) {
            if ($ndt->Bis == "true") $ndt->Bis_t = 'checked'; else $ndt->Bis_t = "";
            return response()->json(array('ndt' => $ndt), 200);
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
        $ndt = \App\Visuel\Ndt::findOrFail($id);

        if ($ndt->delete()) {
            $ndt->tube->Z08 = false;
            $ndt->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
