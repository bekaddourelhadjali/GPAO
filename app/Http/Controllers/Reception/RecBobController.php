<?php

namespace App\Http\Controllers\Reception;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecBobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('rapports_RecBob.index'));
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

        $bobine = Bobine::where("Bobine", '=', $request->bobine)->where('Coulee', '=', $request->coulee)
            ->where('Did','=',$request->Did)->whereNull('DateRec')->first();
        if ($bobine) {
            $bobine->Did = $request->Did;
            $bobine->Pid = $request->Pid;
            $bobine->Fournisseur = $request->Fournisseur;
            $bobine->NbReception = $request->NbReception;
            $bobine->DateRec = $request->DateRec;
            $bobine->Source = $request->Source;
            $bobine->NbBon = $request->NbBon;
            $bobine->Etat = 'REC';
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $bobine->User=Auth::user()->username;
            }else{
                $bobine->User = Rapport::find($request->NumRap)->NomAgents;
            }

            $bobine->Computer = gethostname();
            $bobine->NumeroRap = $request->NumRap;
            if ($bobine->save()) {
                if(Auth::check() && Auth::user()->role=="Chef Production"){
                    $Edit=new RapportsEdits();
                    $Edit->Operation="Add";
                    $Edit->Item=$bobine->Bobine;
                    $Edit->Zone="RecBob";
                    $Edit->NumeroRap=$bobine->NumeroRap;
                    $Edit->ItemId=$bobine->Id;
                    $Edit->User=Auth::user()->username;
                    $Edit->Computer=gethostname();
                    $Edit->DateSaisie=date('Y-m-d H:i:s');
                    $Edit->save();
                }
                return response()->json(array('RecBob' => $bobine), 200);
            } else {
                return response()->json(array('error' => error), 404);
            }
            return response()->json(array('message' => "Bobine N'existe pas"), 404);
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

        $rapport = Rapport::find($id);
        if ($rapport != null) {
            if ($rapport->Zone == 'RecBob'||(Auth::check() && Auth::user()->role == "Chef Production")) {
                $bobines = Bobine::where('NbReception','=',null)->where('Did','=',$rapport->Did)->where('Epaisseur','=',detailprojet::find($rapport->Did)->Epaisseur)->select('Bobine')->get();
                $coulees = Bobine::where('NbReception','=',null)->where('Did','=',$rapport->Did)->where('Epaisseur','=',detailprojet::find($rapport->Did)->Epaisseur)->select('Coulee')->distinct('Coulee')->get();
                if ($rapport->Etat == 'N'||Auth::check()) {
                    $maxArr = Bobine::where('Etat', '=', 'NonREC')->where('Did','=',$rapport->Did)->max('Arrivage');
                    $maxRec = Bobine::where('Did','=',$rapport->Did)->max('NbReception') + 1;
                    return view('Reception.RecBobine',
                        ['rapport' => $rapport,
                            'bobines' => $bobines,
                            'coulees' => $coulees,
                            'RecBob' => $rapport->RecBob,
                            'maxRec' => $maxRec,
                            'maxArr' => $maxArr,
                        ]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_RecBob.index'));
                }
            } else {
                return redirect(route('rapports_RecBob.index'));
            }
        } else {
            return redirect(route('rapports_RecBob.index'));
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
        $bobines = Bobine::where('NbReception', '=', null)->where('Did', '=', $id)->where('Epaisseur','=',detailprojet::find($id)->Epaisseur)->select('Bobine')->get();
        $coulees = Bobine::where('NbReception', '=', null)->where('Did', '=', $id)->where('Epaisseur','=',detailprojet::find($id)->Epaisseur)->select('Coulee')->distinct('Coulee')->get();
        return response()->json(array('bobines' => $bobines, 'coulees' => $coulees), 200);
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
        $bobine = Bobine::find($id);
        $bobine->Fournisseur = $request->Fournisseur;
        $bobine->NbReception = $request->NbReception;
        $bobine->DateRec = $request->DateRec;
        $bobine->Source = $request->Source;
        $bobine->NbBon = $request->NbBon;
        $bobine->NumeroRap = $request->NumRap;
        if ($bobine->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Update";
                $Edit->Item=$bobine->Bobine;
                $Edit->Zone="RecBob";
                $Edit->NumeroRap=$bobine->NumeroRap;
                $Edit->ItemId=$bobine->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            return response()->json(array('RecBob' => $bobine), 200);
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
        $bobine = Bobine::find($id);
        $bobine->Fournisseur = null;
        $bobine->NbReception = null;
        $bobine->DateRec = null;
        $bobine->Source = null;
        $bobine->NbBon = null;
        $bobine->Etat = 'NonREC';
        $bobine->Computer = null;
        $bobine->User = null;
        $numRap= $bobine->NumeroRap ;
        $bobine->NumeroRap = null;
        if ($bobine->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Production"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Delete";
                $Edit->Item=$bobine->Bobine;
                $Edit->Zone="RecBob";
                $Edit->NumeroRap=$numRap;
                $Edit->ItemId=$bobine->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            return response()->json(array('RecBob' => $bobine), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }
}
