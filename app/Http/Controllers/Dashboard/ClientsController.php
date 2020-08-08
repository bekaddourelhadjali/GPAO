<?php

namespace App\Http\Controllers\Dashboard;

use App\Fabrication\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $clients=Client::all();
        $target="clients";
        return view('Dashboard.Clients',[
            "target"=>$target,
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client=new Client();
        $client->name=$request->name;
        $client->address=$request->address;
        $client->zipcode=$request->zipcode;
        $client->city=$request->city;
        $client->state=$request->state;
        $client->country=$request->country;
        $client->phone=$request->phone;
        $client->fax=$request->fax;
        $client->web_url=$request->web_url;
        $client->comment=$request->comment;
        if($client->save()){
            return response()->json(array('client'=> $client), 200);

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
        $client=Client::findOrFail($id);
        $client->name=$request->name;
        $client->address=$request->address;
        $client->zipcode=$request->zipcode;
        $client->city=$request->city;
        $client->state=$request->state;
        $client->country=$request->country;
        $client->phone=$request->phone;
        $client->fax=$request->fax;
        $client->web_url=$request->web_url;
        $client->comment=$request->comment;
        if($client->save()){
            return response()->json(array('client'=> $client), 200);

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
        if(Client::destroy($id)){
            return response()->json(array('success'=> true), 200);
        }else{

            return response()->json(array('error'=> true), 404);
        }
    }
}
