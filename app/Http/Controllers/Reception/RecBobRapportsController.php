<?php

namespace App\Http\Controllers\Reception;

use App\Dashboard\Agents;
use App\Dashboard\Locations;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RecBobRapportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())
            ->where("Zone",'=','RecBob')->first();
        $agents = $location->agents();
        $rapports=DB::select('select * from rapports where "Zone"=\'RecBob\' order by "DateSaisie" desc limit 3');
        return view ('Reception.RecBobRapports',[
            'agents'=>$agents
            ,'rapports'=>$rapports
            ,'details'=>$details ]);
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
        if(Hash::check($request->codeAgent,Agents::where('NomPrenom','=',$request->agent)->first()->Code)){
        $rapport = new Rapport();
        $rapport->Pid=detailprojet::find($request->detail_project)->Pid;
        $rapport->Did= $request->detail_project;
        $rapport->DateRapport= $request->date;
        $rapport->Zone='RecBob';
        $rapport->Machine='0';
        $rapport->Equipe= '0';
        $rapport->Poste= '0';
        $rapport->NomAgents= $request->agent;
        $rapport->Etat='N';
        $rapport->Computer=gethostname();
        $rapport->User=$request->agent;
        $rapport->DateSaisie= date('Y-m-d H:i:s');
        if($rapport->save()) {
            return redirect(route('RecBob.show',['id'=>$rapport->Numero]));
        }
    }else{
            $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
            $location=Locations::where('AdresseIp',\Illuminate\Support\Facades\Request::ip())
                ->where("Zone",'=','RecBob')->first();
            $agents = $location->agents();
            $rapports=DB::select('select * from rapports where "Zone"=\'RecBob\' order by "DateSaisie" desc limit 3');
            return view ('Reception.RecBobRapports',[
                'agents'=>$agents
                ,'rapports'=>$rapports
                ,'details'=>$details ,
                'Error'=>'Code Incorrect']);
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
        $rapport= Rapport::where('Numero','=',$id)->where('Zone','=','RecBob')->first();
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
        if(sizeof($rapport->RecBob) ){
        }else{
            $rapport->delete();
        }
        return redirect(route('rapports_RecBob.index'));
    }
}
