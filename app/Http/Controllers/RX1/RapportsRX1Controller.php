<?php

namespace App\Http\Controllers\Visuel;

use App\Dashboard\Locations;
use App\Dashboard\Machines;
use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportsVisuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes = DB::select('Select * from postes');
        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())->first();
        $machines = $location->machines;
        $projet= \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $details = $projet->details;
        $agents = $location->agents;
        $rapports=DB::select('select * from rapports where "Zone"=\'Z02\' order by "DateSaisie" desc limit 3');
        return view ('Visuel.rapportsV',['details'=>$details
            ,'machines'=>$machines
            ,'postes'=>$postes
            ,'agents'=>$agents
            ,'rapports'=>$rapports
            ,'projet'=>$projet]);

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
        $rapport = new Rapport();
        $rapport->Pid= $request->Pid;
        $rapport->Did= $request->detail_project;
        $rapport->DateRapport= $request->date;
        $rapport->Zone='Z02';
        $rapport->Equipe= $request->equipe;
        $rapport->Machine= $request->machine;
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent . " / ".$request->agent2;
        $rapport->CodeAgent= $request->codeAgent . " / ".$request->codeAgent2;
        $rapport->TSIFlux=0;
        $rapport->TSIFil=0;
        $rapport->TSEFlux=0;
        $rapport->TSEFil=0;
        $rapport->Flux=0;
        $rapport->Fil=0;
        $rapport->VSoudage=0;
        $rapport->LargCisAlge=0;
        $rapport->Etat='N';
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
             return redirect(route('visuels.show',['id'=>$rapport->Numero]));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rapport=\App\Fabrication\Rapport::find($id);
        if(sizeof($rapport->visuels) || sizeof($rapport->arrets)){

        }else{
            $rapport->delete();
        }
        return redirect(route('rapports_visuels.index'));

    }

}
