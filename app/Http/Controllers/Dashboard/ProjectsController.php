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
    {    $projects=Projet::all();
        $clients=Client::all();
        return view('Dashboard.Projects',[
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
        $project->Etat=$request->etat;
        if($project->save()){
            if($project->Etat=='C'){
                $project->Etat='Fini';
            }  elseif($project->Etat=='E'){
                $project->Etat='En cours';
            } else {
                $project->Etat='Arreté';
            }
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
            if($project->Etat=='C'){
            $project->Etat='Fini';
        }  elseif($project->Etat=='E'){
            $project->Etat='En cours';
        } else {
            $project->Etat='Arreté';
        }
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
        $project->Etat=$request->etat;
        if($project->save()){
            if($project->Etat=='C'){
                $project->Etat='Fini';
            }  elseif($project->Etat=='E'){
                $project->Etat='En cours';
            } else {
                $project->Etat='Arreté';
            }
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
