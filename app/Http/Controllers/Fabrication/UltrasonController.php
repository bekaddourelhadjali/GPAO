<?php

namespace App\Http\Controllers\Fabrication;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Fabrication\Ultrason;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UltrasonController extends Controller
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

        $us = new Ultrason();
        $rapport=Rapport::find($request->NumRap);
        $tube = Tube::where('NTube', '=', $request->ntube)->where('Machine','=',$rapport->Machine)->where('Did', '=', $request->Did)->first();
        $us->NumTube = $tube->NumTube;
        $us->Pid = $request->Pid;
        $us->Did = $request->Did;
        $us->NumeroRap = $request->NumRap;
        $us->Machine = $tube->Machine;
        $us->Ntube = $tube->NTube;
        $us->Tube = $tube->Tube;
        $us->Coulee = $request->Coulee;
        $us->Bobine = $request->Bobine;
        $us->MB = $request->MB;
        $us->S = $request->S;
        $us->RB = ($request->RB ? true : false);
        $us->Observation = $request->observation;
        $us->Computer = gethostname();
        $us->User = $rapport->NomAgents;
        $us->DateSaisie = date('Y-m-d H:i:s');
        if ($us->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$us->Tube;
                $Edit->Zone="US";
                $Edit->NumeroRap=$us->NumeroRap;
                $Edit->ItemId=$us->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            if ($us->RB == "true") $us->RB_t = 'checked'; else $us->RB_t = "";

            return response()->json(array('ultrason' => $us), 200);
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
            if ($rapport->Zone == 'US') {
                if ($rapport->Machine == "E") {
                    $tubes = \App\Fabrication\Rapprod::where('Did', '=', $rapport->Did)->where("Machine",'=',"E")
                        ->whereNotIn('Ntube', function($query) {
                            $query->select('Ntube')
                                ->from('ultrason');
                        })->select(['NumTube','Bobine','Coulee','Ntube' ])->get();
                } else {
                    $tubes = \App\Fabrication\Rapprod::where('Did', '=', $rapport->Did)->where("Machine",'!=',"E")
                        ->whereNotIn('Ntube', function($query) {
                            $query->select('Ntube')
                                ->from('ultrason');
                        })->select(['NumTube','Bobine','Coulee','Ntube' ])->get();
                }
                $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                if ($rapport->Etat == 'N'||(Auth::check() && Auth::user()->role == "Chef Controle")) {
                    $rapprods = $rapport->rapprods;
                    return view('Fabrication.Ultrason',
                        ['rapport' => $rapport,
                            'tubes' => $tubes,
                            'ultrasons' => $rapport->ultrasons,
                            'detailP' => $detailP]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_Ultrason.index'));
                }
            } else {
                return redirect(route('rapports_Ultrason.index'));
            }
        } else {
            return redirect(route('rapports_Ultrason.index'));
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
        $us = Ultrason::find($id);
        $us->S = $request->S;
        $us->MB = $request->MB;
        $us->RB = ($request->RB ? true : false);
        $us->Observation = $request->Observation;
        $us->DateSaisie = date('Y-m-d H:i:s');
        if ($us->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$us->Tube;
                $Edit->Zone="US";
                $Edit->NumeroRap=$us->NumeroRap;
                $Edit->ItemId=$us->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            if ($us->RB == "true") $us->RB_t = 'checked'; else $us->RB_t = "";
            return response()->json(array('ultrason' => $us), 200);
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
        $us = \App\Fabrication\Ultrason::findOrFail($id);
        if(Auth::check() && Auth::user()->role=="Chef Controle"){
            $Edit=new RapportsEdits();
            $Edit->Operation="Delete";
            $Edit->Item=$us->Tube;
            $Edit->Zone="US";
            $Edit->NumeroRap=$us->NumeroRap;
            $Edit->ItemId=$us->Id;
            $Edit->User=Auth::user()->username;
            $Edit->Computer=gethostname();
            $Edit->DateSaisie=date('Y-m-d H:i:s');
        }
        if ($us->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit->save();
            }
            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
