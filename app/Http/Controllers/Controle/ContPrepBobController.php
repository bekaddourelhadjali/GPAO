<?php

namespace App\Http\Controllers\Controle;

use App\Fabrication\Bobine;
use App\Fabrication\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContPrepBobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//      $rapports = Rapport::whereDate("DateSaisie",'=',date('Y-m-d'))->where('Zone','=',"RecBob")->get();
//        $bobines = DB::select('Select count(*) from "bobine" where "NumeroRap" in'.
//                                     '(select "Numero" from "rapports" where "DateSaisie"::date=? and "Zone"=?)',[date('Y-m-d'),'RecBob']);
//        foreach ($rapports as $rapport)$rapport->RecBob;
//            return view('Controle.ContRecBob',[
//            'rapports'=>$rapports,
//                'NbBobines'=>$bobines
//        ]);
        $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $coulees = DB::select(' select * , Case When q1."nbTest"<q1."PoidsM" then \'Oui\' else \'Non\' end "BesoinTest",
  (sum(q1."PoidsTotal")/(((q1."Epaisseur")*pi()*7.85*((q1."Diametre"-q1."Epaisseur")))/1000)) "Lang" from
(SELECT b."Did",b."Epaisseur",d."Diametre",b."Coulee" ,sum(b."Poids") "PoidsTotal",count(b."Test") filter (where  b."Test"=true) "nbTest"
,CASE WHEN (sum(b."Poids")/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))>=575 THEN 2   ELSE 1 END "PoidsM" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" and d."Did"='.$details[0]->Did.' 
group by b."Coulee",b."Epaisseur",d."Diametre",b."Did",b."Poids","PoidsM")   q1 
group by q1."Coulee",q1."Epaisseur",q1."Diametre",q1."Did",q1."PoidsTotal",q1."nbTest",q1."PoidsM"');

        return view('Controle.ContRecBob', ["coulees" => $coulees,"details"=>$details,'RDid'=>$details[0]->Did
        ]);
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
        $bobine = Bobine::where("Bobine", '=', $request->bobine)->where('Coulee', '=', $request->coulee)->first();
        if ($bobine) {
            $bobine->Test = $request->test;

            if ($bobine->save()) {
                $coulees = DB::select('select * , Case When q1."nbTest"<q1."PoidsM" then \'Oui\' else \'Non\' end "BesoinTest",
  (sum(q1."PoidsTotal")/(((q1."Epaisseur")*pi()*7.85*((q1."Diametre"-q1."Epaisseur")))/1000)) "Lang" from
(SELECT b."Did",b."Epaisseur",d."Diametre",b."Coulee" ,sum(b."Poids") "PoidsTotal",count(b."Test") filter (where  b."Test"=true) "nbTest"
,CASE WHEN (sum(b."Poids")/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))>=575 THEN 2   ELSE 1 END "PoidsM" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" and d."Did"='.$request->Did.' 
group by b."Coulee",b."Epaisseur",d."Diametre",b."Did",b."Poids","PoidsM")   q1 
group by q1."Coulee",q1."Epaisseur",q1."Diametre",q1."Did",q1."PoidsTotal",q1."nbTest",q1."PoidsM"');
                return response()->json(array('coulees' => $coulees), 200);
            } else {
                return response()->json(array('error' => error), 404);
            }
        } else {
            return response()->json(array('message' => "Bobine N'existe pas"), 404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
//        if($request->source=="ajax"){
//        $d = \DateTime::createFromFormat('Y-m-d', $id);
//    if($d && $d->format('Y-m-d') === $id){
//        $bobines = DB::select('Select count(*) from "bobine" where "NumeroRap" in'.
//            '(select "Numero" from "rapports" where "DateSaisie"::date=? and "Zone"=?)',[$id,'RecBob']);
//        $rapports = Rapport::whereDate("DateSaisie",'=',$id)->where('Zone','=',"RecBob")->get();
//        foreach ($rapports as $rapport) $rapport->RecBob;
//        return response()->json(array('rapports' => $rapports,'NbBobines'=>$bobines), 200);
//    }else  return response()->json(array('message' => "Format de Date invalid"), 404);
//        }else{
//            return redirect(route('ContRecBob.index'));
//        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $details= DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $coulees = DB::select(' select * , Case When q1."nbTest"<q1."PoidsM" then \'Oui\' else \'Non\' end "BesoinTest",
  (sum(q1."PoidsTotal")/(((q1."Epaisseur")*pi()*7.85*((q1."Diametre"-q1."Epaisseur")))/1000)) "Lang" from
(SELECT b."Did",b."Epaisseur",d."Diametre",b."Coulee" ,sum(b."Poids") "PoidsTotal",count(b."Test") filter (where  b."Test"=true) "nbTest"
,CASE WHEN (sum(b."Poids")/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))>=575 THEN 2   ELSE 1 END "PoidsM" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" and d."Did"='.$id.' 
group by b."Coulee",b."Epaisseur",d."Diametre",b."Did",b."Poids","PoidsM")   q1 
group by q1."Coulee",q1."Epaisseur",q1."Diametre",q1."Did",q1."PoidsTotal",q1."nbTest",q1."PoidsM"');
        return view('Controle.ContRecBob', ["coulees" => $coulees,"details"=>$details,'RDid'=>$id ]);

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
        $bobine=Bobine::where('Coulee','=',$id)->where('Test','=',true)->first();
        $bobine->Test=false;
        if ($bobine->save()) {
            $coulees = DB::select('select * , Case When q1."nbTest"<q1."PoidsM" then \'Oui\' else \'Non\' end "BesoinTest",
  (sum(q1."PoidsTotal")/(((q1."Epaisseur")*pi()*7.85*((q1."Diametre"-q1."Epaisseur")))/1000)) "Lang" from
(SELECT b."Did",b."Epaisseur",d."Diametre",b."Coulee" ,sum(b."Poids") "PoidsTotal",count(b."Test") filter (where  b."Test"=true) "nbTest"
,CASE WHEN (sum(b."Poids")/(((b."Epaisseur")*pi()*7.85*((d."Diametre"-b."Epaisseur")))/1000))>=575 THEN 2   ELSE 1 END "PoidsM" 
from "bobine" b join "detailprojet" d on b."Did"=d."Did" and d."Did"='.$request->Did.' 
group by b."Coulee",b."Epaisseur",d."Diametre",b."Did",b."Poids","PoidsM")   q1 
group by q1."Coulee",q1."Epaisseur",q1."Diametre",q1."Did",q1."PoidsTotal",q1."nbTest",q1."PoidsM"');
            return response()->json(array('coulees' => $coulees), 200);
        } else {

            return response()->json(array('error' => error), 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
