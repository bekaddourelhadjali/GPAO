<?php

namespace App\Http\Controllers\Reports\VF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VFReportController extends Controller
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
        $VFReport=[];
        $OperationsReport=[];
        $DefautsReport=[];
        $MonthLT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearLT = 0;
        $YearNBT = 0;
        $YearPT = 0;
        if(sizeof($details)>0){

            $VFReport = DB::select('select "DateSaisie"::date,"Poste","Machine",count(*) "NBT",SUM("Longueur") "LongueurTotal", 
            SUM("Poids") "PoidsTotal" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport" where "Did"=?) q1  group by "DateSaisie"::date,"Poste","Machine" ', [$details[0]->Did]);


        $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport" 
                      where "Did"=? and "Zone"=\'Z10\'  group by "Opr"   '
            , [$details[0]->Did]);
        $DefautsReport = DB::select('select "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z10\' and "Defaut" is not null  group by "Defaut"  '
            , [$details[0]->Did]);

        }
        foreach($VFReport as $item){

        $time=strtotime($item->DateSaisie);
        $month = date("m",$time);
        $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthPT+=$item->PoidsTotal;
                $MonthNBT+=$item->NBT;
                $MonthLT+=$item->LongueurTotal;
            }
            if($year==date('Y')){
                $YearPT+=$item->PoidsTotal;
                $YearNBT+=$item->NBT;
                $YearLT+=$item->LongueurTotal;
            }
        }
        return view('Reports.VF.VFReport', [
                'reports' => $VFReport,
                'MonthLT' => $MonthLT,
                'MonthNBT' => $MonthNBT,
                'MonthPT' => $MonthPT,
                'YearLT' => $YearLT,
                'YearNBT' => $YearNBT,
                'YearPT' => $YearPT,
                'details' => $details,
                'DefautsReport' => $DefautsReport,
                'OperationsReport' => $OperationsReport,
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
        $VFReport = DB::select('select "DateSaisie"::date,"Poste","Machine",count(*) "NBT",SUM("Longueur") "LongueurTotal", 
            SUM("Poids") "PoidsTotal" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport" where "Did"=?) q1  group by "DateSaisie"::date,"Poste","Machine" ', [$id]);

        $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport" 
                      where "Did"=? and "Zone"=\'Z10\'  group by "Opr"   '
            , [$id ]);
        $DefautsReport = DB::select('select "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z10\'  and "Defaut" is not null  group by "Defaut"   '
            , [$id ]);
        $MonthLT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearLT = 0;
        $YearNBT = 0;
        $YearPT = 0;

        foreach($VFReport as $item){

            $time=strtotime($item->DateSaisie);
            $month = date("m",$time);
            $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthPT+=$item->PoidsTotal;
                $MonthNBT+=$item->NBT;
                $MonthLT+=$item->LongueurTotal;
            }
            if($year==date('Y')){
                $YearPT+=$item->PoidsTotal;
                $YearNBT+=$item->NBT;
                $YearLT+=$item->LongueurTotal;
            }
        }
        return response()->json(array(
            'reports' => $VFReport,
            'MonthLT' =>  $MonthLT,
            'MonthNBT' => $MonthNBT,
            'MonthPT' =>  $MonthPT,
            'YearLT' =>   $YearLT,
            'YearNBT' =>  $YearNBT,
            'YearPT' =>   $YearPT,
            'DefautsReport' => $DefautsReport,
            'OperationsReport' => $OperationsReport,
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
