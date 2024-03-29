<?php

namespace App\Http\Controllers\RepM17;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\Defauts;
use App\Visuel\DetailDefauts;
use App\Visuel\M17;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class M17Controller extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * Pid: $('#Pi
     * Did: $('#de
     * NumeroRap:
     * NumTube: $(
     * bis: $('#bi
     * Observation
     * LongCh: $('
     * defauts: de
     */
    public function store(Request $request)
    {
        $m17 = new M17();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $m17->NumTube = $tube->NumTube;
        $m17->Pid = $request->Pid;
        $m17->Did = $request->Did;
        $m17->NumeroRap = $request->NumeroRap;
        $m17->Machine = $tube->Machine;
        $m17->Ntube = $tube->NTube;
        $m17->Tube = $tube->Tube;
        $m17->Bis = $tube->Bis;
        $m17->LongCh = $request->LongCh;
        $m17->Observation = $request->Observation;
        $m17->Defauts = implode($request->Defauts,',');
        $m17->User=$rapport->NomAgents;
        $m17->Computer=gethostname();
        $m17->DateSaisie = date('Y-m-d H:i:s');
        if ($m17->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$m17->Tube;
                $Edit->Zone="Z05";
                $Edit->NumeroRap=$m17->NumeroRap;
                $Edit->ItemId=$m17->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            foreach ( $request->Defauts as $item) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $m17->Pid;
                $detailDefaut->Did = $m17->Did;
                $detailDefaut->Zone = "Z05";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $m17->Id;
                $detailDefaut->Tube = $m17->Tube;
                $detailDefaut->Opr = "Chuté";
                $detailDefaut->Defaut = $item;
                $detailDefaut->NbOpr = 0;
                $detailDefaut->save();
            }
            $tube->Z05 = true;
            $tube->save();
            if ($m17->Bis == "true") $m17->Bis_t = 'checked'; else $m17->Bis_t = "";
            return response()->json(array('m17' => $m17), 200);
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
            if ($rapport->Zone == 'Z05') {
                if ($rapport->Etat == 'N'||(Auth::check() && Auth::user()->role == "Chef Production")) {
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $defauts=Defauts::where('Zone',"=",'Z05')->get();
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('RepM17.M17',
                        ['rapport' => $rapport,
                            'm17' => $rapport->m17,
                            'defauts' => $defauts,
                            'details' => $details,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_M17.index'));
                }

            } else {
                return redirect(route('rapports_M17.index'));
            }
        } else {
            return redirect(route('rapports_M17.index'));
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
        //
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
        $m17 = M17::find($id);
        $m17->Defauts = implode($request->Defauts,',');
        $m17->LongCh = $request->LongCh;
        $m17->Observation = $request->Observation;
        $m17->DateSaisie = date('Y-m-d H:i:s');
        $oldDefs = $m17->Defs;
        $defauts=$request->Defauts;
        if ($m17->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$m17->Tube;
                $Edit->Zone="Z05";
                $Edit->NumeroRap=$m17->NumeroRap;
                $Edit->ItemId=$m17->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            foreach ( $defauts as $item) {
                $detailDefaut = new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid = $m17->Pid;
                $detailDefaut->Did = $m17->Did;
                $detailDefaut->Zone = "Z05";
                $detailDefaut->NumRap = $request->NumeroRap;
                $detailDefaut->NumVisuel = $m17->Id;
                $detailDefaut->Tube = $m17->Tube;
                $detailDefaut->Opr = "Chuté";
                $detailDefaut->Defaut = $item;
                $detailDefaut->NbOpr = 0;
                $detailDefaut->save();
            }
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }
            if ($m17->Bis == "true") $m17->Bis_t = 'checked'; else $m17->Bis_t = "";
            return response()->json(array('m17' => $m17), 200);
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
        $m17 = \App\Visuel\M17::findOrFail($id);
        $oldDefs=$m17->defs;
        if(Auth::check() && Auth::user()->role=="Chef Production"){
            $Edit=new RapportsEdits();
            $Edit->Operation="Delete";
            $Edit->Item=$m17->Tube;
            $Edit->Zone="Z05";
            $Edit->NumeroRap=$m17->NumeroRap;
            $Edit->ItemId=$m17->Id;
            $Edit->User=Auth::user()->username;
            $Edit->Computer=gethostname();
            $Edit->DateSaisie=date('Y-m-d H:i:s');
        }
        if ($m17->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit->save();
            }
            $m17->tube->Z05 = false;
            $m17->tube->save();
            foreach ($oldDefs as $olddef) {
                DetailDefauts::destroy($olddef->id);
            }
            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
