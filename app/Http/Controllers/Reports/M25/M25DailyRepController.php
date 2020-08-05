<?php

namespace App\Http\Controllers\Reports\M25;

use App\Fabrication\Bobine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M25DailyRepController extends Controller
{
    public function index()
    {
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $M25Report = [];
        if (sizeof($details) > 0) {

            $M25Report = DB::select('select * from "m25report" where "Did"=?   and "DateSaisie"  between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$details[0]->Did]);
        }
        $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z07\' and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) ', [$details[0]->Did]);

        $nbT = sizeof($M25Report);
        $dureeTotal = array_sum(array_column($ArretsReport, "Durée"));
        return view('Reports.M25.M25DailyRep', [
                'reports' => (object)$M25Report,
                'nbT' => $nbT,
            'ArretsReport' => $ArretsReport,
            "ChartData" => [$dureeTotal, (24*60) - $dureeTotal],
            "ChartLabels" => ["Durée des arrets", "Durée de fonctionnement"],
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
    public function show(Request $request, $id)
    {
        $M25Report = [];
        $ArretsReport = [];
        if ($request->poste == 'Tous' && $request->Machine == 'Tous') {
            $M25Report = DB::select('select * from "m25report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  ', [$request->Did, $id, $id]);



        }
        else if ($request->poste != 'Tous' && $request->Machine == 'Tous') {
            $M25Report = DB::select('select * from "m25report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Poste"=?', [$request->Did, $id, $id, $request->poste]);



        }
        else if ($request->Machine != 'Tous' && $request->poste == 'Tous') {
            $M25Report = DB::select('select * from "m25report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=?', [$request->Did, $id, $id, $request->Machine]);



            }
            else {
            $M25Report = DB::select('select * from "m25report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=? and "Poste"=?'
                , [$request->Did, $id, $id, $request->Machine, $request->poste]);



        }
        if($request->poste == 'Tous'){
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z07\' and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'    ) ', [$request->Did, $id, $id]);

        }else{
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z07\' and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'   )  and "Poste"=?'
                , [$request->Did, $id, $id, $request->poste]);
        }


        $dureeTotal = array_sum(array_column($ArretsReport, "Durée"));
        $nbT = sizeof($M25Report);
        $dureeFonc = 0;
            if ($request->poste != 'Tous') {
                $dureeFonc = 8 * 60;
            } else {
                $dureeFonc = 24 * 60;
            }
        return response()->json(array(
            'reports' => $M25Report,
            'nbT' => $nbT,
            'poste' => $request->poste == 'Tous',
            'Machine' => $request->Machine == 'Tous',
            'ArretsReport' => $ArretsReport,
            "ChartData" => [$dureeTotal, $dureeFonc - $dureeTotal],
            "ChartLabels" => ["Durée des arrets", "Durée de fonctionnement"]
        ), 200);

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
