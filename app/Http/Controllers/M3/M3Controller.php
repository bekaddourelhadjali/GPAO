<?php

namespace App\Http\Controllers\M3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function show($id)
    {
        $rapport =\App\Fabrication\Rapport::find($id);
        if($rapport->Zone=='Z00'){
            if($rapport!=null) {
                $bobines = \App\Fabrication\Bobine::all('Bobine','Coulee');
                if($rapport->Etat=='N'){
                    $rapprods= $rapport->rapprods;
                     return view('M3.M3',
                        ['rapport'=>$rapport,
                            'bobines'=>$bobines,
                            'm3'=>$rapport->m3]);
                }elseif($rapport->Etat=='C'){
                    return redirect(route('rapports_M3.index'));
                }
            }else{
                return redirect(route('rapports_M3.index'));
            }
        }else{
            return redirect(route('rapports_M3.index'));
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
