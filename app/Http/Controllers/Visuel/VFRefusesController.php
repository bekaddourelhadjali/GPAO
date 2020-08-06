<?php

namespace App\Http\Controllers\Visuel;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\DetailDefauts;
use App\Visuel\VFRefuses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VFRefusesController extends Controller
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
        $vfr = new VFRefuses();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $vfr->NumTube = $tube->NumTube;
        $vfr->Pid = $request->Pid;
        $vfr->Did = $request->Did;
        $vfr->NumeroRap = $request->NumeroRap;
        $vfr->Ntube = $tube->NTube;
        $vfr->Tube = $tube->Tube;
        $vfr->Bis = $tube->Bis;
        $vfr->Defauts=$request->Obs;
        $vfr->Observation=$request->ObsTube;
        $vfr->User=$rapport->NomAgents;
        $vfr->Computer=gethostname();
        $vfr->DateSaisie = date('Y-m-d H:i:s');
        $defauts=$request->Defauts;
        if ($vfr->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$vfr->Tube;
                $Edit->Zone="DEC";
                $Edit->NumeroRap=$vfr->NumeroRap;
                $Edit->ItemId=$vfr->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            if ($vfr->Bis=="true" || $vfr->Bis=="1") $vfr->Bis_t = "checked"; else $vfr->Bis_t = "";
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $vfr->Pid;
                $detailDefaut->Did = $vfr->Did;
                $detailDefaut->Zone = "DEC";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $vfr->Id;
                $detailDefaut->Tube = $vfr->Tube;
                $detailDefaut->Opr = $defaut[0];
                $detailDefaut->IdDef = $defaut[1];
                $detailDefaut->Defaut = $defaut[2];
                $detailDefaut->Valeur = $defaut[3];
                $detailDefaut->NbOpr = $defaut[4];
                $detailDefaut->Nombre = $defaut[5];
                $detailDefaut->Observation = $defaut[6];
                $detailDefaut->save();
            }
            return response()->json(array('vfr' => $vfr), 200);
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
            if ($rapport->Zone == 'DEC') {
                if ($rapport->Etat == 'N') {
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $tubes = \App\Visuel\VisuelFinal::where('Did', '=', $rapport->Did)->where('Defauts','=','Déclassé')->select(['NumTube', 'Tube', 'Bis'])->get();
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z10')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z10')->get();
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('Visuel.VFRefuses',
                        ['rapport' => $rapport,
                            'VFRefuses' => $rapport->VFRefuses,
                            'detailP' => $detailP,
                            'details' => $details,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,
                            'defauts' => $defauts,
                            'operations' => $operations]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_VFRefuses.index'));
                }

            } else {
                return redirect(route('rapports_VFRefuses.index'));
            }
        } else {
            return redirect(route('rapports_VFRefuses.index'));
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
        $vfr = VFRefuses::findorFail($id);
        if ($vfr != null) {
            $vfr->Defs;
            return response()->json(array('vfr' => $vfr), 200);
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
        $vfr =  VFRefuses::find($id);
        $vfr->Defauts=$request->Obs;
        $vfr->Observation=$request->ObsTube;
        $vfr->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $vfr->Defs;
        $defauts=$request->Defauts;
        if ($vfr->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$vfr->Tube;
                $Edit->Zone="DEC";
                $Edit->NumeroRap=$vfr->NumeroRap;
                $Edit->ItemId=$vfr->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            foreach ($defauts as $defaut) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $vfr->Pid;
                $detailDefaut->Did = $vfr->Did;
                $detailDefaut->Zone = "DEC";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $vfr->Id;
                $detailDefaut->Tube = $vfr->Tube;
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

            if ($vfr->Bis=="true" || $vfr->Bis=="1") $vfr->Bis_t = "checked"; else $vfr->Bis_t = "";
            return response()->json(array('vfr' => $vfr), 200);
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
        $vfr = \App\Visuel\VFRefuses::findOrFail($id);
        $oldDefs=$vfr->defs;
        if(Auth::check() && Auth::user()->role=="Chef Controle"){
            $Edit=new RapportsEdits();
            $Edit->Operation="Delete";
            $Edit->Item=$vfr->Tube;
            $Edit->Zone="DEC";
            $Edit->NumeroRap=$vfr->NumeroRap;
            $Edit->ItemId=$vfr->Id;
            $Edit->User=Auth::user()->username;
            $Edit->Computer=gethostname();
            $Edit->DateSaisie=date('Y-m-d H:i:s');
        }
        if ($vfr->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit->save();
            }
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
