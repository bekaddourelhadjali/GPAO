<?php

namespace App\Http\Controllers\RX1;

use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RapportsRX1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())
            ->where("Zone",'=','Z03')->first();
        $agents = $location->agents();
        $rapports=DB::select('select * from rapports where "Zone"=\'Z03\' order by "DateSaisie" desc limit 3');
        return view ('RX1.rapportsRX1',[
            'agents'=>$agents
            ,'rapports'=>$rapports]);

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
    {   if( Hash::check($request->codeAgent,Agents::where('NomPrenom','=',$request->agent)->first()->Code)&&
        Hash::check($request->codeAgent2,Agents::where('NomPrenom','=',$request->agent2)->first()->Code)){
        $rapport = new Rapport();
        $rapport->Did= 0;
        $rapport->Pid= 0;
        $rapport->DateRapport= $request->date;
        $rapport->Zone='Z03';
        $rapport->Equipe= $request->equipe;
        $rapport->Machine= '3';
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent;
        $rapport->NomAgents1= $request->agent2;
        $rapport->Tension=$request->tension;
        $rapport->Intensite=$request->intensite;
        $rapport->TmpPose=$request->tmpPose;
        $rapport->DisBras=$request->disBras;
        $rapport->Etat='N';
        $rapport->Computer=gethostname();
        $rapport->User=$request->agent.'/'.$request->agent2;
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
             return redirect(route('RX1.show',['id'=>$rapport->Numero]));
            }
    }else{
        $ErrorAgent1=null;
        $ErrorAgent2=null;

        if(!Hash::check($request->codeAgent,Agents::where('NomPrenom','=',$request->agent)->first()->Code)){
            $ErrorAgent1="Code Incorrect";
        }
        if(!Hash::check($request->codeAgent2,Agents::where('NomPrenom','=',$request->agent2)->first()->Code)){
            $ErrorAgent2="Code Incorrect";
        }

        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())->first();
        $agents = $location->agents;
        $rapports=DB::select('select * from rapports where "Zone"=\'Z03\' order by "DateSaisie" desc limit 3');
        return view ('RX1.rapportsRX1',[
            'agents'=>$agents
            ,'rapports'=>$rapports,
            'ErrorAgent1'=>$ErrorAgent1,
            'ErrorAgent2'=>$ErrorAgent2]);

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
        $rapport= Rapport::where('Numero','=',$id)->where('Zone','=','Z03')->first();
        if (!empty($rapport)){
            return response()->json(array('rapport'=> $rapport), 200);
        }else{
            return response()->json(array('error'=> "Rapport N'existe Pas"), 404);

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
        if(sizeof($rapport->rx1) || sizeof($rapport->arrets)){

        }else{
            $rapport->delete();
        }
        return redirect(route('rapports_RX1.index'));

    }

}
