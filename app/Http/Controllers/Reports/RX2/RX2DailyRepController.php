<?php

namespace App\Http\Controllers\Reports\RX2;

use App\Fabrication\Bobine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RX2DailyRepController extends Controller
{
    public function index()
    {
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $RX2Report = [];
        if (sizeof($details) > 0) {

            $RX2Report = DB::select('select * from "rx2report" where "Did"=?   and "DateSaisie"  between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$details[0]->Did]);
        }
        $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) ', [$details[0]->Did]);
        $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport" 
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
                       and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\') group by "Opr"   '
            , [$details[0]->Did]);

        $DefautsReport = DB::select('select "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
                       and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\') group by  "Defaut" '
            , [$details[0]->Did]);

        $nbT = sizeof($RX2Report);
        $dureeTotal = array_sum(array_column($ArretsReport, "Durée"));
        return view('Reports.RX2.RX2DailyRep', [
                'reports' => (object)$RX2Report,
                'nbT' => $nbT,
            'ArretsReport' => $ArretsReport,
            'DefautsReport' => $DefautsReport,
            'OperationsReport' => $OperationsReport,
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
        $RX2Report = [];
        $ArretsReport = [];
        if ($request->poste == 'Tous' && $request->Machine == 'Tous') {
            $RX2Report = DB::select('select * from "rx2report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  ', [$request->Did, $id, $id]);

            $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) group by "Opr" '
                , [$request->Did,$id,$id]);
            $DefautsReport = DB::select('select "Defaut" "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) group by "Defaut"'
                , [$request->Did,$id,$id]);

        }
        else if ($request->poste != 'Tous' && $request->Machine == 'Tous') {
            $RX2Report = DB::select('select * from "rx2report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Poste"=?', [$request->Did, $id, $id, $request->poste]);

            $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) and "Poste"=? group by "Opr" '
                , [$request->Did,$id,$id,$request->poste]);
            $DefautsReport = DB::select('select "Defaut" "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) and "Poste"=? group by "Defaut"'
                , [$request->Did,$id,$id,$request->poste]);

        }
        else if ($request->Machine != 'Tous' && $request->poste == 'Tous') {
            $RX2Report = DB::select('select * from "rx2report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=?', [$request->Did, $id, $id, $request->Machine]);

            $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) and "Tube" like \''.$request->Machine.'%\' group by "Opr" '
                , [$request->Did,$id,$id]);
            $DefautsReport = DB::select('select "Defaut" "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) and "Tube" like \''.$request->Machine.'%\' group by "Defaut"'
                , [$request->Did,$id,$id ]);

            }
            else {
            $RX2Report = DB::select('select * from "rx2report" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00:00\')  and "Machine"=? and "Poste"=?'
                , [$request->Did, $id, $id, $request->Machine, $request->poste]);

            $OperationsReport = DB::select('select "Opr",Count(*) "NBT",Sum("Valeur") "VT"  from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  )and "Tube" like \''.$request->Machine.'%\'  and "Poste"=? group by "Opr" '
                , [$request->Did,$id,$id,  $request->poste]);
            $DefautsReport = DB::select('select "Defaut" "Defaut",Count(*) "NBT" from "defautsreport"
                      where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\')
                       and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'  ) and "Tube" like \''.$request->Machine.'%\'  and "Poste"=? group by "Defaut"'
                , [$request->Did,$id,$id,  $request->poste]);

        }
        if($request->poste == 'Tous'){
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'    ) ', [$request->Did, $id, $id]);

        }else{
            $ArretsReport = DB::select('select * from "arretsreport" where "Did"=? and "Zone"=\'Z09\' and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\'   )  and "Poste"=?'
                , [$request->Did, $id, $id, $request->poste]);
        }


        $dureeTotal = array_sum(array_column($ArretsReport, "Durée"));
        $nbT = sizeof($RX2Report);
        $dureeFonc = 0;
            if ($request->poste != 'Tous') {
                $dureeFonc = 8 * 60;
            } else {
                $dureeFonc = 24 * 60;
            }
        return response()->json(array(
            'reports' => $RX2Report,
            'nbT' => $nbT,
            'poste' => $request->poste == 'Tous',
            'Machine' => $request->Machine == 'Tous',
            'ArretsReport' => $ArretsReport,
            'DefautsReport' => $DefautsReport,
            'OperationsReport' => $OperationsReport,
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
