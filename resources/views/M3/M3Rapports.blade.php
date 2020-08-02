@extends('layouts.app')

@section('style')
    <style>
        /*input[type="date"]::-webkit-inner-spin-button,*/
        /*input[type="date"]::-webkit-calendar-picker-indicator {*/
        /*display: none;*/
        /*-webkit-appearance: none;*/
        /*margin:0;*/
        /*}*/
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 800px;
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
            color: #000;
        }

        .table-container {
            width: 100%;
            overflow: auto;
        }

        .top-content img {
            height: 100px;
        }

        label {
            margin-bottom: 0;
            padding-top: 5px;
        }

        .row .col-3 {
            margin-bottom: 0;
            vertical-align: middle;

        }

        .table {
            color: #000;
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

        h4 {
            text-align: center;
            color: #2e59d9;
        }

        fieldset {
            padding: 20px;
        }

        fieldset fieldset {
            padding: 10px;
            margin-top: 30px;
        }

        fieldset legend {
            color: #2e59d9;
            width: auto;
            text-align: center;
        }

        fieldset > .row {
        }

        span {
            color: red;
        }

        @media only screen and (min-width: 1366px) and (max-width: 769px) {

            .top-content {
                margin-left: 0;
            }

        }
    </style>

@endsection
@section('content')
    <div class="container-fluid">


        <div class="row">
            <div class="body-content col-xl-6 col-lg-6 col-md-8 offset-xl-0 offset-lg-0 offset-md-2 col-sm-12 ">
                <section class="col-12">
                    <form method="post" action="{{route('rapports_M3.store')}}">
                        @csrf
                        <fieldset>
                            <legend><h4>Information du rapport</h4></legend>
                            <div class="form-group  row">
                                <label class="col-4" for="detail_project">Detail Projet</label>
                                <select class="form-control col-8" id="detail_project" name="detail_project">
                                    @if(isset($details))
                                        @foreach($details as $detail)
                                            <option value="{{$detail->Did}}">{{$detail->Nom}} --
                                                Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-4" for="date">Date du rapport</label>
                                        <input class="col-4 form-control" name="date" id="date" type="date"
                                               value="{{date("Y-m-d") }}" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4" for="equipe ">Equipe</label>
                                        <select class="form-control col-2" id="equipe" name="equipe">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4" for="poste ">Poste</label>
                                        <select class="form-control col-2" id="poste" name="poste">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3" for="agent">Agent</label>
                                <select class="form-control col-5" id="agent" name="agent" required>
                                    @if(isset($agents))
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach($agents as $agent)
                                            <option order="{{$i++}}"
                                                    value="{{$agent->NomPrenom}}">{{$agent->NomPrenom}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input class="col-2 offset-1 form-control" placeholder="CODE" name="codeAgent"
                                       id="codeAgent" type="password" minlength="8" required>
                                @if(isset($Error))
                                    <label class="col-12 text-danger text-center">{{$Error}}</label>
                                @endif
                            </div>
                            <hr>
                            <div class="form-group row">
                                <button type="button" class="col-5  btn btn-warning" data-toggle="modal"
                                        data-target="#exampleModal">
                                    Reprendre un rapport
                                </button>
                                <button type="submit" class=" col-4 offset-3 btn btn-success"> Valider</button>
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
                                    <th>Equipe</th>
                                    <th>Poste</th>
                                    <th>Agent</th>
                                    <th>Clôturé</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($rapports))
                                    @foreach($rapports as $rapport)
                                        <tr id="rapport{{$rapport->Numero}}"
                                            @if($rapport->Etat=='C')class="Clot bg-success text-white"
                                            @else class="NotClot  " @endif >

                                            <td>{{$rapport->DateRapport}}</td>
                                            <td>{{$rapport->Equipe}}</td>
                                            <td>{{$rapport->Poste}}</td>
                                            <td>{{$rapport->NomAgents}} </td>
                                            @if($rapport->Etat=='C')
                                                <td>Oui</td>   @else
                                                <td>Non</td>  @endif
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
        $(document).ready(function () {

            AddListeners();

            function AddListeners() {
                $('.Clot').each(function () {

                    $(this).dblclick(function () {
                        id = $(this).attr('id').replace(/[^0-9]/g, '');
                        alert('Rapport N°=' + id + ' est CLoturé');
                    });
                });
                $('.NotClot').each(function () {
                    $(this).dblclick(function () {
                        id = $(this).attr('id').replace(/[^0-9]/g, '');
                        window.location.href = '{{url("/M3/")}}/' + id;
                    });
                });
            }


        });
    </script>
    @include('layouts.ReprendreRapScript',['rapport'=>'rapports_M3','next'=>'M3'])
@endsection
