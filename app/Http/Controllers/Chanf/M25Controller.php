<?php

namespace App\Http\Controllers\Chanf;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\m25;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m25 = new M25();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $m25->NumTube = $tube->NumTube;
        $m25->Pid = $request->Pid;
        $m25->Did = $request->Did;
        $m25->NumeroRap = $request->NumeroRap;
        $m25->Machine = $tube->Machine;
        $m25->Ntube = $tube->NTube;
        $m25->Tube = $tube->Tube;
        $m25->Bis = $tube->Bis;
        $m25->Debut = $request->Debut;
        $m25->Fin = $request->Fin;
        $m25->Observation = $request->Observation;
        $m25->Computer = gethostname();
        $m25->User = $rapport->NomAgents;
        $m25->DateSaisie = date('Y-m-d H:i:s');
        if ($m25->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$m25->Tube;
                $Edit->Zone="Z07";
                $Edit->NumeroRap=$m25->NumeroRap;
                $Edit->ItemId=$m25->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            $tube->Z07 = true;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapport = \App\Fabrication\Rapport::find($id);
        if ($rapport != null) {
            if ($rapport->Zone == 'Z07'||(Auth::check() && Auth::user()->role == "Chef Production")) {
                if ($rapport->Etat == 'N') {
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $detailP = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\'' . $rapport->Did . '\'')[0];
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('Chanf.M25',
                        ['rapport' => $rapport,
                            'm25' => $rapport->m25,
                            'details' => $details,
                            'detailP' => $detailP,
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
        $m25 = M25::find($id);
        $m25->Debut = $request->Debut;
        $m25->Fin = $request->Fin;
        $m25->Observation = $request->Observation;
        $m25->DateSaisie = date('Y-m-d H:i:s');
        if ($m25->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$m25->Tube;
                $Edit->Zone="Z07";
                $Edit->NumeroRap=$m25->NumeroRap;
                $Edit->ItemId=$m25->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m25 = \App\Visuel\M25::findOrFail($id);
        if(Auth::check() && Auth::user()->role=="Chef Production"){
            $Edit=new RapportsEdits();
            $Edit->Operation="Delete";
            $Edit->Item=$m25->Tube;
            $Edit->Zone="Z07";
            $Edit->NumeroRap=$m25->NumeroRap;
            $Edit->ItemId=$m25->Id;
            $Edit->User=Auth::user()->username;
            $Edit->Computer=gethostname();
            $Edit->DateSaisie=date('Y-m-d H:i:s');
        }
        if ($m25->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit->save();
            }
            $m25->tube->Z07 = false;
            $m25->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
