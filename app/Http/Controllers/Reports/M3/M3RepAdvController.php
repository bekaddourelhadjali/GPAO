<?php

namespace App\Http\Controllers\Reports\M3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M3RepAdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $M3Report = DB::select('select "Nom" as "Filter",Count(*) "NBT", SUM("Poids")/1000 "PT",SUM("ChuteTotal") "CT" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" ) q1 
  group by "Nom" ');
        return view('Reports.M3.M3RepAdv', [
                'M3Report' => $M3Report,
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
    {   if($id=="Largeur Bande") $id="LargeurBande";
        if($id=="Provenance") $id="Source";
        if($id=="Projet") $id="Nom";
        $Reports=DB::select('select "'.$id.'" as "Filter",Count(*) "NBT", SUM("Poids")/1000 "PT",SUM("ChuteTotal") "CT" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" ) q1 
  group by "'.$id.'" ',[$request->Rive,$request->RiveE] );
        return response()->json(array(
            'reports' => $Reports ), 200);

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
