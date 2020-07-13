<?php

namespace App\Http\Controllers\Visuel;

use App\Fabrication\detailprojet;
use App\Fabrication\Rapport;
use App\Fabrication\Rapprod;
use App\Fabrication\Tube;
use App\Http\Controllers\Controller;
use App\Visuel\Defauts;
use App\Visuel\Visuels;
use App\Visuel\DetailDefauts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisuelsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visuel = new Visuels();
        $visuel->Pid = $request->Pid;
        $visuel->Did = $request->Did;
        $visuel->Machine = $request->machine;
        $visuel->Tube = $visuel->Machine . $request->ntube;
        $visuel->Ntube = $request->ntube;
        $visuel->IdOpr = 1;
        $visuel->NbOpr = 1;
        $visuel->NumeroRap = $request->NumeroRap;
        if ($request->bis=='true') $visuel->Bis = 1;
        else $visuel->Bis = 0;
        if ($request->sond=='true') $visuel->Sond = 1;
        else $visuel->Sond = 0;
        $visuel->Longueur = $request->longueur;
        $visuel->E = $request->E;
        $visuel->Y = $request->Y;
        $visuel->DiamD = $request->Diam_D;
        $visuel->DiamF = $request->Diam_F;
        $visuel->ObsSoudure = $request->ObsSoudure;
        $visuel->ObsMetal = $request->ObsMetal;
        $visuel->DateSaisie= date('Y-m-d H:i:s');
        $visuel->Visible=1;
          $tube=Tube::where('Tube','=',$visuel->Tube)
              ->where('Pid','=',$visuel->Pid)
              ->where('Did','=',$visuel->Did)->first() ;
          if($tube!=null){
              $tube=Tube::find($tube->NumTube);
             $tube->DiamD = $request->Diam_D;
             $tube->DiamF = $request->Diam_F;
             $tube->Sond =$visuel->Sond;
             $tube->Z02=true;
         }else{
             $tube=new Tube();
             $tube->Pid = $visuel->Pid;
             $tube->Did = $visuel->Did;
             $tube->Machine = $visuel->Machine;
             $tube->NTube = $request->ntube;
             $tube->Tube = $visuel->Tube;
             $tube->Longueur = $request->longueur;
             $tube->Bis = $visuel->Bis;
             $tube->DiamD = $request->Diam_D;
             $tube->DiamF = $request->Diam_F;
             $tube->Sond =$visuel->Sond;
             $tube->Z02=true;
         }

         $tube->save();
          $visuel->NumTube=$tube->NumTube;
          $defauts=$request->Defauts;
        if ($visuel->save()){
            foreach ($defauts as $defaut){
                $detailDefaut=new \App\Visuel\DetailDefauts();
                $detailDefaut->Pid=$visuel->Pid;
                $detailDefaut->Did=$visuel->Did;
                $detailDefaut->Zone="Z02";
                $detailDefaut->NumRap=$request->NumeroRap;
                $detailDefaut->NumVisuel=$visuel->Numero;
                $detailDefaut->Tube=$visuel->Tube;
                $detailDefaut->Opr=$defaut[0];
                $detailDefaut->IdDef=$defaut[1];
                $detailDefaut->Defaut=$defaut[2];
                $detailDefaut->Valeur=$defaut[3];
                $detailDefaut->NbOpr=$defaut[4];
                $detailDefaut->Nombre=$defaut[5];
                $detailDefaut->save();
            }
            return response()->json(array('visuel'=> $visuel), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {$rapport =\App\Fabrication\Rapport::find($id);
        if($rapport!=null) {
    if($rapport->Zone=='Z02'){
           if ($rapport->Etat == 'N') {
               $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
               $defautsMetal= \App\Visuel\Defauts::where('Zone','=','Z02')->where('Descr','=','Metal')->get();
               $defautsSoudure= \App\Visuel\Defauts::where('Zone','=','Z02')->where('Descr','=','Soudure')->get();
               $operations= \App\Visuel\Operations::where('Zone','=','Z02')->get();
               return view('visuel.rapvisuel',
                   ['rapport' => $rapport,
                       'visuels'=>$rapport->visuels,
                       'projet' => $projet,
                       'arrets'=>$rapport->arrets,
                       'defautsMetal'=>$defautsMetal,
                       'defautsSoudure'=>$defautsSoudure
                       ,'operations'=>$operations]);
           } elseif ($rapport->Etat == 'C') {
               return redirect(route('rapports_visuels.index'));
           }

       }else{
           return redirect(route('rapports_visuels.index'));
       }
    }else{
        return redirect(route('rapports_visuels.index'));
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
        $visuel = Visuels::findorFail($id);
        if ($request->bis=='true') $visuel->Bis = 1;
        else $visuel->Bis = 0;
        if ($request->sond=='true') $visuel->Sond = 1;
        else $visuel->Sond = 0;
        $visuel->Longueur = $request->longueur;
        $visuel->E = $request->E;
        $visuel->Y = $request->Y;
        $visuel->DiamD = $request->Diam_D;
        $visuel->DiamF = $request->Diam_F;
        $tube=$visuel->tube;
        $tube->DiamD= $request->Diam_D;
        $tube->DiamF = $request->Diam_F;
        $tube->save();
        if ($visuel->save()){
            return response()->json(array('visuel'=> $visuel), 200);

        }else{
            return response()->json(array('error'=> error), 404);

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
        $visuel=\App\Visuel\Visuels::findOrFail($id);

        if ($visuel->delete()){
            foreach ($visuel->Defauts() as $Defaut){
                $Defaut->delete();
            }
            return response()->json(array('success'=> true), 200);

        }else{
            return response()->json(array('error'=> true), 404);
        }
    }
}
