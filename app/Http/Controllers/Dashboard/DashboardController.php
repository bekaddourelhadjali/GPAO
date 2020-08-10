<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=[];
        $RecBobReport=[];
        $VISReport=[];
        $M3Report=[];
        $FABReport=[];
        $USReport=[];
        $RX1Report=[];
        $M17Report=[];
        $RepReport=[];
        $M24Report=[];
        $M25Report=[];
        $NDTReport=[];
        $RX2Report=[];
        $VFReport=[];
        $VFRReport=[];
        $RecReport=[];
        $RevIntReport=[];
        $RevExtReport=[];
        $ExpReport=[];
        $details = $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        if(sizeof($details)){
            $RecBobReport=DB::select('select "Did","DateRec",sum("NbTotal") "nbT",sum("PoidsTotal") "PT" from "recbobreport" where 
               "DateRec"  =CURRENT_DATE  and "Did"=? group by "Did","DateRec";',[$details[0]->Did]);

            $M3Report = DB::select('select   Count(*) "nbT", SUM("Poids")/1000 "PT",SUM("ChuteTotal") "PCT" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ) q1  ', [$details[0]->Did]);


            $FABReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "fabreport"  
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ',[$details[0]->Did ]);

            $VISReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "visuelreport"  
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ',[$details[0]->Did ]);

            $USReport = DB::select('select  
                    Count(*) "nbT",COUNT(CASE WHEN "RB" = true then 1 ELSE NULL END) as "nbRB" from "usreport"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $RX1Report = DB::select('select  count(*) "nbT"  from "rx1report"  
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $RepReport = DB::select('select  count(*) "nbT"  from "repreport"  
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $M17Report = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT"   from "m17report"   where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $M24Report = DB::select('select     Count(*) "nbT"  from "m24report"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $M25Report = DB::select('select     Count(*) "nbT"  from "m25report"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $NDTReport = DB::select('select     Count(*) "nbT"  from "ndtreport"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $RX2Report = DB::select('select     Count(*) "nbT"  from "rx2report"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $VFReport = DB::select('select  Count(*)  "nbT",SUM("Longueur") "LT", SUM("Poids") "PT" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport"  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
              and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )) q1  ', [$details[0]->Did]);

            $VFRReport = DB::select('select     Count(*) "nbT"  from "vfrreport"
                  where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\') and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ',[$details[0]->Did ]);

            $RecReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT",  SUM("Poids") "PT" from "recreport"
             where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
             and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ', [$details[0]->Did]);

            $RevIntReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revintreport" where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
             and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ', [$details[0]->Did]);

            $RevExtReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revextreport" where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
             and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ', [$details[0]->Did]);

            $ExpReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "expreport" where "Did"=? and "DateSaisie" between (CURRENT_DATE::timestamp +time \'05:00\')
             and  (CURRENT_DATE::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ', [$details[0]->Did]);


        }
        return view('Dashboard.Dashboard',
            ["details"=>$details,
                "RecBobReport"=>$RecBobReport,
                "M3Report"=>$M3Report,
                'FABReport'=>$FABReport,
                'VISReport'=>$VISReport,
                'USReport'=>$USReport,
                'RepReport'=>$RepReport,
                'RX1Report'=>$RX1Report,
                'M17Report'=>$M17Report,
                'M24Report'=>$M24Report,
                'M25Report'=>$M25Report,
                'NDTReport'=>$NDTReport,
                'RX2Report'=>$RX2Report,
                'VFReport'=>$VFReport,
                'VFRReport'=>$VFRReport,
                'RecReport'=>$RecReport,
                'RevIntReport'=>$RevIntReport,
                'RevExtReport'=>$RevExtReport,
                'ExpReport'=>$ExpReport,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

            $RecBobReport=DB::select('select "Did","DateRec",sum("NbTotal") "nbT",sum("PoidsTotal") "PT" from "recbobreport" where 
               "DateRec"  =?  and "Did"=? group by "Did","DateRec";', [$request->date,$id]);

            if($request->poste!=="Tous"){
                $M3Report = DB::select('select   Count(*) "nbT", SUM("Poids")/1000 "PT",SUM("ChuteTotal") "PCT" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ) q1  ',  [$id,$request->poste,$request->date,$request->date]);


                $FABReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "fabreport"  
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ', [$id,$request->poste,$request->date,$request->date]);

                $VISReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "visuelreport"  
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ', [$id,$request->poste,$request->date,$request->date]);

                $USReport = DB::select('select  
                    Count(*) "nbT",COUNT(CASE WHEN "RB" = true then 1 ELSE NULL END) as "nbRB" from "usreport"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $RX1Report = DB::select('select  count(*) "nbT"  from "rx1report"  
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $RepReport = DB::select('select  count(*) "nbT"  from "repreport"  
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $M17Report = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT"   from "m17report"   where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $M24Report = DB::select('select     Count(*) "nbT"  from "m24report"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $M25Report = DB::select('select     Count(*) "nbT"  from "m25report"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $NDTReport = DB::select('select     Count(*) "nbT"  from "ndtreport"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $RX2Report = DB::select('select     Count(*) "nbT"  from "rx2report"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $VFReport = DB::select('select  Count(*)  "nbT",SUM("Longueur") "LT", SUM("Poids") "PT" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport"  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\')
              and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )) q1  ',  [$id,$request->poste,$request->date,$request->date]);

                $VFRReport = DB::select('select     Count(*) "nbT"  from "vfrreport"
                  where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->poste,$request->date,$request->date]);

                $RecReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT",  SUM("Poids") "PT" from "recreport"
             where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->poste,$request->date,$request->date]);

                $RevIntReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revintreport" where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ',  [$id,$request->poste,$request->date,$request->date]);

                $RevExtReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revextreport" where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->poste,$request->date,$request->date]);

                $ExpReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "expreport" where "Did"=? and "Poste"=? and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->poste,$request->date,$request->date]);
            }else{

                $M3Report = DB::select('select   Count(*) "nbT", SUM("Poids")/1000 "PT",SUM("ChuteTotal") "PCT" from (select m.*,p."Nom",
 CASE WHEN m."Etat"=\'Prep\' then Round(Cast(((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-50)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3)
 Else Round(Cast(float8((("Poids")-("Chutes"*("LargeMoy"*"EpMoy"*7.85)))*(("LargeMoy"-(("LargeurBande"-11)/1000))/"LargeMoy")+("Chutes"*("LargeMoy"*"EpMoy"*7.85)))/1000 as numeric),3) End
  "ChuteTotal"  from  "m3report" m join "projet" p  on m."Pid"=p."Pid" where "Did"=? and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ) q1  ',  [$id,$request->date,$request->date]);


                $FABReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "fabreport"  
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ', [$id,$request->date,$request->date]);

                $VISReport = DB::select('select  
                    Count(*) "nbT",Sum("Longueur") "LT",Sum("Poids") "PT" from "visuelreport"  
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ', [$id,$request->date,$request->date]);

                $USReport = DB::select('select  
                    Count(*) "nbT",COUNT(CASE WHEN "RB" = true then 1 ELSE NULL END) as "nbRB" from "usreport"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $RX1Report = DB::select('select  count(*) "nbT"  from "rx1report"  
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $RepReport = DB::select('select  count(*) "nbT"  from "repreport"  
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $M17Report = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT"   from "m17report"   where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $M24Report = DB::select('select     Count(*) "nbT"  from "m24report"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $M25Report = DB::select('select     Count(*) "nbT"  from "m25report"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $NDTReport = DB::select('select     Count(*) "nbT"  from "ndtreport"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $RX2Report = DB::select('select     Count(*) "nbT"  from "rx2report"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $VFReport = DB::select('select  Count(*)  "nbT",SUM("Longueur") "LT", SUM("Poids") "PT" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport"  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\')
              and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )) q1  ',  [$id,$request->date,$request->date]);

                $VFRReport = DB::select('select     Count(*) "nbT"  from "vfrreport"
                  where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\') and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' ) ', [$id,$request->date,$request->date]);

                $RecReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT",  SUM("Poids") "PT" from "recreport"
             where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->date,$request->date]);

                $RevIntReport = DB::select('select count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revintreport" where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )  ',  [$id,$request->date,$request->date]);

                $RevExtReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "revextreport" where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->date,$request->date]);

                $ExpReport = DB::select('select  count(*) "nbT",SUM("Longueur") "LT", 
            SUM("Poids") "PT" from "expreport" where "Did"=?  and "DateSaisie" between (?::timestamp +time \'05:00\')
             and  (?::timestamp + (\'1 day\')::INTERVAL +time \'05:00\' )   ',  [$id,$request->date,$request->date]);
            }
        return response()->json(array(
                "RecBobReport"=>$RecBobReport,
                "M3Report"=>$M3Report,
                'FABReport'=>$FABReport,
                'VISReport'=>$VISReport,
                'USReport'=>$USReport,
                'RepReport'=>$RepReport,
                'RX1Report'=>$RX1Report,
                'M17Report'=>$M17Report,
                'M24Report'=>$M24Report,
                'M25Report'=>$M25Report,
                'NDTReport'=>$NDTReport,
                'RX2Report'=>$RX2Report,
                'VFReport'=>$VFReport,
                'VFRReport'=>$VFRReport,
                'RecReport'=>$RecReport,
                'RevIntReport'=>$RevIntReport,
                'RevExtReport'=>$RevExtReport,
                'ExpReport'=>$ExpReport,
          ), 200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
