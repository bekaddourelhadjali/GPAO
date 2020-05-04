@extends('layouts.app')

@section('style')
    <style>
        label{
            margin-bottom: 0;
            padding-top: 5px;
        }
        .row .col-3 {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .body-content{
            border-radius: 10px;
            padding:10px;
        }
        fieldset{
            padding: 20px;
        }
        fieldset fieldset  {
            padding: 10px;
            margin-top: 30px;
        }
        fieldset legend {
            color : #2e59d9;
            width: auto;
        }
        fieldset >.row {
        }
        .dernier-tube{
            background-color: #20c997;
            padding: 10px;
            border-radius: 10px;
        }
        span.valeur{
            color:red;
        }
    </style>

@endsection
@section('content')
    <div class="container">

        <section class="col-xl-8 col-lg-8 col-sm-12 col-md-12 offset-xl-2 offset-lg-2 ">
            <div class="row ">
                <div class="top-content col-12 offset-xl-2 offset-lg-2 offset-md-1 offset-">
                    <div class="row ">
                        <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                        <div class="col-10">
                            <h1>Project : {{$projet->Nom}}</h1>
                            <h5>Client:  {{$projet->Customer}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-xl-8 col-lg-8 col-sm-12 col-md-12 offset-xl-2 offset-lg-2 ">
            <div class="body-content ">
                <form method="post" action="{{route('rapports.store')}}">
                    @csrf
                    <fieldset>
                        <legend><h3>Information du rapport</h3> </legend>
                        <div class="form-group  row">
                            <label class="col-3" for="detail_project ">Detail Projet</label>
                            <select class="form-control col-6" id="detail_project " name="detail_project">
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}">Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="Pid" type="hidden" id="Pid" value="{{$projet->Pid}}">
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-6" for="date" >Date de rapport</label>
                                    <input class="col-6 form-control"  name="date" id="date" type="text" value="{{date("Y-m-d") }}" >
                                </div>

                                <div class="form-group row">
                                    <label class="col-6" for="equipe ">Equipe</label>
                                    <select class="form-control col-4" id="equipe" name="equipe">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6" for="poste ">Poste</label>
                                    <select class="form-control col-4" id="poste" name="poste">
                                        @foreach($postes as $poste)
                                            <option value="{{$poste->Poste}}">{{$poste->Poste}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6" for="machine">Machine</label>
                                    <select class="form-control col-4" id="machine" name="machine">
                                        @foreach($machines as $machine)
                                            <option value="{{$machine->Machine}}">{{$machine->Machine}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-4 dernier-tube">
                                <h6>Dernier tube : &nbsp; <span class="valeur"> E6375</span></h6>
                                <h6>Observation : &nbsp;<span class="valeur"></span> </h6>
                                <hr>
                                <h6>Rapp Nº: &nbsp; <span class="valeur"> 184</span> </h6>
                                <h6>Dat:    &nbsp; <span class="valeur"> 29/02/2019</span></h6>
                                <h6>Equipe: &nbsp; <span class="valeur"> A</span></h6>
                                <h6>Poste:  &nbsp; <span class="valeur"> 01</span></h6>
                            </div>
                        </div>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-3" for="agent">Nom de l'agent</label>
                                <select class="form-control col-6" id="agent" name="agent">
                                    @foreach($operateurs as $operateur)
                                        <option value="{{$operateur->nom}}">{{$operateur->nom}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="col-3" for="agent">Code de l'agent</label>
                                <input class="col-3 form-control" type="text" placeholder="Code" readonly>
                                <div class="col-2"></div>
                                <button type="submit" class=" col-3 btn btn-success"> Valider</button>
                            </div>

                        </fieldset>
                    </fieldset>
                </form>

            </div>
        </section>
    </div>

@endsection
@section('script')

@endsection
