<?php

namespace App\Http\Controllers\Dashboard;

use App\Fabrication\detailprojet;
use App\Fabrication\Projet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $detail_projects=detailprojet::all();
        $projects=Projet::all();
        return view('Dashboard.ProjectDetails',["projet"=>$projet,
            "detail_projects"=>$detail_projects,
            "projects"=>$projects,

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail_project=new detailprojet();
        $detail_project->Pid=Projet::where('Nom',$request->Nom)->first()->Pid;
        $detail_project->Nuance=$request->Nuance;
        $detail_project->Epaisseur=$request->Epaisseur;
        $detail_project->Diametre=$request->Diametre;
        $detail_project->Psl=$request->Psl;
        $detail_project->Qty=$request->Qty;
        $detail_project->MMtube=$request->MMtube;
        $detail_project->MMBobine=$request->MMBobine;
        $detail_project->PoidsM=$request->PoidsM;
        $detail_project->Largeur=$request->Largeur;
        $detail_project->RiveD=$request->RiveD;
        $detail_project->Libelle=$request->Libelle;
        $detail_project->RiveG=$request->RiveG;
        if($detail_project->save()){
            $detail_project->projectName=$detail_project->project->Nom;
            return response()->json(array('detail_project'=> $detail_project), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $detail_project=detailprojet::findOrFail($id);
        $detail_project->Pid=Projet::where('Nom',$request->Nom)->first()->Pid;
        $detail_project->Nuance=$request->Nuance;
        $detail_project->Epaisseur=$request->Epaisseur;
        $detail_project->Diametre=$request->Diametre;
        $detail_project->Psl=$request->Psl;
        $detail_project->Qty=$request->Qty;
        $detail_project->MMtube=$request->MMtube;
        $detail_project->MMBobine=$request->MMBobine;
        $detail_project->PoidsM=$request->PoidsM;
        $detail_project->Largeur=$request->Largeur;
        $detail_project->RiveD=$request->RiveD;
        $detail_project->Libelle=$request->Libelle;
        $detail_project->RiveG=$request->RiveG;
        if($detail_project->save()){
            $detail_project->projectName=$detail_project->project->Nom;
            return response()->json(array('detail_project'=> $detail_project), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(detailprojet::destroy($id)){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}