<?php

namespace App\Http\Controllers\RepM17;

use App\Fabrication\Tube;
use App\Visuel\M17;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M17Controller extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * Pid: $('#Pi
     * Did: $('#de
     * NumeroRap:
     * NumTube: $(
     * bis: $('#bi
     * Observation
     * LongCh: $('
     * defauts: de
     */
    public function store(Request $request)
    {
        $m17 = new M17();
        $tube = Tube::where('Tube', '=', $request->ntube)->where('Pid', '=', $request->Pid)->where('Did', '=', $request->Did)->first();
        $m17->NumTube = $tube->NumTube;
        $m17->Pid = $request->Pid;
        $m17->Did = $request->Did;
        $m17->NumeroRap = $request->NumeroRap;
        $m17->Machine = $tube->Machine;
        $m17->Ntube = $tube->NTube;
        $m17->Tube = $tube->Tube;
        $m17->Bis = $request->bis;
        $m17->LongCh = $request->LongCh;
        $m17->Observation = $request->Observation;
        $m17->Operation = "Chuté";
        $m17->Oxyc = $request->oxyc;
        $m17->RB = $request->rb;
        $m17->Eprouv = $request->Eprouv;
        $m17->NdHt = $request->ndht;
        $m17->Vis = $request->vis;
        $m17->Scop = $request->scope;
        $m17->Final = $request->final;
        $m17->DdbFt = $request->DdbFt;
        $m17->DateSaisie = date('Y-m-d H:i:s');
        if ($m17->save()) {
            $tube->Z11 = true;
            $tube->save();
            if ($m17->Bis == "true") $m17->Bis_t = 'checked'; else $m17->Bis_t = "";
            if ($m17->Oxyc == "true") $m17->Oxyc_t = 'checked'; else $m17->Oxyc_t = "";
            if ($m17->RB == "true") $m17->RB_t = "checked"; else $m17->RB_t = "";
            if ($m17->Eprouv == "true") $m17->Eprouv_t = "checked"; else $m17->Eprouv_t = "";
            if ($m17->NdHt == "true") $m17->NdHt_t = "checked"; else $m17->NdHt_t = "";
            if ($m17->Vis == "true") $m17->Vis_t = "checked"; else $m17->Vis_t = "";
            if ($m17->Scop == "true") $m17->Scop_t = "checked"; else $m17->Scop_t = "";
            if ($m17->Final == "true") $m17->Final_t = "checked"; else $m17->Final_t = "";
            if ($m17->DdbFt == "true") $m17->DdbFt_t = "checked"; else $m17->DdbFt_t = "";
            return response()->json(array('m17' => $m17), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rapport = \App\Fabrication\Rapport::find($id);
        if ($rapport != null) {
            if ($rapport->Zone == 'Z11') {
                if ($rapport->Etat == 'N') {
                    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
                    $tubes = \App\Fabrication\Tube::where('Did', '=', $rapport->Did)->where('Pid', '=', $rapport->Pid)->select(['NumTube', 'Tube', 'Bis'])->get();

                    return view('RepM17.M17',
                        ['rapport' => $rapport,
                            'm17' => $rapport->m17,
                            'projet' => $projet,
                            'tubes' => $tubes,
                            'arrets' => $rapport->arrets,]);
                } elseif ($rapport->Etat == 'C') {
                    return redirect(route('rapports_M17.index'));
                }

            } else {
                return redirect(route('rapports_M17.index'));
            }
        } else {
            return redirect(route('rapports_M17.index'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $m17 = M17::find($id);
        $m17->Bis = $request->bis;
        $m17->LongCh = $request->LongCh;
        $m17->Observation = $request->Observation;
        $m17->Oxyc = $request->oxyc;
        $m17->RB = $request->rb;
        $m17->Eprouv = $request->Eprouv;
        $m17->NdHt = $request->ndht;
        $m17->Vis = $request->vis;
        $m17->Scop = $request->scope;
        $m17->Final = $request->final;
        $m17->DdbFt = $request->DdbFt;
        $m17->DateSaisie = date('Y-m-d H:i:s');
        if ($m17->save()) {
            if ($m17->Bis == "true") $m17->Bis_t = 'checked'; else $m17->Bis_t = "";
            if ($m17->Oxyc == "true") $m17->Oxyc_t = 'checked'; else $m17->Oxyc_t = "";
            if ($m17->RB == "true") $m17->RB_t = "checked"; else $m17->RB_t = "";
            if ($m17->Eprouv == "true") $m17->Eprouv_t = "checked"; else $m17->Eprouv_t = "";
            if ($m17->NdHt == "true") $m17->NdHt_t = "checked"; else $m17->NdHt_t = "";
            if ($m17->Vis == "true") $m17->Vis_t = "checked"; else $m17->Vis_t = "";
            if ($m17->Scop == "true") $m17->Scop_t = "checked"; else $m17->Scop_t = "";
            if ($m17->Final == "true") $m17->Final_t = "checked"; else $m17->Final_t = "";
            if ($m17->DdbFt == "true") $m17->DdbFt_t = "checked"; else $m17->DdbFt_t = "";
            return response()->json(array('m17' => $m17), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m17 = \App\Visuel\M17::findOrFail($id);

        if ($m17->delete()) {
            $m17->tube->Z11 = false;
            $m17->tube->save();

            return response()->json(array('success' => true), 200);

        } else {
            return response()->json(array('error' => true), 404);
        }
    }
}
