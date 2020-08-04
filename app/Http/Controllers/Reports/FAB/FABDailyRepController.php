<?php

namespace App\Http\Controllers\Reports\FAB;

use App\Fabrication\Bobine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FABDailyRepController extends Controller
{
    public function index()
    {
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $FABReport = [];
        if (sizeof($details) > 0) {

            $FABReport = DB::select('select * from "fabreport" where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$details[0]->Did]);
        }
        $nbT = sizeof($FABReport);
        $LT = array_sum(array_column($FABReport, "Longueur"));
        $PT = round(array_sum(array_column($FABReport, "Poids")), 3);

        return view('Reports.FAB.FABDailyRep', [
                'reports' => (object)$FABReport,
                'nbT' => $nbT,
                'LT' => $LT,
                'PT' => $PT,
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
        $FABReport = [];
        $ArretsReport = [];
        if ($request->poste == 'Tous' && $request->Machine == 'Tous') {
            $FABReport = DB::select('select * from "fabreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  ', [$request->Did, $id, $id]);
        } else if ($request->poste != 'Tous' && $request->Machine == 'Tous') {
            $FABReport = DB::select('select * from "fabreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Poste"=?', [$request->Did, $id, $id, $request->poste]);
        } else if ($request->Machine != 'Tous' && $request->poste == 'Tous') {
            $FABReport = DB::select('select * from "fabreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=?', [$request->Did, $id, $id, $request->Machine]);
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  and "Machine"=?  and "Zone"=\'Z01\' ', [$request->Did, $id, $id, $request->Machine]);
        } else {
            $FABReport = DB::select('select * from "fabreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=? and "Poste"=?'
                , [$request->Did, $id, $id, $request->Machine, $request->poste]);
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) and "Machine"=? and "Poste"=? and "Zone"=\'Z01\' '
                , [$request->Did, $id, $id, $request->Machine, $request->poste]);
        }
        $dureeTotal = array_sum(array_column($ArretsReport, "Durée"));
        $nbT = sizeof($FABReport);
        $LT = array_sum(array_column($FABReport, "Longueur"));
        $PT = round(array_sum(array_column($FABReport, "Poids")), 3);
        $dureeFonc = 0;
        if ($request->Machine != 'Tous') {
            if ($request->poste != 'Tous') {
                $dureeFonc = 8 * 60;
            } else {
                $dureeFonc = 24 * 60;
            }
        }
        return response()->json(array(
            'reports' => $FABReport,
            'nbT' => $nbT,
            'LT' => $LT,
            'PT' => $PT,
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
