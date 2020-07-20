<?php

namespace App\Http\Controllers\RX1;

use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
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
        $rapport = Rapport::find($request->NumeroRap);
        $rx1->Pid = detailprojet::find($request->Did)->Project->Pid;
        $rx1->Did = $request->Did;
        $rx1->Machine =  substr($request->ntube,0,1);
        $rx1->Tube = $request->ntube;
        $rx1->Ntube = substr($request->ntube,1);
        $rx1->NumeroRap = $request->NumeroRap;
        if ($request->bis == 'true') $rx1->Bis = 1;
        else $rx1->Bis = 0;
        $rx1->Defauts = $request->Obs;
        $rx1->Observation = $request->Observation;
        $rx1->Integration = $request->Integration;
        $rx1->CodeSoude = $request->CodeSoude;
        $rx1->User = $rapport->NomAgents;
        $rx1->Computer = gethostname();
        $rx1->DateSaisie = date('Y-m-d H:i:s');
        $tube = Tube::where('Tube', '=', $rx1->Tube)
            ->where('Bis', '=', $rx1->Bis)
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
            $tube->NTube = $rx1->Ntube;
            $tube->Tube = $rx1->Tube;
            $tube->Bis = $rx1->Bis;
            $tube->User = $rapport->NomAgents . '/' . $rapport->NomAgents1;
            $tube->Computer = gethostname();
            $tube->DateSaisie = date('Y-m-d H:i:s');
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
                $detailDefaut->Observation = $defaut[6];
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
                     $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z03')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z03')->get();
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('RX1.RX1',
                        ['rapport' => $rapport,
                            'rx1' => $rapport->rx1,
                            'details' => $details,
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
        $rx1 = RX1::find($id);
        $rx1->Pid = detailprojet::find($request->Did)->Project->Pid;
        $rx1->Did = $request->Did;
        $rx1->Defauts = $request->Obs;
        $rx1->Observation = $request->Observation;
        $rx1->Integration = $request->Integration;
        $rx1->CodeSoude = $request->CodeSoude;
        $rx1->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $rx1->Defs;
        $defauts = $request->Defauts;
        if ($rx1->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rx1->Pid;
                $detailDefaut->Did = $rx1->Did;
                $detailDefaut->Zone = "Z03";
                $detailDefaut->NumRap = $rx1->NumeroRap;
                $detailDefaut->NumVisuel = $rx1->Id;
                $detailDefaut->Tube = $rx1->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->Observation = $defaut[6];
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
        $tube = $rx1->tube;
        if ($rx1->delete()) {
            foreach ($rx1->Defs as $Defaut) {
                $Defaut->delete();
            }
            $nbRX1 = RX1::where('Tube', '=', $tube->Tube)->where('Bis', '=', $tube->Bis)->where('Did', '=', $tube->Did)->count();
            if($nbRX1== 0){
                if (!$tube->Z01 && !$tube->Z02){
                    $rx1->tube->delete();
                }else{

                    $rx1->tube->Z03 = false;
                    $rx1->tube->save();
                }
            }

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
