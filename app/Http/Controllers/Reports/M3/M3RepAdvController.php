<?php

namespace App\Http\Controllers\Reports\M3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class M3RepAdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


            $RecBobReport = DB::select('Select   "Nom" as "Filter",Sum("NbTotal") "NBT" ,Sum("PoidsTotal")/1000 "PT"  
                                from "recbobreport" group by "Nom"');
        return view('Reports.RecBobRepAdv', [
                'RecBobReport' => $RecBobReport,
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
    {   if($id=="Largeur Bande") $id="LargeurBande";
        if($id=="Provenance") $id="Source";
        if($id=="Projet") $id="Nom";
        $Reports=DB::select('Select  "'.$id.'" as "Filter",Sum("NbTotal") "NBT" ,Sum("PoidsTotal")/1000 "PT"  
                                from "recbobreport" group by "'.$id.'" ' );
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
