<?php

namespace App\Http\Controllers\RX1;

use App\Fabrication\Tube;
use App\Http\Controllers\Controller;
use App\Visuel\RX1;
use App\Visuel\DetailDefauts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RX1Controller extends Controller
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


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rx1 = new RX1();
        $rx1->Pid = $request->Pid;
        $rx1->Did = $request->Did;
        $rx1->Machine = $request->machine;
        $rx1->Tube = $request->Tube;
        $rx1->Ntube = $request->ntube;
        $rx1->NumeroRap = $request->NumeroRap;
        if ($request->bis == 'true') $rx1->Bis = 1;
        else $rx1->Bis = 0;
        $rx1->Defauts = $request->Obs;
        $rx1->Observation = $request->Observation;
        $rx1->DateSaisie = date('Y-m-d H:i:s');
        $tube = Tube::where('Tube', '=', $rx1->Tube)
            ->where('Pid', '=', $rx1->Pid)
            ->where('Did', '=', $rx1->Did)->first();
        if ($tube != null) {
            $tube = Tube::find($tube->NumTube);
            $tube->Z03 = true;
        } else {
            $tube = new Tube();
            $tube->Pid = $rx1->Pid;
            $tube->Did = $rx1->Did;
            $tube->Machine = $rx1->Machine;
            $tube->NTube = $request->ntube;
            $tube->Tube = $rx1->Tube;
            $tube->Bis = $rx1->Bis;
            $tube->Z03 = true;
        }

        $tube->save();
        $rx1->NumTube = $tube->NumTube;
        $defauts = $request->Defauts;
        if ($rx1->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rx1->Pid;
                $detailDefaut->Did = $rx1->Did;
                $detailDefaut->Zone = "Z03";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $rx1->Id;
                $detailDefaut->Tube = $rx1->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->save();
            }
            return response()->json(array('rx1' => $rx1), 200);

        } else {
            return response()->json(array('error' => error), 404);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapport = \App\Fabrication\Rapport::find($id);
        if ($rapport != null) {
            if ($rapport->Zone == 'Z03') {
                if ($rapport->Etat == 'N') {
                    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z03')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z03')->get();
                    return view('RX1.RX1',
                        ['rapport' => $rapport,
                            'rx1' => $rapport->rx1,
                            'projet' => $projet,
                            'details' => $projet->details,
                            'arrets' => $rapport->arrets,
                            'defauts' => $defauts,
                            'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_RX1.index'));
                }

            } else {
                return redirect(route('rapports_RX1.index'));
            }
        } else {
            return redirect(route('rapports_RX1.index'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rx1 = RX1::findorFail($id);
        if ($rx1 != null) {
            $rx1->Defs;
            return response()->json(array('rx1' => $rx1), 200);

        } else {
            return response()->json(array('error' => error), 404);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rx1 = RX1::findorFail($id);
        $rx1->Did = $request->Did;
        if ($request->bis == 'true') $rx1->Bis = 1;
        else $rx1->Bis = 0;
        $rx1->Defauts = $request->Obs;
        $rx1->Observation = $request->Observation;
        $rx1->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $rx1->Defs;
        $defauts = $request->Defauts;
        if ($rx1->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rx1->Pid;
                $detailDefaut->Did = $rx1->Did;
                $detailDefaut->Zone = "Z03";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $rx1->Id;
                $detailDefaut->Tube = $rx1->Tube;
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
            return response()->json(array('rx1' => $rx1), 200);

        } else {
            return response()->json(array('error' => error), 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rx1 = \App\Visuel\RX1::findOrFail($id);

        if ($rx1->delete()) {
            $rx1->tube->Z03 = false;
            $rx1->tube->save();
            foreach ($rx1->Defs as $Defaut) {
                $Defaut->delete();
            }
            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
