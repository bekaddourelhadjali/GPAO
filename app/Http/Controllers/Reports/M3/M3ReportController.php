<?php

namespace App\Http\Controllers\Reports\M3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M3ReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = array(
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet',
            8 => 'Août', 9 => 'Septembre', 10 => 'Octobre',
            11 => 'Novembre', 12 => 'Décembre');
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');

        if (sizeof($details) > 0)
            $M3Report = DB::select('select "Poste","DateSaisie"::date,"Nom","Epaisseur","Diametre","Arrivage","LargeurBande","Coulee","Etat",Count(*) "NBT", SUM("Poids")/1000 "PoidsTotal",SUM("ChuteTotal") "ChuteTotal" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" where m."Did"=?) q1 
  group by "Poste","DateSaisie"::date,"Nom","Epaisseur","Diametre","Arrivage","LargeurBande","Coulee","Etat" order by "DateSaisie" desc', [$details[0]->Did]);

        else
            $M3Report = [];

        $MonthCT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearCT = 0;
        $YearNBT = 0;
        $YearPT = 0;

        foreach($M3Report as $item){

        $time=strtotime($item->DateSaisie);
        $month = date("m",$time);
        $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthPT+=$item->PoidsTotal;
                $MonthNBT+=$item->NBT;
                $MonthCT+=$item->ChuteTotal;
            }
            if($year==date('Y')){
                $YearPT+=$item->PoidsTotal;
                $YearNBT+=$item->NBT;
                $YearCT+=$item->ChuteTotal;
            }
        }
        return view('Reports.M3.M3Report', [
                'reports' => $M3Report,
                'MonthCT' => $MonthCT,
                'MonthNBT' => $MonthNBT,
                'MonthPT' => $MonthPT,
                'YearCT' => $YearCT,
                'YearNBT' => $YearNBT,
                'YearPT' => $YearPT,
                'details' => $details,
                'monthW'=>$months[intval(date('m'))]
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
    {
        $months = array(
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet',
            8 => 'Août', 9 => 'Septembre', 10 => 'Octobre',
            11 => 'Novembre', 12 => 'Décembre');

            $M3Report = DB::select('select "Poste","DateSaisie"::date,"Nom","Epaisseur","Diametre","Arrivage","LargeurBande","Coulee","Etat",Count(*) "NBT", SUM("Poids")/1000 "PoidsTotal",SUM("ChuteTotal") "ChuteTotal" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-?)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" where m."Did"=?) q1 
  group by "Poste","DateSaisie"::date,"Nom","Epaisseur","Diametre","Arrivage","LargeurBande","Coulee","Etat" order by "DateSaisie" desc', [$request->Rive,$request->RiveE,$id]);

        $MonthCT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearCT = 0;
        $YearNBT = 0;
        $YearPT = 0;
        foreach($M3Report as $item){

            $time=strtotime($item->DateSaisie);
            $month = date("m",$time);
            $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthPT+=$item->PoidsTotal;
                $MonthNBT+=$item->NBT;
                $MonthCT+=$item->ChuteTotal;
            }
            if($year==date('Y')){
                $YearPT+=$item->PoidsTotal;
                $YearNBT+=$item->NBT;
                $YearCT+=$item->ChuteTotal;
            }
        }
        return response()->json(array(
            'reports' => $M3Report,
            'MonthCT' =>  $MonthCT,
            'MonthNBT' => $MonthNBT,
            'MonthPT' =>  $MonthPT,
            'YearCT' =>   $YearCT,
            'YearNBT' =>  $YearNBT,
            'YearPT' =>   $YearPT,
            'monthW'=>$months[intval(date('m'))]), 200);

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
