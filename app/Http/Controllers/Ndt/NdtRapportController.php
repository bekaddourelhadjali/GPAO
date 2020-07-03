<?php

namespace App\Http\Controllers\Ndt;

use App\Dashboard\Locations;
use App\Fabrication\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NdtRapportController extends Controller
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
        $projet= \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $details = $projet->details;
        $agents = $location->agents;
        $machines = $location->machines;
        $rapports=DB::select('select * from rapports where "Zone"=\'Z07\' order by "DateSaisie" desc limit 3');
        return view ('Ndt.NdtRapports',['details'=>$details
            ,'postes'=>$postes
            ,'machines'=>$machines
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
        $rapport->Zone='Z07';
        $rapport->Equipe= $request->equipe;
        $rapport->Machine= $request->machine;
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent;
        $rapport->NomAgents1= $request->agent2;
        $rapport->CodeAgent= $request->codeAgent ;
        $rapport->CodeAgent1= $request->codeAgent2;
        $rapport->Etat='N';
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
            return redirect(route('Ndt.show',['id'=>$rapport->Numero]));
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
        $results=DB::select('Select * from public.rapports where "Numero" in (SELECT "NumeroRap"  FROM public.ndt where  "Tube"=?)',[$id]);
        if ($results!=null){
            return response()->json(array('rapports'=> $results), 200);
        }else{
            return response()->json(array('error'=> error), 404);

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
        if(sizeof($rapport->ndt) || sizeof($rapport->arrets)){

        }else{
            $rapport->delete();
        }
        return redirect(route('rapports_Ndt.index'));
    }
}
