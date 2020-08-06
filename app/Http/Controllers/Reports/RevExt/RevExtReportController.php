<?php

namespace App\Http\Controllers\Reports\RevExt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RevExtReportController extends Controller
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
        $RevExtReport=[];
        if(sizeof($details)>0){

            $RevExtReport = DB::select('select "DateSaisie"::date,"Poste","Machine","Accepte","Aspect",count(*) "NBT",SUM("Longueur") "LongueurTotal", 
            SUM("Poids") "PoidsTotal" from "revextreport" where "Did"=? group by "DateSaisie"::date,"Poste","Machine","Accepte","Aspect" ', [$details[0]->Did]);

        }

        $MonthLT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearLT = 0;
        $YearNBT = 0;
        $YearPT = 0;

        foreach($RevExtReport as $item){

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
        return view('Reports.RevExt.RevExtReport', [
                'reports' => $RevExtReport,
                'MonthLT' => $MonthLT,
                'MonthNBT' => $MonthNBT,
                'MonthPT' => $MonthPT,
                'YearLT' => $YearLT,
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
        $RevExtReport = DB::select('select "DateSaisie"::date,"Poste","Machine","Accepte","Aspect",count(*) "NBT",SUM("Longueur") "LongueurTotal", 
            SUM("Poids") "PoidsTotal" from "revextreport" where "Did"=? group by "DateSaisie"::date,"Poste","Machine","Accepte","Aspect" ', [$id]);

        $MonthLT = 0;
        $MonthNBT = 0;
        $MonthPT = 0;
        $YearLT = 0;
        $YearNBT = 0;
        $YearPT = 0;

        foreach($RevExtReport as $item){

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
            'reports' => $RevExtReport,
            'MonthLT' =>  $MonthLT,
            'MonthNBT' => $MonthNBT,
            'MonthPT' =>  $MonthPT,
            'YearLT' =>   $YearLT,
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
