<?php

namespace App\Http\Controllers\Dashboard;

use App\Fabrication\Client;
use App\Fabrication\Projet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $projet = Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
        $projects=Projet::all();
        $clients=Client::all();
        return view('Dashboard.Projects',["projet"=>$projet,
            "projects"=>$projects,
            "clients"=>$clients,


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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project=new Projet();
        $project->Nom=$request->nom;
        $project->StartDate=$request->startDate;
        $project->EndDate=$request->endDate;
        $project->Comments=$request->comments;
        $project->Customer=$request->customer;
        if($project->save()){
            return response()->json(array('project'=> $project), 200);

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
        $project= Projet::find($id);
        if($project!=null){
            return response()->json(array('project'=> $project), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $project= Projet::find($id);
        $project->Nom=$request->nom;
        $project->StartDate=$request->startDate;
        $project->EndDate=$request->endDate;
        $project->Comments=$request->comments;
        $project->Customer=$request->customer;
        if($project->save()){
            return response()->json(array('project'=> $project), 200);

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
        if(Projet::destroy($id)){
            return response()->json(array('success'=> true), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }
}
