<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecBobDailyRepController extends Controller
{
    public function index()
    {
         $month = array(
        1 => 'Janvier',2 => 'Février',3 => 'Mars',4 => 'Avril',
        5 => 'Mai',6 => 'Juin',7 => 'Juillet',
        8 => 'Août',9=> 'Septembre',10=> 'Octobre',
        11 => 'Novembre',12 => 'Décembre'   );
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');

        if (sizeof($details) > 0)
            $RecBobReport = DB::select('Select * from "recbobreport" where "Did"=?', [$details[0]->Did]);


    else
        $RecBobReport = [];
        $MonthRep = DB::select('SELECT    EXTRACT(month FROM "DateRec")  as "Month" ,Sum("NbTotal") as "NBT",Sum("PoidsTotal") as "PT" FROM "recbobreport"
                                  WHERE EXTRACT(month FROM "DateRec") =?
                                  AND EXTRACT(year FROM "DateRec") = ? and "Did"=? group by  EXTRACT(month FROM "DateRec") ', [date("m"),date("Y"),$details[0]->Did]);
        if(sizeof($MonthRep)>0){
            $MonthRep=$MonthRep[0];
            $MonthRep->Month=$month[$MonthRep->Month];
        }else{
            $MonthRep=null;
        }
        $YearRep = DB::select('SELECT    EXTRACT(year FROM "DateRec")  as "Year" ,Sum("NbTotal") as "NBT",Sum("PoidsTotal") as "PT" FROM "recbobreport" where
                                    EXTRACT(year FROM "DateRec") = ? and "Did"=? group by  EXTRACT(year FROM "DateRec") ' ,[date("Y"),$details[0]->Did]) ;

        if(sizeof($YearRep)>0){
            $YearRep=$YearRep[0];
        }else{
            $YearRep=null;
        }
        return view('Reports.RecBobReport', [
                'RecBobReport' => $RecBobReport,
                'MonthRep' => $MonthRep,
                'YearRep' => $YearRep,
                'details' => $details,
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
    {   $month = array(
        1 => 'Janvier',2 => 'Février',3 => 'Mars',4 => 'Avril',
        5 => 'Mai',6 => 'Juin',7 => 'Juillet',
        8 => 'Août',9=> 'Septembre',10=> 'Octobre',
        11 => 'Novembre',12 => 'Décembre'   );
        $Reports = DB::select('Select * from "recbobreport" where "Did"=?', [$id]);
        $MonthRep = DB::select('SELECT    EXTRACT(month FROM "DateRec")  as "Month" ,Sum("NbTotal") as "NBT",Sum("PoidsTotal") as "PT" FROM "recbobreport"
                                  WHERE EXTRACT(month FROM "DateRec") =?
                                  AND EXTRACT(year FROM "DateRec") = ? and "Did"=? group by  EXTRACT(month FROM "DateRec") ', [date("m"),date("Y"),$id]) ;
        if(sizeof($MonthRep)>0){
            $MonthRep=$MonthRep[0];
            $MonthRep->Month=$month[$MonthRep->Month];
        }else{
            $MonthRep=null;
        }
        $YearRep = DB::select('SELECT    EXTRACT(year FROM "DateRec")  as "Year" ,Sum("NbTotal") as "NBT",Sum("PoidsTotal") as "PT" FROM "recbobreport" where
                                    EXTRACT(year FROM "DateRec") = ? and "Did"=? group by  EXTRACT(year FROM "DateRec") ' ,[date("Y"),$id]) ;
        if(sizeof($YearRep)>0){
            $YearRep=$YearRep[0];
        }else{
            $YearRep=null;
        }
        return response()->json(array(
            'reports' => $Reports,
            'MonthRep' => $MonthRep,
            'YearRep' => $YearRep,), 200);

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
