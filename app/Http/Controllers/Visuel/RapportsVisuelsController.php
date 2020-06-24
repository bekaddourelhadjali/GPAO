<?php

namespace App\Http\Controllers\Fabrication;

use App\Fabrication\Bobine;
use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes = DB::select('Select * from postes');
        $machines = DB::select('Select * from machine');
        $projet= \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $details = detailprojet::all();
        $operateurs = DB::select('Select * from operateurs');
        return view ('Fabrication.rapports',['details'=>$details
            ,'machines'=>$machines
            ,'postes'=>$postes
            ,'operateurs'=>$operateurs,
            'projet'=>$projet]);

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
        $rapport->Zone=1;
        $rapport->Equipe= $request->equipe;
        $rapport->Machine= $request->machine;
        $rapport->Poste= $request->poste;
        $rapport->NomAgents= $request->agent;
        $rapport->TSIFlux=0;
        $rapport->TSIFil=0;
        $rapport->TSEFlux=0;
        $rapport->TSEFil=0;
        $rapport->Flux=0;
        $rapport->Fil=0;
        $rapport->VSoudage=0;
        $rapport->LargCisAlge=0;
        $rapport->Etat='N';
        if($rapport->save()) {
             return redirect(route('rapprod.show',['id'=>$rapport->Numero]));
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
        if(sizeof($rapport->rapprods) || sizeof($rapport->arrets)){
            foreach($rapport->rapprods as $rapprod){
                $rapprod->tube->delete();
                $rapprod->delete();
            }
            foreach($rapport->arrets as $arret){
                $arret->delete();
            }
            foreach($rapport->operateurs as $operateur){
                $operateur->delete();
            }

        }
        $rapport->delete();
        return redirect(route('rapports.index'));

    }

}
