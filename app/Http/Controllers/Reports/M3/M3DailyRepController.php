<?php

namespace App\Http\Controllers\Reports\M3;

use App\Fabrication\Bobine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M3DailyRepController extends Controller
{
    public function index()
    {
        $M3Report = DB::select('select *,
 CASE WHEN "Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" where "DateSaisie"::date=?',[date('Y-m-d')]);

        $nbT=sizeof($M3Report);
        $pT=array_sum(array_column($M3Report,"Poids"))/1000;
        $pCT=round(array_sum(array_column($M3Report,"ChuteTotal")),3);

        return view('Reports.M3.M3DailyRep', [
                'reports' => (object) $M3Report,
                'nbT' => $nbT,
                'pCT' => $pCT,
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
    public function show(Request $request,$id)
    {   $M3Report=[];
        if($request->poste=='Tous'){
            $M3Report = DB::select('select *,
 CASE WHEN "Etat"=\'Prep\' then Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" where "DateSaisie"::date=? ',[$request->Rive,$request->RiveE,$id]);
        }else {
            $M3Report = DB::select('select *,
 CASE WHEN "Etat"=\'Prep\' then Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" where "Poste"=? and "DateSaisie"::date=? ', [$request->Rive, $request->RiveE, $request->poste, $id]);
        }
        $nbT=sizeof($M3Report);
        $pT=array_sum(array_column($M3Report,"Poids"))/1000;
        $pCT=round(array_sum(array_column($M3Report,"ChuteTotal")),3);

        return response()->json(array(
            'reports' =>  $M3Report,
            'nbT' => $nbT,
            'pCT' => $pCT,
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
