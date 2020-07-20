<?php

namespace App\Http\Controllers\RX2;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\DetailDefauts;
use App\Visuel\RX2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RX2Controller extends Controller
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
        $rx2 = new RX2();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $rx2->NumTube = $tube->NumTube;
        $rx2->Pid = $request->Pid;
        $rx2->Did = $request->Did;
        $rx2->NumeroRap = $request->NumeroRap;
        $rx2->Integration = $request->Integration;
        $rx2->CodeSoude = $request->CodeSoude;
        $rx2->Ntube = $tube->NTube;
        $rx2->Tube = $tube->Tube;
        $rx2->Bis = $tube->Bis;
        $rx2->Defauts=$request->Obs;
        $rx2->Observation=$request->ObsTube;
        $rx2->User=$rapport->NomAgents;
        $rx2->Computer=gethostname();
        $rx2->DateSaisie = date('Y-m-d H:i:s');
        $defauts=$request->Defauts;
        if ($rx2->save()) {
            $tube->Z09 = true;
            $tube->save();
            if ($rx2->Bis=="true" || $rx2->Bis=="1") $rx2->Bis_t = "checked"; else $rx2->Bis_t = "";
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rx2->Pid;
                $detailDefaut->Did = $rx2->Did;
                $detailDefaut->Zone = "Z09";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $rx2->Id;
                $detailDefaut->Tube = $rx2->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->Int = $defaut[6];
                $detailDefaut->Ext = $defaut[7];
                $detailDefaut->Observation = $defaut[8];
                $detailDefaut->save();
            }
            return response()->json(array('rx2' => $rx2), 200);
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
            if ($rapport->Zone == 'Z09') {
                if ($rapport->Etat == 'N') {
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z09')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z09')->get();
                    return view('RX2.RX2',
                        ['rapport' => $rapport,
                            'rxs' => $rapport->rx2,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,
                            'defauts' => $defauts,
                            'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_RX2.index'));
                }

            } else {
                return redirect(route('rapports_RX2.index'));
            }
        } else {
            return redirect(route('rapports_RX2.index'));
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
        $rx2 = RX2::findorFail($id);
        if ($rx2 != null) {
            $rx2->Defs;
            return response()->json(array('rx2' => $rx2), 200);
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
        $rx2 =  RX2::find($id);
        $rx2->Defauts=$request->Obs;
        $rx2->Observation=$request->ObsTube;
        $rx2->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $rx2->Defs;
        $rx2->Integration = $request->Integration;
        $rx2->CodeSoude = $request->CodeSoude;
        $defauts=$request->Defauts;
        if ($rx2->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $rx2->Pid;
                $detailDefaut->Did = $rx2->Did;
                $detailDefaut->Zone = "Z09";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $rx2->Id;
                $detailDefaut->Tube = $rx2->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->Int = $defaut[6];
                $detailDefaut->Ext = $defaut[7];
                $detailDefaut->Observation = $defaut[8];
                $detailDefaut->save();
            }
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            if ($rx2->Bis=="true" || $rx2->Bis=="1") $rx2->Bis_t = "checked"; else $rx2->Bis_t = "";
            return response()->json(array('rx2' => $rx2), 200);
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
        $rx2 = \App\Visuel\RX2::findOrFail($id);
        $oldDefs=$rx2->defs;
        if ($rx2->delete()) {
            $rx2->tube->Z09 = false;
            $rx2->tube->save();
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
