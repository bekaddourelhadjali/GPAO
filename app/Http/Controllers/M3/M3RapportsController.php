<?php

namespace App\Http\Controllers\M3;

use App\Dashboard\Locations;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class M3RapportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())->first();
        $projets= \App\Fabrication\Projet::where('Etat','!=','C')->get();
        $details = detailprojet::all();
        $agents = $location->agents;
        $rapports=DB::select('select * from rapports where "Zone"=\'Z00\' order by "DateSaisie" desc limit 3');
        return view ('M3.M3Rapports',['details'=>$details
            ,'agents'=>$agents
            ,'rapports'=>$rapports
            ,'projets'=>$projets]);
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
        $rapport->Zone='Z00';
        $rapport->Machine='0 ';
        $rapport->Equipe= $request->equipe;
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent;
        $rapport->CodeAgent= $request->codeAgent;
        $rapport->Etat='N';
        $rapport->Computer=gethostname();
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
            return redirect(route('M3.show',['id'=>$rapport->Numero]));
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
        //
    }
}
