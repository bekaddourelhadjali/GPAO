<?php

namespace App\Http\Controllers\Visuel;

use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Http\Controllers\Controller;
use App\Visuel\Defauts;
use App\Visuel\Visuels;
use App\Visuel\DetailDefauts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisuelsController extends Controller
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
        $visuel = new Visuels();
        $rapport = Rapport::find($request->NumeroRap);
        $visuel->Pid = $rapport->Pid;
        $visuel->Did = $rapport->Did;
        $visuel->Machine = substr($request->ntube,0,1);
        $visuel->Ntube = substr($request->ntube,1);
        $visuel->Tube =$request->ntube;
        $visuel->IdOpr = 1;
        $visuel->NbOpr = 1;
        $visuel->NumeroRap = $request->NumeroRap;
        if ($request->bis == 'true') $visuel->Bis = 1;
        else $visuel->Bis = 0;
        if ($request->sond == 'true') $visuel->Sond = 1;
        else $visuel->Sond = 0;
        $visuel->Longueur = $request->longueur;
        $visuel->E = $request->E;
        $visuel->Y = $request->Y;
        $visuel->DiamD = $request->Diam_D;
        $visuel->DiamF = $request->Diam_F;
        $visuel->ObsSoudure = $request->ObsSoudure;
        $visuel->ObsMetal = $request->ObsMetal;
        $visuel->User = $rapport->NomAgents . '/' . $rapport->NomAgents1;
        $visuel->Computer = gethostname();
        $visuel->DateSaisie = date('Y-m-d H:i:s');
        $visuel->Visible = 1;
        $tube = Tube::where('Tube', '=', $visuel->Tube)
            ->where('Bis', '=', $visuel->Bis)
            ->where('Pid', '=', $visuel->Pid)
            ->where('Did', '=', $visuel->Did)->first();
        if ($tube != null) {
            $tube = Tube::find($tube->NumTube);
            $tube->Z02 = true;
        } else {
            $tube = new Tube();
            $tube->Pid = $rapport->Pid;
            $tube->Did = $rapport->Did;
            $tube->Machine = $visuel->Machine;
            $tube->NTube = $visuel->Ntube;
            $tube->Tube = $visuel->Tube;
            $tube->Longueur = $request->longueur;
            $tube->Bis = $visuel->Bis;
            $tube->User = $rapport->NomAgents . '/' . $rapport->NomAgents1;
            $tube->Computer = gethostname();
            $tube->DateSaisie = date('Y-m-d H:i:s');
            $tube->Z02 = true;
        }

        $tube->save();
        $visuel->NumTube = $tube->NumTube;
        $defauts = $request->Defauts;
        if ($visuel->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $visuel->Pid;
                $detailDefaut->Did = $visuel->Did;
                $detailDefaut->Zone = "Z02";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $visuel->Numero;
                $detailDefaut->Tube = $visuel->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->save();
            }
            return response()->json(array('visuel' => $visuel), 200);

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
            if ($rapport->Zone == 'Z02') {
                if ($rapport->Etat == 'N') {
                    $defautsMetal = \App\Visuel\Defauts::where('Zone', '=', 'Z02')->where('Type', '=', 'Metal')->get();
                    $defautsSoudure = \App\Visuel\Defauts::where('Zone', '=', 'Z02')->where('Type', '=', 'Soudure')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z02')->get();
                    return view('visuel.rapvisuel',
                        ['rapport' => $rapport,
                            'visuels' => $rapport->visuels,
                            'arrets' => $rapport->arrets,
                            'defautsMetal' => $defautsMetal,
                            'defautsSoudure' => $defautsSoudure
                            , 'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_visuels.index'));
                }

            } else {
                return redirect(route('rapports_visuels.index'));
            }
        } else {
            return redirect(route('rapports_visuels.index'));
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
        $visuel = Visuels::findorFail($id);
        if ($request->sond == 'true') $visuel->Sond = 1;
        else $visuel->Sond = 0;
        $visuel->Longueur = $request->longueur;
        $visuel->E = $request->E;
        $visuel->Y = $request->Y;
        $visuel->DiamD = $request->Diam_D;
        $visuel->DiamF = $request->Diam_F;
        if ($visuel->save()) {
            return response()->json(array('visuel' => $visuel), 200);

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
        $visuel = \App\Visuel\Visuels::findOrFail($id);
        $tube = $visuel->tube;
        if ($visuel->delete()) {
            foreach ($visuel->Defauts() as $Defaut) {
                $Defaut->delete();
            }
            $nbVisuels = Visuels::where('Tube', '=', $tube->Tube)->where('Bis', '=', $tube->Bis)->where('Did', '=', $tube->Did)->count();
            if ($nbVisuels == 0) {
                if (!$tube->Z01 && !$tube->Z03)
                    $tube->delete();
                else {
                    $tube->Z02 = false;
                    $tube->save();
                }
            }
            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
