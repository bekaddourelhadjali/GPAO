<?php

namespace App\Http\Controllers\Expedition;

use App\Dashboard\RapportsEdits;
use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\Expedition;
use App\Visuel\M24;
use App\Visuel\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpeditionController extends Controller
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
        $exp = new Expedition();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $exp->NumTube = $tube->NumTube;
        $exp->Pid = $request->Pid;
        $exp->Did = $request->Did;
        $exp->NumeroRap = $request->NumeroRap;
        $exp->Ntube = $tube->NTube;
        $exp->Tube = $tube->Tube;
        $exp->Bis = $tube->Bis;
        $exp->NumBon = $request->NumBon;
        $exp->DateExpedition = $request->DateExpedition;
        $exp->Site = $request->Site;
        $exp->Transporteur = $request->Transporteur;
        $exp->Coulee = $request->Coulee;
        $exp->Poids = $request->Poids;
        $exp->NumExpedition = $request->NumExpedition;
        $exp->Longueur = $request->Longueur;
        $exp->Observation = $request->Observation;
        $exp->Computer = gethostname();
        $exp->User = $rapport->NomAgents;
        $exp->DateSaisie = date('Y-m-d H:i:s');
        if ($exp->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="Add";
                $Edit->Item=$exp->Tube;
                $Edit->Zone="Z14";
                $Edit->NumeroRap=$exp->NumeroRap;
                $Edit->ItemId=$exp->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            $tube->Z14 = true;
            $tube->save();
            if ($exp->Bis == "true") $exp->Bis_t = 'checked'; else $exp->Bis_t = "";
           
            return response()->json(array('exp' => $exp), 200);
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
            if ($rapport->Zone == 'Z14') {
                if ($rapport->Etat == 'N'||(Auth::check() && Auth::user()->role == "Chef Controle")) {
                    $tubes = DB::select('select t."NumTube" ,t."Tube",t."Bis",t."Coulee" from "reception" t where "NumTube" not in (
                   select "NumTube" from "expedition" r where r."Did"=?) and t."Did"=?',[$rapport->Did,$rapport->Did]);
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    $maxNumExp=Expedition::where('Did','=',$rapport->Did)->max('NumExpedition');
                    $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
                    return view('Expedition.Expedition',
                        ['rapport' => $rapport,
                            'maxNumExp'=>$maxNumExp+1,
                            'Expeditions' => $rapport->Expedition,
                            'detailP' => $detailP,
                            'details' => $details,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_Expedition.index'));
                }

            } else {
                return redirect(route('rapports_Expedition.index'));
            }
        } else {
            return redirect(route('rapports_Expedition.index'));
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
        //
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
        $exp = Expedition::find($id);
        $exp->NumBon = $request->NumBon;
        $exp->DateExpedition = $request->DateExpedition;
        $exp->Site = $request->Site;
        $exp->Transporteur = $request->Transporteur;
        $exp->Coulee = $request->Coulee;
        $exp->Poids = $request->Poids;
        $exp->NumExpedition = $request->NumExpedition;
        $exp->Longueur = $request->Longueur;
        $exp->Observation = $request->Observation;
        $exp->DateSaisie = date('Y-m-d H:i:s');
        if ($exp->save()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit=new RapportsEdits();
                $Edit->Operation="update";
                $Edit->Item=$exp->Tube;
                $Edit->Zone="Z14";
                $Edit->NumeroRap=$exp->NumeroRap;
                $Edit->ItemId=$exp->Id;
                $Edit->User=Auth::user()->username;
                $Edit->Computer=gethostname();
                $Edit->DateSaisie=date('Y-m-d H:i:s');
                $Edit->save();
            }
            if ($exp->Bis == "true") $exp->Bis_t = 'checked'; else $exp->Bis_t = "";
            return response()->json(array('exp' => $exp), 200);
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
        $exp = \App\Visuel\Expedition::findOrFail($id);
        if(Auth::check() && Auth::user()->role=="Chef Controle"){
            $Edit=new RapportsEdits();
            $Edit->Operation="Delete";
            $Edit->Item=$exp->Tube;
            $Edit->Zone="Z14";
            $Edit->NumeroRap=$exp->NumeroRap;
            $Edit->ItemId=$exp->Id;
            $Edit->User=Auth::user()->username;
            $Edit->Computer=gethostname();
            $Edit->DateSaisie=date('Y-m-d H:i:s');
        }
        if ($exp->delete()) {
            if(Auth::check() && Auth::user()->role=="Chef Controle"){
                $Edit->save();
            }
            $exp->tube->Z14 = false;
            $exp->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
