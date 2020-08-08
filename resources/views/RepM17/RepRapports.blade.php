@extends('layouts.app')

@section('style')
    <title>Rapport De Soudure Manuelle</title>
    <style>
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
            margin:0;
        }
        @media (min-width: 576px){
            .modal-dialog {
                max-width:800px;
            }
        }
        .table {
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }

        .table td {
            overflow: hidden;
            word-break: break-all;
            white-space: normal;
            text-overflow: ellipsis;
            color : #000;
        }
        .table-container{
            width: 100%;
            overflow: auto;
        }
        .top-content img{
            height: 100px;
        }

        label{
            margin-bottom: 0;
            padding-top: 5px;
        }
        .row .col-3 {
            margin-bottom: 0;
            vertical-align: middle;

        }
        .table{
            color : #000;
        }
        .table {
            table-layout: auto;
            width: 100%;
        }
        .table td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        h4{
            text-align: center;
            color : #2e59d9;
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
            text-align: center;
        }
        fieldset >.row {
        }

        span{
            color:red;
        }
        @media only screen and (min-width:1366px) and (max-width:769px) {

            .top-content{
                margin-left:0;
            }

        }
    </style>

@endsection
@section('content')
    <div class="container-fluid">


        <div class="row">
            <div class="body-content col-xl-6 col-lg-6 col-md-8 offset-xl-0 offset-lg-0 offset-md-2 col-sm-12 " >
                <section class="col-12">
                    <form method="post" action="{{route('rapports_Rep.store')}}">
                        @csrf
                        <fieldset>
                            <legend><h4>Information du rapport</h4> </legend>
                            <div class="form-group  row">
                                <label class="col-4" for="detail_project ">Detail Projet</label>
                                <select class="form-control col-xl-8 col-lg-8 col-md-8 col-sm-8" id="detail_project" name="detail_project">
                                    @foreach($details as $detail)
                                        <option value="{{$detail->Did}}">{{$detail->Nom}} -- Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-5" for="date" >Date du rapport</label>
                                        <input class="col-4 form-control"  name="date" id="date" type="date" value="{{date("Y-m-d") }}" >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-5" for="equipe ">Equipe</label>
                                        <select class="form-control col-4" id="equipe" name="equipe">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="poste ">Poste</label>
                                        <select class="form-control col-4" id="poste" name="poste">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-5" for="ZoneRep ">Zone de Réparation</label>
                                        <select class="form-control col-4" id="ZoneRep" name="ZoneRep" required>
                                            <option value="M18">M18</option>
                                            <option value="M19">M19</option>
                                            <option value="M20">M20</option>
                                            <option value="M21">M21</option>
                                        </select>
                                    </div>
                                </div>



                            </div>

                            <div class="form-group row">
                                <label class="col-3" for="agent">Agent 01</label>
                                <select class="form-control col-6" id="agent" name="agent">
                                    @if(isset($agents))
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach($agents as $agent)
                                            <option order="{{$i++}}" value="{{$agent->NomPrenom}}">{{$agent->NomPrenom}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input class="col-2 offset-1 form-control" placeholder="CODE" name="codeAgent"
                                       id="codeAgent" type="password" minlength="8" required>
                                @if(isset($Error))
                                    <label class="col-12 text-danger text-center" >{{$Error}}</label>
                                @endif
                            </div>

                            <hr>
                            <div class="form-group row">

                                <div class="col-3 ">
                                    <button type="button" type="button" id="imprimer" class="col-12 btn btn-outline-danger   "
                                            onclick="window.location.href='{{route('Rep_M17')}}'">
                                        <b><i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i> &nbsp;Retour</b>
                                    </button>
                                </div>
                                <div class="col-5">
                                <button type="button" class="col-12   btn btn-warning" data-toggle="modal"    data-target="#exampleModal">
                                    Reprendre un rapport
                                </button>
                                </div>
                                <div class="col-4">
                                <button   type="submit" class="col-12  btn btn-success"> Valider</button>
                                </div>
                            </div>
                        </fieldset>

                    </form>
                </section>
            </div>
            <div class=" col-xl-6 col-lg-6 col-md-12  col-sm-12">
                <section>
                    <h4>
                        Liste des derniers rapports
                    </h4>
                    <br>
                    <div class="row">
                        <div class="  table-container ">
                            <table class=" table table-striped table-hover table-borderless">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th>Date</th>
                                    <th>Poste</th>
                                    <th>Agent 1</th>
                                    <th>Clôturé</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($rapports))
                                    @foreach($rapports as $rapport)
                                        <tr id="rapport{{$rapport->Numero}}" @if($rapport->Etat=='C')class="Clot bg-success text-white" @else class="NotClot  " @endif >
                                            <td>{{$rapport->DateRapport}}</td>
                                            <td>{{$rapport->Poste}}</td>
                                            <td>{{$rapport->NomAgents}}  </td>
                                            @if($rapport->Etat=='C')<td>Oui</td>   @else <td>Non</td>  @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>

    @include('layouts.ReprendreRapport')
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            AddListeners();

            function AddListeners(){
                $('.Clot').each(function(){

                    $(this).dblclick(function(){
                        id=$(this).attr('id').replace(/[^0-9]/g,'');
                        alert('Rapport N°='+id+' est CLoturé');
                    });
                });
                $('.NotClot').each(function(){
                    $(this).dblclick(function(){
                        id=$(this).attr('id').replace(/[^0-9]/g,'');
                        window.location.href='{{url("/Reparation/")}}/'+id;
                    });
                });
            }

        });
    </script>
    @include('layouts.ReprendreRapScript',['rapport'=>'rapports_Rep','next'=>'Reparation'])
@endsection
