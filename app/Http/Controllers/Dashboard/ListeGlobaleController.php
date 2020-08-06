<?php

namespace App\Http\Controllers\Dashboard;

use App\Fabrication\Bobine;
use App\Fabrication\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListeGlobaleController extends Controller
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
        $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $coulees = DB::table('');

        return view('Dashboard.ListeGlobale', ["coulees" => $coulees, "details" => $details, 'RDid' => $details[0]->Did
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

        $Did = $request->Did;
        $test1 = $request->Test1;
        $test1_1 = $request->Test1_1;
        $test2 = $request->Test2;
        $test2_2 = $request->Test2_2;
        $Observation1 = $request->Observation1;
        $Observation1_1 = $request->Observation1_1;
        $Observation2 = $request->Observation2;
        $Observation2_2 = $request->Observation2_2;
        $coulee = $request->coulee;

        $bobineTest1 = Bobine::where("NumTest", '=', 'test1')->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
        $bobineTest1_1 = Bobine::where("NumTest", '=', 'test1_1')->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
        $bobineTest2 = Bobine::where("NumTest", '=', 'test2')->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
        $bobineTest2_2 = Bobine::where("NumTest", '=', 'test2_2')->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();

        if ($bobineTest1 != null) {
            if ($test1 == $bobineTest1->Bobine) {
                $bobineTest1->Observation = $Observation1;
                $bobineTest1->save();
            } else if ($test1 == "Aucune") {
                $bobineTest1->Observation = null;
                $bobineTest1->NumTest = null;
                $bobineTest1->Test = false;
                $bobineTest1->save();
            } else {
                $bobineTest1->Observation = null;
                $bobineTest1->NumTest = null;
                $bobineTest1->Test = false;
                $nvtest1 = Bobine::where("Bobine", '=', $test1)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                $nvtest1->NumTest = "test1";
                $nvtest1->Observation = $Observation1;
                $nvtest1->Test = true;
                $bobineTest1->save();
                $nvtest1->save();
            }
        } else {
            if ($test1 != "Aucune") {
                $nvtest1 = Bobine::where("Bobine", '=', $test1)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                if ($nvtest1 != null) {
                    $nvtest1->NumTest = "test1";
                    $nvtest1->Observation = $Observation1;
                    $nvtest1->Test = true;
                    $nvtest1->save();
                }
            }

        }
        if ($bobineTest1_1 != null) {
            if ($test1_1 == $bobineTest1_1->Bobine) {
                $bobineTest1_1->Observation = $Observation1_1;
                $bobineTest1_1->save();
            } else if ($test1_1 == "Aucune") {
                $bobineTest1_1->Observation = null;
                $bobineTest1_1->NumTest = null;
                $bobineTest1_1->Test = false;
                $bobineTest1_1->save();
            } else {
                $bobineTest1_1->Observation = null;
                $bobineTest1_1->NumTest = null;
                $bobineTest1_1->Test = false;
                $nvtest1_1 = Bobine::where("Bobine", '=', $test1_1)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                $nvtest1_1->NumTest = "test1_1";
                $nvtest1_1->Observation = $Observation1_1;
                $nvtest1_1->Test = true;
                $bobineTest1_1->save();
                $nvtest1_1->save();
            }
        } else {
            if ($test1_1 != "Aucune") {
                $nvtest1_1 = Bobine::where("Bobine", '=', $test1_1)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                if ($nvtest1_1 != null) {
                    $nvtest1_1->NumTest = "test1_1";
                    $nvtest1_1->Observation = $Observation1_1;
                    $nvtest1_1->Test = true;
                    $nvtest1_1->save();
                }
            }

        }

        if ($bobineTest2 != null) {
            if ($test2 == $bobineTest2->Bobine) {
                $bobineTest2->Observation = $Observation2;
                $bobineTest2->save();
            } else if ($test2 == "Aucune") {
                $bobineTest2->Observation = null;
                $bobineTest2->NumTest = null;
                $bobineTest2->Test = false;
                $bobineTest2->save();
            } else {
                $bobineTest2->Observation = null;
                $bobineTest2->NumTest = null;
                $bobineTest2->Test = false;
                $nvtest2 = Bobine::where("Bobine", '=', $test2)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                $nvtest2->NumTest = "test2";
                $nvtest2->Observation = $Observation2;
                $nvtest2->Test = true;
                $bobineTest2->save();
                $nvtest2->save();
            }
        } else {
            if ($test2 != "Aucune") {
                $nvtest2 = Bobine::where("Bobine", '=', $test2)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                if ($nvtest2 != null) {
                    $nvtest2->NumTest = "test2";
                    $nvtest2->Observation = $Observation2;
                    $nvtest2->Test = true;
                    $nvtest2->save();
                }
            }

        }
        if ($bobineTest2_2 != null) {
            if ($test2_2 == $bobineTest2_2->Bobine) {
                $bobineTest2_2->Observation = $Observation2_2;
                $bobineTest2_2->save();
            } else if ($test2_2 == "Aucune") {
                $bobineTest2_2->Observation = null;
                $bobineTest2_2->NumTest = null;
                $bobineTest2_2->Test = false;
                $bobineTest2_2->save();
            } else {
                $bobineTest2_2->Observation = null;
                $bobineTest2_2->NumTest = null;
                $bobineTest2_2->Test = false;
                $nvtest2_2 = Bobine::where("Bobine", '=', $test2_2)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                $nvtest2_2->NumTest = "test2_2";
                $nvtest2_2->Observation = $Observation2_2;
                $nvtest2_2->Test = true;
                $bobineTest2_2->save();
                $nvtest2_2->save();
            }
        } else {
            if ($test2_2 != "Aucune") {
                $nvtest2_2 = Bobine::where("Bobine", '=', $test2_2)->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
                if ($nvtest2_2 != null) {
                    $nvtest2_2->NumTest = "test2_2";
                    $nvtest2_2->Observation = $Observation2_2;
                    $nvtest2_2->Test = true;
                    $nvtest2_2->save();
                }
            }

        }
        $Coulee = DB::table("couleedetails")->where('Coulee', '=', $request->coulee)->where('Did', '=', $Did)->first();
       return  response()->json(array('Coulee' => $Coulee), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $details = DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');
        $coulees = DB::table('couleedetails')->where('Did', '=', $id)->get()->toArray();
        return view('Controle.ContRecBob', ["coulees" => $coulees, "details" => $details, 'RDid' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $test1 = null;
        $test1_1 = null;
        $test2 = null;
        $test2_2 = null;
        $Observation1 = null;
        $Observation1_1 = null;
        $Observation2 = null;
        $Observation2_2 = null;
        $coulee = $request->coulee;
        $Did = $request->Did;
        $bobines = Bobine::where('Did', '=', $Did)->where('Coulee', '=', $coulee)->get();
        foreach ($bobines as $bobine) {
            if ($bobine->NumTest == "test1") {
                $test1 = $bobine->Bobine;
                $Observation1 = $bobine->Observation;
            } else if ($bobine->NumTest == "test1_1") {
                $test1_1 = $bobine->Bobine;
                $Observation1_1 = $bobine->Observation;
            } else if ($bobine->NumTest == "test2") {
                $test2 = $bobine->Bobine;
                $Observation2 = $bobine->Observation;
            } else if ($bobine->NumTest == "test2_2") {
                $test2_2 = $bobine->Bobine;
                $Observation2_2 = $bobine->Observation;
            }
        }
        return response()->json(array('bobines' => $bobines, 'test1' => $test1, 'Observation1' => $Observation1,
            'test1_1' => $test1_1, 'Observation1_1' => $Observation1_1,
            'test2' => $test2, 'Observation2' => $Observation2,
            'test2_2' => $test2_2, 'Observation2_2' => $Observation2_2,), 200);
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
    public
    function destroy($id)
    {
        //
    }
}
