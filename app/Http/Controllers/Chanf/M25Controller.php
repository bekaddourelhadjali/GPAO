<?php

namespace App\Http\Controllers\Chanf;

use App\Fabrication\Tube;
use App\Visuel\m25;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M25Controller extends Controller
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
        $m25 = new M25();
        $tube = Tube::where('Tube', '=', $request->ntube)->where('Pid', '=', $request->Pid)->where('Did', '=', $request->Did)->first();
        $m25->NumTube = $tube->NumTube;
        $m25->Pid = $request->Pid;
        $m25->Did = $request->Did;
        $m25->NumeroRap = $request->NumeroRap;
        $m25->Machine = $tube->Machine;
        $m25->Ntube = $tube->NTube;
        $m25->Tube = $tube->Tube;
        $m25->Bis = $request->bis;
        $m25->Debut = $request->Debut;
        $m25->Fin = $request->Fin;
        if((DB::select('select max("NbOpr") as "NbOpr" from "m25" where "Tube"=? and "Pid"=? and "Did"=?',[$m25->Tube,$request->Pid,$request->Did])[0]->NbOpr)!=null)
            $m25->NbOpr=DB::select('select max("NbOpr")+1 as "NbOpr" from "m25" where "Tube"=? and "Pid"=? and "Did"=?',[$m25->Tube,$request->Pid,$request->Did])[0]->NbOpr;
        else{
            $m25->NbOpr=1;
        }
        $m25->Observation = $request->Observation;
        $m25->Operation = "Chanfreiné";
        $m25->DateSaisie = date('Y-m-d H:i:s');
        if ($m25->save()) {
            $tube->Z06 = true;
            $tube->save();
            if ($m25->Bis == "true") $m25->Bis_t = 'checked'; else $m25->Bis_t = "";
            if ($m25->Debut == "true") $m25->Debut_t = 'checked'; else $m25->Debut_t = "";
            if ($m25->Fin == "true") $m25->Fin_t = 'checked'; else $m25->Fin_t = "";

            return response()->json(array('m25' => $m25), 200);
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
            if ($rapport->Zone == 'Z06') {
                if ($rapport->Etat == 'N') {
                    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->where('Pid', '=', $rapport->Pid)->select(['NumTube', 'Tube', 'Bis'])->get();

                    return view('Chanf.M25',
                        ['rapport' => $rapport,
                            'm25' => $rapport->m25,
                            'projet' => $projet,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_25.index'));
                }

            } else {
                return redirect(route('rapports_25.index'));
            }
        } else {
            return redirect(route('rapports_25.index'));
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
        $m25 = M25::find($id);
        $m25->Bis = $request->bis;
        $m25->Debut = $request->Debut;
        $m25->Fin = $request->Fin;
        $m25->Observation = $request->Observation;
        $m25->DateSaisie = date('Y-m-d H:i:s');
        if ($m25->save()) {
            if ($m25->Bis == "true") $m25->Bis_t = 'checked'; else $m25->Bis_t = "";
            if ($m25->Debut == "true") $m25->Debut_t = 'checked'; else $m25->Debut_t = "";
            if ($m25->Fin == "true") $m25->Fin_t = 'checked'; else $m25->Fin_t = "";
            return response()->json(array('m25' => $m25), 200);
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
        $m25 = \App\Visuel\M25::findOrFail($id);

        if ($m25->delete()) {
            $m25->tube->Z06 = false;
            $m25->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
