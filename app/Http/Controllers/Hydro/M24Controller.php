<?php

namespace App\Http\Controllers\Hydro;

use App\Fabrication\Rapport;
use App\Fabrication\Tube;
use App\Visuel\M24;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M24Controller extends Controller
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
        $m24 = new M24();
        $tubeBis=false;
        $tubeBisStr=substr($request->ntube,5,3);
        if($tubeBisStr=='bis'){
            $tubeBis=true;
        }
        $tube = Tube::where('Tube', '=', substr($request->ntube,0,5))->where('Bis','=',$tubeBis)->where('Did', '=', $request->Did)->first();
        $rapport=Rapport::find($request->NumeroRap);
        $m24->NumTube = $tube->NumTube;
        $m24->Pid = $request->Pid;
        $m24->Did = $request->Did;
        $m24->NumeroRap = $request->NumeroRap;
        $m24->Machine = $tube->Machine;
        $m24->Ntube = $tube->NTube;
        $m24->Tube = $tube->Tube;
        $m24->Bis = $tube->Bis;
        $m24->Pression = $request->Pression;
        $m24->Observation = $request->Observation;
        $m24->Computer = gethostname();
        $m24->User = $rapport->NomAgents;
        $m24->DateSaisie = date('Y-m-d H:i:s');
        if ($m24->save()) {
            $tube->Z06 = true;
            $tube->save();
            if ($m24->Bis == "true") $m24->Bis_t = 'checked'; else $m24->Bis_t = "";
           
            return response()->json(array('m24' => $m24), 200);
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
            if ($rapport->Zone == 'Z06') {
                if ($rapport->Etat == 'N') {
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->select(['NumTube', 'Tube', 'Bis'])->get();
                    $detailP=$details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\' and d."Did"=\''.$rapport->Did.'\'')[0];
                    return view('Hydro.M24',
                        ['rapport' => $rapport,
                            'm24' => $rapport->m24,
                            'detailP' => $detailP,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_24.index'));
                }

            } else {
                return redirect(route('rapports_24.index'));
            }
        } else {
            return redirect(route('rapports_24.index'));
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
        $m24 = M24::find($id);
        $m24->Pression = $request->Pression;
        $m24->Observation = $request->Observation;
        $m24->DateSaisie = date('Y-m-d H:i:s');
        if ($m24->save()) {
            if ($m24->Bis == "true") $m24->Bis_t = 'checked'; else $m24->Bis_t = "";
            return response()->json(array('m24' => $m24), 200);
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
        $m24 = \App\Visuel\M24::findOrFail($id);

        if ($m24->delete()) {
            $m24->tube->Z06 = false;
            $m24->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
