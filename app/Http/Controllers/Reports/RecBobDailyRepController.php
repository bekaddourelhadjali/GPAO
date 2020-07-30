<?php

namespace App\Http\Controllers\Reports;

use App\Fabrication\Bobine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecBobDailyRepController extends Controller
{
    public function index()
    {
            $RecBobReport = Bobine::where("DateRec",'=',[ date('Y-m-d')])
                ->select('Id','Coulee','Bobine','Poids','Arrivage','Epaisseur','LargeurBande','NumeroRap',
                    'Fournisseur','NbReception','Source','NbBon','User')->get();
            $nbT=sizeof($RecBobReport->toArray());
            $pT=array_sum(array_column($RecBobReport->toArray(),"Poids"))/1000;

        return view('Reports.RecBobDailyRep', [
                'RecBobReport' => $RecBobReport,
                'nbT' => $nbT,
                'pT' => $pT,
            ]
        );
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  $RecBobReport = DB::table('bobine')
        ->join('rapports', 'bobine.NumeroRap', '=', 'rapports.Numero')
        ->where("DateRec",'=',$id)
        ->select('Id','rapports.Etat','Coulee','Bobine','Poids','Arrivage','Epaisseur','LargeurBande','NumeroRap',
            'Fournisseur','NbReception','Source','NbBon','rapports.User')->get();

        $nbT=sizeof($RecBobReport->toArray());
        $pT=array_sum(array_column($RecBobReport->toArray(),"Poids"))/1000;

        return response()->json(array(
            'reports' => $RecBobReport,
            'nbT' => $nbT,
            'pT' => $pT,), 200);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
