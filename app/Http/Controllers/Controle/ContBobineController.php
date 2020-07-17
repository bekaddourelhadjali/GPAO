<?php

namespace App\Http\Controllers\Controle;

use App\Fabrication\Bobine;
use App\Fabrication\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContBobineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('rapports_RecBob.index'));
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
        $rapport=Rapport::find($request->NumRap);
        $path = $request->file('ListeColisage')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
            foreach($data->toArray() as $key => $row)
            {
                    $insert_data[] = array(
                        'Arrivage'  => $row['arrivage'],
                        'Coulee'   => $row['coulee'],
                        'Bobine'   => $row['bobine'],
                        'Poids'    => $row['poids_net']*1000,
                        'Poids_b'  => $row['poids_brut']*1000,
                        'Epaisseur'   => $row['epaisseur'],
                        'LargeurBande'   => $row['largeur_bande'],
                        'Pid'   => $request->Pid,
                        'Did'   => $request->Did,
                        'User'   =>gethostname(),
			'Computer'    =>gethostname(),
			'DateSaisie'  =>date('Y-m-d H:i:s'),
			'AgentAddSaisie'  =>$rapport->NomAgents,
			'RapportAddSaisie'  =>$rapport->Numero,
			'ZoneAddSaisie' =>'RecBob',
			'DateAddSaisie'  =>date('Y-m-d H:i:s'),
                    );
            }

            if(!empty($insert_data))
            {
                if(DB::table('bobine')->insert($insert_data)){

                    $bobinesCount=Bobine::where('NbReception','=',null)->select('Bobine')->count();
                    return response()->json(array('data' => $insert_data,'Count'=>$bobinesCount), 200);
                } else {
                    return response()->json(array('error' => error), 404);
               }

            }
        }
        return response()->json(array('error' => error), 404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapport=Rapport::find($id);
        $bobines=Bobine::where('NbReception','=',null)->where('Did','=',$rapport->Did)->select(['Id','Arrivage','Coulee','Bobine','Poids','Poids_b','Epaisseur','LargeurBande'])->get();
        return view('Controle.ContBobine',['bobines'=>$bobines,'rapport'=>$rapport]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {return redirect(route('rapports_RecBob.index'));
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
        $bobine= Bobine::find($id);
        $bobine->Bobine=$request->bobine;
        $bobine->Coulee=$request->coulee;
        $bobine->Poids=$request->poids;
        if(isset($request->poids_b)){
            $bobine->Poids_b=$request->poids_b;
        }
        if(isset($request->epaisseur)){
            $bobine->Epaisseur=$request->epaisseur;
        }
        if(isset($request->arrivage)){
            $bobine->Arrivage=$request->arrivage;
        }
        if(isset($request->largeur_bande)){
            $bobine->LargeurBande=$request->largeur_bande;
        }
        if ($bobine->save()){
            return response()->json(array('bobine'=> $bobine), 200);

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
    {   $bobine=Bobine::find($id);
        $bobDid=$bobine->Did;
        if(Bobine::destroy($id)){
            $bobinesCount=Bobine::where('NbReception','=',null)->where('Did','=',$bobDid)->select('Bobine')->count();
            return response()->json(array('success' => true,'Count'=>$bobinesCount), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }
}
