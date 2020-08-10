<?php

namespace App\Http\Controllers\RepM17;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Visuel\DetailDefauts;
use App\Visuel\Rep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $rep->NumTube = $tube->NumTube;
        $rep->Pid = $request->Pid;
        $rep->Did = $request->Did;
        $rep->NumeroRap = $request->NumeroRap;
        $rep->Machine = $tube->Machine;
        $rep->Ntube = $tube->NTube;
        $rep->Tube = $tube->Tube;
        $rep->Bis = $tube->Bis;
        $rep->Observation = $request->ObsTube;
        $rep->Defauts=$request->Obs;
        $rep->User=$rapport->NomAgents;
        $rep->Computer=gethostname();
        $rep->DateSaisie = date('Y-m-d H:i:s');
        $defauts=$request->Defauts;
        if ($rep->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$rep->Tube;
                $Edit->Zone="Z04";
                $Edit->NumeroRap=$rep->NumeroRap;
                $Edit->ItemId=$rep->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            $tube->Z04 = true;
            $tube->save();
            if ($rep->Bis=="true" || $rep->Bis=="1") $rep->Bis_t = "checked"; else $rep->Bis_t = "";
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
                    $detailDefaut->Int = $defaut[6];
                    $detailDefaut->Ext = $defaut[7];
                    $detailDefaut->Observation = $defaut[8];
                    $detailDefaut->save();
                }
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
                if ($rapport->Etat == 'N'||(Auth::check() && Auth::user()->role == "Chef Production")) {
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $defauts = \App\Visuel\Defauts::where('Zone', '=', 'Z04')->get();
                    $operations = \App\Visuel\Operations::where('Zone', '=', 'Z04')->get();
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('RepM17.Rep',
                        ['rapport' => $rapport,
                            'reps' => $rapport->Reparations,
                            'detailP' => $detailP,
                            'details' => $details,
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
        $rep->Observation = $request->ObsTube;
        $rep->Defauts=$request->Obs;
        $rep->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $rep->Defs;
        $defauts=$request->Defauts;
        if ($rep->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$rep->Tube;
                $Edit->Zone="Z04";
                $Edit->NumeroRap=$rep->NumeroRap;
                $Edit->ItemId=$rep->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
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
                $detailDefaut->Int = $defaut[6];
                $detailDefaut->Ext = $defaut[7];
                $detailDefaut->Observation = $defaut[8];
                $detailDefaut->save();
            }
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }

            if ($rep->Bis=="true" || $rep->Bis=="1") $rep->Bis_t = "checked"; else $rep->Bis_t = "";
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
        if(Auth::check() && Auth::user()->role=="Chef Production"){
        $Edit=new RapportsEdits();
        $Edit->Operation="Delete";
        $Edit->Item=$rep->Tube;
        $Edit->Zone="Z04";
        $Edit->NumeroRap=$rep->NumeroRap;
        $Edit->ItemId=$rep->Id;
        $Edit->User=Auth::user()->username;
        $Edit->Computer=gethostname();
        $Edit->DateSaisie=date('Y-m-d H:i:s');
    }
        if ($rep->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit->save();
            }
            $rep->tube->Z04 = false;
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
