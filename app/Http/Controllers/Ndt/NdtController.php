<?php

namespace App\Http\Controllers\Ndt;

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
        $tube = Tube::where('Tube', '=', $request->ntube)->where('Pid', '=', $request->Pid)->where('Did', '=', $request->Did)->first();
        $ndt->NumTube = $tube->NumTube;
        $ndt->Pid = $request->Pid;
        $ndt->Did = $request->Did;
        $ndt->NumeroRap = $request->NumeroRap;
        $ndt->Machine = $tube->Machine;
        $ndt->Ntube = $tube->NTube;
        $ndt->Tube = $tube->Tube;
        $ndt->Bis = $request->bis;
        $ndt->Snup = $request->Snup;
        $ndt->OPR = $request->OPR;
        $ndt->Repd = $request->Repd;
        $ndt->Repg = $request->Repg;
        if((DB::select('select max("NbOpr") as "NbOpr" from "ndt" where "Tube"=? and "Pid"=? and "Did"=?',[$ndt->Tube,$request->Pid,$request->Did])[0]->NbOpr)!=null)
            $ndt->NbOpr=DB::select('select max("NbOpr")+1 as "NbOpr" from "ndt" where "Tube"=? and "Pid"=? and "Did"=?',[$ndt->Tube,$request->Pid,$request->Did])[0]->NbOpr;
        else{
            $ndt->NbOpr=1;
        }
        $ndt->Observation = $request->Observation;
        $ndt->Operation = "Contrôlé";
        $ndt->DateSaisie = date('Y-m-d H:i:s');
        if ($ndt->save()) {
            $tube->Z07 = true;
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
            if ($rapport->Zone == 'Z07') {
                if ($rapport->Etat == 'N') {
                    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->where('Pid', '=', $rapport->Pid)->select(['NumTube', 'Tube', 'Bis'])->get();

                    return view('Ndt.Ndt',
                        ['rapport' => $rapport,
                            'ndts' => $rapport->Ndt,
                            'projet' => $projet,
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
        $ndt->Bis = $request->bis;
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
            $ndt->tube->Z07 = false;
            $ndt->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
