<?php

namespace App\Http\Controllers\Reports\US;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class USReportController extends Controller
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
        $USReport=[];
        if(sizeof($details)>0){

            $USReport = DB::select('select "DateSaisie"::date,"Epaisseur","Diametre","Poste","Machine","Coulee","Bobine",
                    Count(*) "NBT",COUNT(CASE WHEN "RB" = true then 1 ELSE NULL END) as "nbRB" from "usreport" where "Did"=?
                    group by "DateSaisie"::date,"Epaisseur","Diametre","Poste","Machine","Coulee","Bobine" order by "DateSaisie"::date Desc  ',[$details[0]->Did ]);
        }

        $MonthRB = 0;
        $MonthNBT = 0;
        $YearRB = 0;
        $YearNBT = 0;

        foreach($USReport as $item){

        $time=strtotime($item->DateSaisie);
        $month = date("m",$time);
        $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){ 
                $MonthNBT+=$item->NBT;
                $MonthRB+=$item->nbRB;
            }
            if($year==date('Y')){ 
                $YearNBT+=$item->NBT;
                $YearRB+=$item->nbRB;
            }
        }
        return view('Reports.US.USReport', [
                'reports' => $USReport,
                'MonthRB' => $MonthRB,
                'MonthNBT' => $MonthNBT, 
                'YearRB' => $YearRB,
                'YearNBT' => $YearNBT, 
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
        $USReport = DB::select('select "DateSaisie"::date,"Epaisseur","Diametre","Poste","Machine","Coulee","Bobine",
                    Count(*) "NBT",COUNT(CASE WHEN "RB" = true then 1 ELSE NULL END) as "nbRB" from "usreport" where "Did"=?
                    group by "DateSaisie"::date,"Epaisseur","Diametre","Poste","Machine","Coulee","Bobine" order by "DateSaisie"::date desc  ',[$id ]);

        $MonthRB = 0;
        $MonthNBT = 0;
        $YearRB = 0;
        $YearNBT = 0;

        foreach($USReport as $item){

            $time=strtotime($item->DateSaisie);
            $month = date("m",$time);
            $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthNBT+=$item->NBT;
                $MonthRB+=$item->nbRB;
            }
            if($year==date('Y')){
                $YearNBT+=$item->NBT;
                $YearRB+=$item->nbRB;
            }
        }
        return response()->json(array(
            'reports' => $USReport,
            'MonthRB' =>  $MonthRB,
            'MonthNBT' => $MonthNBT,
            'YearRB' =>   $YearRB,
            'YearNBT' =>  $YearNBT,
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
