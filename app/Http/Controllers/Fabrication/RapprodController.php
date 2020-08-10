<?php

namespace App\Http\Controllers\Fabrication;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapprodController extends Controller
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
        $validity=DB::select('select "PoidsCons","LangCons",(("Longueur"+5)>=("LangCons"+round(cast(?/1000 as numeric)))) "valid" from "bobinedetails" bd where bd."Bobine"=?
      and bd."Coulee"=? and  bd."Did"=?', [$request->longueur, $request->bobine, $request->coulee, $request->Did])[0];
        $valid=$validity->valid;
        if ($valid || ($validity->PoidsCons==null&&$validity->LangCons==null)) {
            $rapport=Rapport::find($request->NumeroRap);

            $rapprod = Rapprod::where('Tube', '=', $request->machine . $request->ntube)
                ->where('NumeroRap', '=', $request->NumeroRap)->first();
            if ($rapprod != null) {
                return response()->json(array('error' => 'Le tube n°=' . $rapprod->Tube . ' existe Déja'), 404);
            } else {


                $rapprod = new Rapprod();
                $rapprod->Pid = $request->Pid;
                $rapprod->Did = $request->Did;
                $rapprod->Bobine = $request->bobine;
                $rapprod->Coulee = $request->coulee;
                $rapprod->Machine = $request->machine;
                $rapprod->Tube = $rapprod->Machine . $request->ntube;
                $rapprod->Ntube = $request->ntube;
                $rapprod->NumeroRap = $request->NumeroRap;
                $rapprod->Longueur = $request->longueur;
                if ($request->rb == 'true') $rapprod->RB = 1;
                else $rapprod->RB = 0;
                if ($request->macro == 'true') $rapprod->Macro = 1;
                else $rapprod->Macro = 0;
                if ($request->sur_mas == 'true') $rapprod->Observation = $rapprod->Observation . "Sur Mas, ";
                if ($request->test_1 == 'true') $rapprod->Observation = $rapprod->Observation . "Test (1), ";
                if ($request->test_3 == 'true') $rapprod->Observation = $rapprod->Observation . "Test (3), ";

                $rapprod->Observation = rtrim($rapprod->Observation, ', ');
                $tube = Tube::where('Tube', '=', $rapprod->Tube)
                    ->where('Bis', '=', false)
                    ->where('Pid', '=', $rapprod->Pid)
                    ->where('Did', '=', $rapprod->Did)->first();
                if ($tube != null) {
                    $tube = Tube::find($tube->NumTube);
                    if (!$tube->Z01) {
                        $tube->Z01 = true;
                        $tube->Bobine = $request->bobine;
                        $tube->Coulee = $request->coulee;
                        $tube->DateFab = date('Y-m-d');
                        $tube->save();
                    }
                } else {
                    $tube = new Tube();
                    $tube->Pid = $request->Pid;
                    $tube->Did = $request->Did;
                    $tube->Machine = $request->machine;
                    $tube->NTube = $request->ntube;
                    $tube->Tube = $rapprod->Machine . $request->ntube;
                    $tube->Longueur = $request->longueur;
                    $tube->Bobine = $request->bobine;
                    $tube->Coulee = $request->coulee;
                    $tube->DateFab = date('Y-m-d');
                    $tube->User = $rapport->NomAgents;
                    $tube->Computer = gethostname();
                    $tube->DateSaisie = date('Y-m-d H:i:s');
                    $tube->Z01 = true;
                    $tube->save();
                }

                $rapprod->NumTube = $tube->NumTube;
                $rapprod->User = $rapport->NomAgents;
                $rapprod->Computer = gethostname();
                $rapprod->DateSaisie = date('Y-m-d H:i:s');
                if ($rapprod->save()) {
                    $bobine=Bobine::where('Bobine','=',$rapprod->Bobine)->where('Coulee','=',$rapprod->Coulee)
                        ->where('Did','=',$rapprod->Did)->first();
                    if(!$bobine->Cons){
                        $bobine->Machine=$rapprod->Machine;
                        $bobine->Cons=true;
                        $bobineConsMax=Bobine::where('Did','=',$rapprod->Did)->max("NbCons");
                        $bobine->NbCons=$bobineConsMax+1;
                        $bobine->DateCons=date('Y-m-d');
                        $bobine->save();
                    }
                    if(Auth::check() && Auth::user()->role=="Chef Production"){
                        $Edit=new RapportsEdits();
                        $Edit->Operation="Add";
                        $Edit->Item=$rapprod->Tube;
                        $Edit->Zone="Z01";
                        $Edit->NumeroRap=$rapprod->NumeroRap;
                        $Edit->ItemId=$rapprod->Numero;
                        $Edit->User=Auth::user()->username;
                        $Edit->Computer=gethostname();
                        $Edit->DateSaisie=date('Y-m-d H:i:s');
                        $Edit->save();
                    }
                    if ($rapprod->RB) $rapprod->RB_t = 'checked'; else $rapprod->RB_t = '';
                    if ($rapprod->Macro) $rapprod->Macro_t = 'checked'; else $rapprod->Macro_t = '';
                    return response()->json(array('rapprod' => $rapprod), 200);

                } else {
                    return response()->json(array('error' => error), 404);

                }
            }
        } else {
            return response()->json(array('message' => "La Longueur totale des tubes dépasse le poids de cette bobine"), 404);
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
            if ($rapport->Zone == 'Z01'||(Auth::check() && Auth::user()->role == "Chef Production")) {
                if ($rapport->Machine == "E") {
                    $bobines = Bobine::where('Etat', '=', 'MasEPrep')->where('Did','=',$rapport->Did)->select('Bobine')->get();
                    $coulees = Bobine::where('Etat', '=', 'MasEPrep')->where('Did','=',$rapport->Did)->select('Coulee')->distinct('Coulee')->get();
                } else {
                    $bobines = Bobine::where('Etat', '=', 'Prep')->where('Did','=',$rapport->Did)->select('Bobine')->get();
                    $coulees = Bobine::where('Etat', '=', 'Prep')->where('Did','=',$rapport->Did)->select('Coulee')->distinct('Coulee')->get();
                }

                if ($rapport->Etat == 'N'||Auth::check()) {
                    $rapprods = $rapport->rapprods;
                    return view('fabrication.rapprod',
                        ['rapport' => $rapport,
                            'bobines' => $bobines,
                            'coulees' => $coulees,
                            'rapprods' => $rapprods,
                            'projet' => $rapport->Project]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports.index'));
                }
            } else {
                return redirect(route('rapports.index'));
            }
        } else {
            return redirect(route('rapports.index'));
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
        $rapprod = Rapprod::findorFail($id);
        $validity=DB::select('select (("Longueur"+5)>=(("LangCons"-round(cast(?/1000 as numeric)))+round(cast(?/1000 as numeric)))) "valid" from "bobinedetails" bd where bd."Bobine"=?
           and bd."Coulee"=? and  bd."Did"=?',
            [$rapprod->Longueur, $request->longueur, $rapprod->Bobine, $rapprod->Coulee, $rapprod->Did])[0];
        $valid=$validity->valid;
        if ($valid || ($validity->PoidsCons==null&&$validity->LangCons==null)) {
            $rapprod->Longueur = $request->longueur;
            if ($request->rb == 'true') $rapprod->RB = 1;
            else $rapprod->RB = 0;
            if ($request->macro == 'true') $rapprod->Macro = 1;
            else $rapprod->Macro = 0;
            $rapprod->Observation = "";
            if ($request->sur_mas == 'true') $rapprod->Observation = $rapprod->Observation . "Sur Mas, ";
            if ($request->test_1 == 'true') $rapprod->Observation = $rapprod->Observation . "Test (1), ";
            if ($request->test_3 == 'true') $rapprod->Observation = $rapprod->Observation . "Test (3), ";
            $rapprod->Observation = rtrim($rapprod->Observation, ', ');
            $rapprod->DateSaisie = date('Y-m-d H:i:s');
            $tube = $rapprod->tube;
            $tube->Longueur = $request->longueur;
            $tube->DateFab = date('Y-m-d');
            $tube->DateSaisie = date('Y-m-d H:i:s');
            if ($rapprod->save() && $tube->save()) {
                if(Auth::check() && Auth::user()->role=="Chef Production"){
                    $Edit=new RapportsEdits();
                    $Edit->Operation="update";
                    $Edit->Item=$rapprod->Tube;
                    $Edit->Zone="Z01";
                    $Edit->NumeroRap=$rapprod->NumeroRap;
                    $Edit->ItemId=$rapprod->Numero;
                    $Edit->User=Auth::user()->username;
                    $Edit->Computer=gethostname();
                    $Edit->DateSaisie=date('Y-m-d H:i:s');
                    $Edit->save();
                }
                if ($rapprod->RB) $rapprod->RB_t = 'checked'; else $rapprod->RB_t = '';
                if ($rapprod->Macro) $rapprod->Macro_t = 'checked'; else $rapprod->Macro_t = '';
                return response()->json(array('rapprod' => $rapprod), 200);

            } else {
                return response()->json(array('error' => error), 404);

            }
        } else {
            return response()->json(array('message' => "La Longueur totale des tubes dépasse le poids de cette bobine"), 404);
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
        $rapprod = Rapprod::findOrFail($id);
        if(Auth::check() && Auth::user()->role=="Chef Production"){
        $Edit=new RapportsEdits();
        $Edit->Operation="update";
        $Edit->Item=$rapprod->Tube;
        $Edit->Zone="Z01";
        $Edit->NumeroRap=$rapprod->NumeroRap;
        $Edit->ItemId=$rapprod->Numero;
        $Edit->User=Auth::user()->username;
        $Edit->Computer=gethostname();
        $Edit->DateSaisie=date('Y-m-d H:i:s');

    }

        if ($rapprod->tube != null && (!$rapprod->tube->Z02)) $rapprod->tube->delete();
        else if ($rapprod->tube != null && $rapprod->tube->Z01) {
            $rapprod->tube->Z01 = false;
            $rapprod->tube->Bobine = null;
            $rapprod->tube->Coulee = null;
            $rapprod->tube->DateFab = null;
            $rapprod->tube->Longueur = 0;
            $rapprod->tube->DateSaisie = null;
            $rapprod->tube->save();

        } else {
        }
        $bobine=Bobine::where('Bobine','=',$rapprod->Bobine)->where('Coulee','=',$rapprod->Coulee)
            ->where('Did','=',$rapprod->Did)->first();
        if ($rapprod->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Production") {
                $Edit->save();
            }
            $tubesNb = Tube::where('Bobine', '=', $bobine->Bobine)
                ->where('Coulee', '=',  $bobine->Coulee)
                ->where('Did', '=',  $bobine->Did)->count();
            if($tubesNb==0){
                $bobine->Machine=null;
                $bobine->Cons=false;
                $bobine->NbCons=null;
                $bobine->DateCons=null;
                $bobine->save();
            }
            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
