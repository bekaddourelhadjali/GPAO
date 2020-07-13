<?php

namespace App\Http\Controllers\RepM17;

use App\Fabrication\Tube;
use App\Visuel\DetailDefauts;
use App\Visuel\Rep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReparationController extends Controller
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
        $rep = new Rep();
        $tube = Tube::where('Tube', '=', $request->ntube)->where('Pid', '=', $request->Pid)->where('Did', '=', $request->Did)->first();
        $rep->NumTube = $tube->NumTube;
        $rep->Pid = $request->Pid;
        $rep->Did = $request->Did;
        $rep->NumeroRap = $request->NumeroRap;
        $rep->Machine = $tube->Machine;
        $rep->Ntube = $tube->NTube;
        $rep->Tube = $tube->Tube;
        $rep->Bis = $request->bis;
        $rep->Longueur = $request->Longueur;
        $rep->Observation = $request->Observation; 
        $rep->DfInt = $request->Int;
        $rep->DfExt = $request->Ext;
        $rep->Rep1 = $request->Rep1;
        $rep->Rep2 = $request->Rep2;
        $rep->Rep3 = $request->Rep3;
        $rep->Defauts=$request->Obs;
        $rep->DateSaisie = date('Y-m-d H:i:s');
        $defauts=$request->Defauts;
        if ($rep->save()) {
            $tube->Z04 = true;
            $tube->save();
                foreach ($defauts as $defaut) {
                    $detailDefaut = new \App\Visuel\DetailDefauts();
                    $detailDefaut->Pid = $rep->Pid;
                    $detailDefaut->Did = $rep->Did;
                    $detailDefaut->Zone = "Z04";
                    $detailDefaut->NumRap = $request->NumeroRap;
                    $detailDefaut->NumVisuel = $rep->Id;
                    $detailDefaut->Tube = $rep->Tube;
                    $detailDefaut->Opr = $defaut[0];
                    $detailDefaut->IdDef = $defaut[1];
                    $detailDefaut->Defaut = $defaut[2];
                    $detailDefaut->Valeur = $defaut[3];
                    $detailDefaut->NbOpr = $defaut[4];
                    $detailDefaut->Nombre = $defaut[5];
                    $detailDefaut->save();
                }
            if ($rep->Bis=="true" || $rep->Bis=="1") $rep->Bis_t = "checked"; else $rep->Bis_t = "";
            if ($rep->DfInt=="true" || $rep->DfInt=="1") $rep->Int_t = "checked"; else $rep->Int_t = "";
            if ($rep->DfExt=="true"  || $rep->DfExt=="1") $rep->Ext_t = "checked"; else $rep->Ext_t = "";
            if ($rep->Rep1=="true" || $rep->Rep1=="1") $rep->Rep1_t = "checked"; else $rep->Rep1_t = "";
            if ($rep->Rep2=="true" || $rep->Rep2=="1") $rep->Rep2_t = "checked"; else $rep->Rep2_t = "";
            if ($rep->Rep3=="true" || $rep->Rep3=="1") $rep->Rep3_t = "checked"; else $rep->Rep3_t = "";
            return response()->json(array('rep' => $rep), 200);
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
            if ($rapport->Zone == 'Z04') {
                if ($rapport->Etat == 'N') {
                    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->where('Pid', '=', $rapport->Pid)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z04')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z04')->get();
                    return view('RepM17.Rep',
                        ['rapport' => $rapport,
                            'reps' => $rapport->Reparations,
                            'projet' => $projet,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,
                            'defauts' => $defauts,
                            'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_Rep.index'));
                }

            } else {
                return redirect(route('rapports_Rep.index'));
            }
        } else {
            return redirect(route('rapports_Rep.index'));
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
        $rep = Rep::findorFail($id);
        if ($rep != null) {
            $rep->Defs;
            return response()->json(array('rep' => $rep), 200);

        } else {
            return response()->json(array('error' => error), 404);

        }
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
        $rep =  Rep::find($id);
        $rep->Bis = $request->bis;
        $rep->Longueur = $request->Longueur;
        $rep->Observation = $request->Observation;
        $rep->DfInt = $request->Int;
        $rep->DfExt = $request->Ext;
        $rep->Rep1 = $request->Rep1;
        $rep->Rep2 = $request->Rep2;
        $rep->Rep3 = $request->Rep3;
        $rep->Defauts=$request->Obs;
        $rep->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $rep->Defs;
        $defauts=$request->Defauts;
        if ($rep->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rep->Pid;
                $detailDefaut->Did = $rep->Did;
                $detailDefaut->Zone = "Z04";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $rep->Id;
                $detailDefaut->Tube = $rep->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->save();
            }
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            if ($rep->Bis=="true" || $rep->Bis=="1") $rep->Bis_t = "checked"; else $rep->Bis_t = "";
            if ($rep->DfInt=="true" || $rep->DfInt=="1") $rep->Int_t = "checked"; else $rep->Int_t = "";
            if ($rep->DfExt=="true"  || $rep->DfExt=="1") $rep->Ext_t = "checked"; else $rep->Ext_t = "";
            if ($rep->Rep1=="true" || $rep->Rep1=="1") $rep->Rep1_t = "checked"; else $rep->Rep1_t = "";
            if ($rep->Rep2=="true" || $rep->Rep2=="1") $rep->Rep2_t = "checked"; else $rep->Rep2_t = "";
            if ($rep->Rep3=="true" || $rep->Rep3=="1") $rep->Rep3_t = "checked"; else $rep->Rep3_t = "";
            return response()->json(array('rep' => $rep), 200);
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
        $rep = \App\Visuel\Rep::findOrFail($id);
        $oldDefs=$rep->defs;
        if ($rep->delete()) {
            $rep->tube->Z11 = false;
            $rep->tube->save();
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
