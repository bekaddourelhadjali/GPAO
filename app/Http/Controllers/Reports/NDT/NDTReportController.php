<?php

namespace App\Http\Controllers\Reports\NDT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NDTReportController extends Controller
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
        $NDTReport=[];
        if(sizeof($details)>0){

            $NDTReport = DB::select('select "DateSaisie"::date,"Poste","Machine",count(*) "NBT"  from "ndtreport" where "Did"=? group by "DateSaisie"::date,"Poste","Machine" ', [$details[0]->Did]);

        }
        $MonthNBT = 0;
        $YearNBT = 0;
        foreach($NDTReport as $item){

        $time=strtotime($item->DateSaisie);
        $month = date("m",$time);
        $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthNBT+=$item->NBT;
            }
            if($year==date('Y')){
                $YearNBT+=$item->NBT;
            }
        }
        return view('Reports.NDT.NDTReport', [
                'reports' => $NDTReport,
                'MonthNBT' => $MonthNBT,
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
        $NDTReport = DB::select('select "DateSaisie"::date,"Poste","Machine",count(*) "NBT"  from "ndtreport" where "Did"=? group by "DateSaisie"::date,"Poste","Machine" ', [$id]);

        $MonthNBT = 0;
        $YearNBT = 0;

        foreach($NDTReport as $item){

            $time=strtotime($item->DateSaisie);
            $month = date("m",$time);
            $year=date("Y",$time);
            if($month==date('m')&&$year==date('Y')){
                $MonthNBT+=$item->NBT;
            }
            if($year==date('Y')){
                $YearNBT+=$item->NBT;
            }
        }
        return response()->json(array(
            'reports' => $NDTReport,
            'MonthNBT' => $MonthNBT,
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
