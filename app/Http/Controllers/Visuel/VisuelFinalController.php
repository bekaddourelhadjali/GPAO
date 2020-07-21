<?php

namespace App\Http\Controllers\Visuel;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\DetailDefauts;
use App\Visuel\RX2;
use App\Visuel\VisuelFinal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisuelFinalController extends Controller
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
        $visFin = new VisuelFinal();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $visFin->NumTube = $tube->NumTube;
        $visFin->Pid = $request->Pid;
        $visFin->Did = $request->Did;
        $visFin->NumeroRap = $request->NumeroRap;
        $visFin->Ntube = $tube->NTube;
        $visFin->Tube = $tube->Tube;
        $visFin->Bis = $tube->Bis;
        $visFin->EpaisseurD = $request->EpaisseurD;
        $visFin->EpaisseurC = $request->EpaisseurC;
        $visFin->EpaisseurF = $request->EpaisseurF;
        $visFin->DiametreD = $request->DiametreD;
        $visFin->DiametreC = $request->DiametreC;
        $visFin->DiametreF = $request->DiametreF;
        $visFin->OrthogonaliteD = $request->OrthogonaliteD;
        $visFin->OrthogonaliteF = $request->OrthogonaliteF;
        $visFin->ChanfreinD = $request->ChanfreinD;
        $visFin->ChanfreinF = $request->ChanfreinF;
        $visFin->Ovalisation = $request->Ovalisation;
        $visFin->Rectitude = $request->Rectitude;
        $visFin->Longueur = $request->Longueur;
        $defauts=json_decode($request->Defauts);
        if($defauts[0][0]=="R.A.S"||$defauts[0][0]=="Déclassé"){
            $visFin->Defauts=$defauts[0][0];
        }else{

            $visFin->Defauts=$request->defauts;
        }
        $visFin->Observation=$request->ObsTube;
        $visFin->User=$rapport->NomAgents;
        $visFin->Computer=gethostname();
        $visFin->DateSaisie = date('Y-m-d H:i:s');
        if ($visFin->save()) {
            $tube->Z10 = true;
            $tube->save();
            if ($visFin->Bis=="true" || $visFin->Bis=="1") $visFin->Bis_t = "checked"; else $visFin->Bis_t = "";

                foreach ($defauts as $defaut) {
                    $detailDefaut = new \App\Visuel\DetailDefauts();
                    $detailDefaut->Pid = $visFin->Pid;
                    $detailDefaut->Did = $visFin->Did;
                    $detailDefaut->Zone = "Z10";
                    $detailDefaut->NumRap = $request->NumeroRap;
                    $detailDefaut->NumVisuel = $visFin->Id;
                    $detailDefaut->Tube = $visFin->Tube;
                    $detailDefaut->Opr = $defaut[0];
                    $detailDefaut->IdDef = $defaut[1];
                    $detailDefaut->Defaut = $defaut[2];
                    $detailDefaut->Valeur = $defaut[3];
                    $detailDefaut->NbOpr = $defaut[4];
                    $detailDefaut->Nombre = $defaut[5];
                    $detailDefaut->Observation = $defaut[6];
                    $detailDefaut->save();

            }
            return response()->json(array('visFin' => $visFin), 200);
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
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z10')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z10')->get();
                    return view('Visuel.VisuelFinal',
                        ['rapport' => $rapport,
                            'visuelFinals' => $rapport->visuelFinals,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,
                            'defauts' => $defauts,
                            'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_VisuelFinal.index'));
                }

            } else {
                return redirect(route('rapports_VisuelFinal.index'));
            }
        } else {
            return redirect(route('rapports_VisuelFinal.index'));
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
        $visFin = VisuelFinal::findorFail($id);
        if ($visFin != null) {
            $visFin->Defs;
            return response()->json(array('visFin' => $visFin), 200);
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
        $visFin =  VisuelFinal::find($id);
        $visFin->Defauts=$request->Obs;
        $visFin->Observation=$request->ObsTube;
        $visFin->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $visFin->Defs;
        $visFin->EpaisseurD = $request->EpaisseurD;
        $visFin->EpaisseurC = $request->EpaisseurC;
        $visFin->EpaisseurF = $request->EpaisseurF;
        $visFin->DiametreD = $request->DiametreD;
        $visFin->DiametreC = $request->DiametreC;
        $visFin->DiametreF = $request->DiametreF;
        $visFin->OrthogonaliteD = $request->OrthogonaliteD;
        $visFin->OrthogonaliteF = $request->OrthogonaliteF;
        $visFin->ChanfreinD = $request->ChanfreinD;
        $visFin->ChanfreinF = $request->ChanfreinF;
        $visFin->Ovalisation = $request->Ovalisation;
        $visFin->Rectitude = $request->Rectitude;
        $visFin->Longueur = $request->Longueur;
        $defauts=json_decode($request->Defauts);
        if($defauts[0][0]=="R.A.S"||$defauts[0][0]=="Déclassé"){
            $visFin->Defauts=$defauts[0][0];
        }else{

            $visFin->Defauts=$request->defauts;
        }
        if ($visFin->save()) {
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $visFin->Pid;
                $detailDefaut->Did = $visFin->Did;
                $detailDefaut->Zone = "Z10";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $visFin->Id;
                $detailDefaut->Tube = $visFin->Tube;
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

            if ($visFin->Bis=="true" || $visFin->Bis=="1") $visFin->Bis_t = "checked"; else $visFin->Bis_t = "";
            return response()->json(array('visFin' => $visFin), 200);
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
        $visFin = \App\Visuel\VisuelFinal::findOrFail($id);
        $oldDefs=$visFin->Defs;
        if ($visFin->delete()) {
            $visFin->tube->Z10= false;
            $visFin->tube->save();
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
