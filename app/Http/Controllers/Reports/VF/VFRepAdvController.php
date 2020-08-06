<?php

namespace App\Http\Controllers\Reports\VF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VFRepAdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $VFReport = DB::select('select q."Nom" "Filter",Sum(q."NBT") "NBT",Sum("LongueurTotal") "LT",Sum("PoidsTotal") "PT" from(select p."Nom","Epaisseur","Diametre",
                    Count(*) "NBT",Sum("Longueur") "LongueurTotal",Sum("Poids") "PoidsTotal" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport" ) f join "projet" p on f."Pid"=p."Pid"
                    group by "Nom","Epaisseur","Diametre") q group by q."Nom"');

        return view('Reports.VF.VFRepAdv', [
                'VFReport' => $VFReport,
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
        if($id=="Projet") $id="Nom";
        $Reports = DB::select('select q."'.$id.'" "Filter",Sum(q."NBT") "NBT",Sum("LongueurTotal") "LT",Sum("PoidsTotal") "PT" from(select p."Nom","Epaisseur","Diametre",
                    Count(*) "NBT",Sum("Longueur") "LongueurTotal",Sum("Poids") "PoidsTotal" from ( select * 
             , Round(cast(("Longueur"*(("EpaisseurM"*pi()*7.85*("DiametreM"-"EpaisseurM"))/1000 ))/1000 as numeric),3) "Poids"
             from "vfreport") f join "projet" p on f."Pid"=p."Pid"
                    group by "Nom","Epaisseur","Diametre") q group by q."'.$id.'"');

        return response()->json(array(
            'reports' => $Reports ), 200);

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
