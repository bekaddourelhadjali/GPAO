<?php

namespace App\Http\Controllers\Visuel;

use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Dashboard\Machines;
use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RapportsVisuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())
            ->where("Zone",'=','Z02')->first();
        $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $agents = $location->agents();
        $rapports=DB::select('select * from rapports where "Zone"=\'Z02\' order by "DateSaisie" desc limit 3');
        return view ('Visuel.rapportsV',['details'=>$details
            ,'agents'=>$agents
            ,'rapports'=>$rapports ]);

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
        if( Hash::check($request->codeAgent,Agents::where('NomPrenom','=',$request->agent)->first()->Code)&&
        Hash::check($request->codeAgent2,Agents::where('NomPrenom','=',$request->agent2)->first()->Code)){
        $rapport = new Rapport();
        $rapport->Pid= detailprojet::find($request->detail_project)->Project->Pid;
        $rapport->Did= $request->detail_project;
        $rapport->DateRapport= $request->date;
        $rapport->Zone='Z02';
        $rapport->Equipe= $request->equipe;
        $rapport->Machine= 'V';
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent ;
        $rapport->NomAgents1= $request->agent2;
        $rapport->Etat='N';
        $rapport->Computer=gethostname();
        $rapport->User=$request->agent.'/'.$request->agent2;
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
             return redirect(route('visuels.show',['id'=>$rapport->Numero]));
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

        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())->where("Zone",'=','Z02')->first();
        $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
            $agents = $location->agents();
        $rapports=DB::select('select * from rapports where "Zone"=\'Z02\' order by "DateSaisie" desc limit 3');
        return view ('Visuel.rapportsV',['details'=>$details
            ,'agents'=>$agents
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

        $rapport= Rapport::where('Numero','=',$id)->where('Zone','=','Z02')->first();
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
        if(sizeof($rapport->visuels) || sizeof($rapport->arrets)){

        }else{
            $rapport->delete();
        }
        return redirect(route('rapports_visuels.index'));

    }

}
