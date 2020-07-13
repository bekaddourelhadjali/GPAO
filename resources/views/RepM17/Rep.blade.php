@extends('layouts.app')

@section('style')
    {{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />--}}
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }

        .obsM, .obsS {
            width: 25% !important;
        }

        #rapportPage .valeur {
            font-weight: bolder;
            color: #000;
        }

        select {
            font-family: 'FontAwesome', 'Arial';
        }

        section.top-actions {

        }

        .actions .col-1 {
            margin-right: 4px;

        }

        #arretForm button {
            margin-top: 0;
        }

        .rx1Edit, .rx1Delete {
            margin: 0;
        }

        .actions .btn {
            padding: 0;
            width: 35px;
            font-size: 20px;
            font-weight: bolder;
        }

        button {
            margin: 10px 0;
        }

        span.valeur {
            color: red;
        }

        h5 {
            color: #0e8ce4;
            text-align: center;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }

        input[type=checkbox] {
            min-width: 18px;
            min-height: 18px;
            margin-top: 5px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        th {
            padding: 8px 4px !important;
            vertical-align: middle !important;
            text-align: center !important;
        }

        .table {
            min-width: 800px;
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
        }

        .table-container {
            overflow: auto;
        }

        .table td {
            padding: 2px !important;
            overflow: hidden;
            word-break: break-all;
            text-overflow: ellipsis;
            white-space: normal;
            color: #000;
            vertical-align: middle !important;
            text-align: center !important;
        }

        .form-group label {
            font-weight: bold;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .form-control {
            padding: 0;
            text-align: center;
        }

        #du, #au {
            padding: .375rem .50rem;
        }

        input {
            padding: 0;
        }

        span.valeur {
            color: red;
        }

        #operatuersTable td {
            text-align: left;
        }

        .small-td input {
            width: 18px;
            height: 18px;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .defs {
            font-weight: bold;
            cursor: pointer;
            border-width: 2px;
        }

        #defauts {
            margin-bottom: 10px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <div class="container-fluid">

        <section id="head-section">
            <div class="row">
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-6 col-sm-2  col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-6 col-sm-6  col-lg-3">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                            / {{$rapport->CodeAgent}}</span></div>
                    <div class="row">Agent2: &nbsp; <span class="valeur">{{$rapport->NomAgents1}}
                            / {{$rapport->CodeAgent1}}</span></div>
                </div>

            </div>
        </section>
        <form class="row" id="repForm">
            <div class="col-xl-4 col-lg-5 col-md-8 offset-md-2 offset-lg-0 col-sm-12 ">

                <section class="top-actions">
                    <h5>Info Tube</h5>

                    <input name="Numero" type="hidden" id="Numero" value="">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                    <div class="row">
                        <div class=" col-5">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0">Tube</label>
                                <select class="form-control col-12" style="color:#00f" id="ntube" name="ntube"
                                        required>
                                    <option disabled>Tube &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bis</option>
                                    @foreach($tubes as $tube)
                                        <option value="{{$tube->Tube}}"> {{$tube->Tube}} &nbsp;
                                            &nbsp;&nbsp; @if($tube->Bis) &#xf14a; @else &#xf0c8;  @endif </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" col-1">
                            <div class="form-group ">
                                <label class="col-12" for="bis" style="padding-left: 0">Bis</label>
                                <input class=" col-12" type="checkbox" id="bis" name="bis">
                            </div>
                        </div>
                        <div class="  col-6">
                            <div class="form-group text-center">
                                <label class="col-12" for="Longueur" style="padding-left: 0">Longueur</label>
                                <input class="form-control col-12" type="number" id="Longueur" name="Longueur"
                                       required>
                            </div>
                        </div>
                        <div class="form-group col-12  ">
                            <label for="observation" class="col-12">Observation</label>
                            <input type="text" class="form-control" name="observation" id="observation">
                        </div>
                        <div class="col-12 ">
                            <button style="margin-right: 10px;" type="reset"
                                    class=" col-5 btn btn-outline-secondary " id="annulerButton">Annuler
                            </button>
                            </button>
                            <button style="margin-right: 10px;" type="submit" class=" col-5 btn btn-success"
                                    id="Ajouter">Ajouter
                            </button>
                        </div>

                    </div>
                </section>
            </div>

            <div class="col-xl-8 col-lg-7 col-sm-12">
                <section class="top-actions">
                    <h5>Désignation des anomalies</h5>

                    <div class="row">
                        <div class="col-4 col-sm-2 col-lg-2">
                            <div class="form-group ">
                                <label class="col-12" for="nbr">Nbr</label>
                                <input class="  form-control" type="number" id="nbr" name="nbr">
                            </div>
                        </div>
                        <div class="col-8   col-sm-3">
                            <div class="form-group ">
                                <label class="col-12" for="defaut">Defaut</label>
                                <select class="form-control" id="defaut" name="defaut" required>
                                    <option hidden disabled selected value></option>
                                    @if(isset($defauts ))
                                        @foreach($defauts as $defaut )
                                            <option defautId="{{$defaut->id}}" value="{{$defaut->Defaut}}"
                                                    class="my-select">{{$defaut->Defaut}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-sm-2">
                            <div class="form-group ">
                                <label class="col-12" for="valeur">Valeur</label>
                                <input class=" form-control" type="number" id="valeur" name="valeur">
                            </div>
                        </div>
                        <div class="col-8 col-sm-3">
                            <div class="form-group ">
                                <label class="col-12" for="operation">Operation</label>
                                <select class="form-control" id="operation" name="operation" required>
                                    <option hidden disabled selected value></option>
                                    @if(isset($operations))
                                        @foreach($operations as $operation)
                                            <option operationId="{{$operation->id}}"
                                                    value="{{$operation->Operation}}"
                                                    class="my-select">{{$operation->Operation}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="col-sm-1 col-2">

                            <label class="col-12" for=""> </label>
                            <button id="addDefaut" class=" btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-1">
                            <label class="col-12" for=""> </label>
                            <button id="removeDefaut" class="btn btn-danger"><b><i class="fa fa-minus "></i></b>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="defauts" class=" form-control col-12" readonly>

                    </div>
                    <div class="row ">
                        <div class="col-5 col-sm-6 col-md-4 ">
                            <div class="form-group text-center">
                                <label class="col-12">Defaut</label>
                                <span class="  col-5 btn btn-outline-secondary defs" id="Int">Int</span>
                                <span class="  col-5 btn btn-outline-secondary defs" id="Ext">Ext</span>
                            </div>
                        </div>
                        <div class="col-7 col-sm-6 col-md-5 col-lg-6">
                            <div class="form-group text-center">
                                <label class="col-12">Réparation</label>
                                <span class=" col-3 btn btn-outline-secondary defs" id="Rep1">1</span>
                                <span class="  col-3 btn btn-outline-secondary defs" id="Rep2">2</span>
                                <span class="  col-3 btn btn-outline-secondary defs" id="Rep3">3 +</span>
                            </div>
                        </div>


                    </div>


                </section>

            </div>
        </form>
        <section class="col-12">
            <div class="table-container">
                <table id="rx1sTable" class="table table-striped table-hover table-bordered rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>Longueur</th>
                        <th>Operation</th>
                        <th>Defaut</th>
                        <th>Int</th>
                        <th>Ext</th>
                        <th>1 Rép</th>
                        <th>2 Rép</th>
                        <th>3 Rép</th>
                        <th>Observation</th>
                    </tr>
                    </thead>
                    <tbody id="reps">
                    @if(isset($reps))
                        @foreach($reps as $item)
                            <tr id="rep{{$item->Id}}">
                                <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Longueur{{$item->Id}}">{{$item->Longueur}}</td>
                                <td id="Operation{{$item->Id}}"> {{$item->Defauts}} </td>
                                <td id="Defaut{{$item->Id}}">{{$item->Defauts}} </td>
                                <td id="Int{{$item->Id}}">@if($item->DfInt) <input type="checkbox" checked
                                                                                   onclick="return false;">
                                    @elseif(!$item->DfInt)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Ext{{$item->Id}}">@if($item->DfExt) <input type="checkbox" checked
                                                                                   onclick="return false;">
                                    @elseif(!$item->DfExt)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Rep1_{{$item->Id}}">@if($item->Rep1) <input type="checkbox" checked
                                                                                    onclick="return false;">
                                    @elseif(!$item->Rep1)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Rep2_{{$item->Id}}">@if($item->Rep2) <input type="checkbox" checked
                                                                                    onclick="return false;">
                                    @elseif(!$item->Rep2)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Rep3_{{$item->Id}}">@if($item->Rep3) <input type="checkbox" checked
                                                                                    onclick="return false;">
                                    @elseif(!$item->Rep3)<input type="checkbox" onclick="return false;"> @endif</td>

                                <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                <td>
                                    <button id="rep{{$item->Id}}Edit" class="repEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="rep{{$item->Id}}Delete" class="repDelete text-danger"><i
                                                class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="row" id="bottom-actions">

                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button type="button" type="button" id="imprimer" class="btn btn-warning col-12"
                            onclick="window.location.href='{{route('Rep_M17')}}'">
                        <b><i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i> &nbsp;&nbsp;Rapport M17</b>
                    </button>
                </div>
                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button type="button" id="imprimer" class="btn btn-outline-primary col-12">
                        <b><i class="fa fa-print" style="font-size: 20px;"></i> &nbsp;&nbsp;Imprimer</b>
                    </button>
                </div>
                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">
                        <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b></button>
                </div>
                <div class="  col-lg-2  col-md-4 col-sm-6 ">
                    <form method="post" action="{{route('rapports_Rep.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le rapport</b></button>
                    </form>
                </div>
                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer
                            Rapport</b></button>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->

    @include('layouts.ArretsLayout');
    @include('layouts.CarteTubeLayout');
@endsection
@section('script')

    <script>

        $(document).ready(function () {
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();
            var Reps = [];
            var defauts = [];
            initDefauts();
            var Defauts = [];
            //Add Defaut
            $('#addDefaut').click(function (e) {
                e.preventDefault();
                if ($('#defaut').val() !== null && $('#operation').val() !== null) {
                    Opr = $('#operation').val();
                    IdDef = $('#defaut').find("option:selected").attr("defautId");

                    Defaut = $('#defaut').val();

                    Valeur = $('#valeur').val();
                    NbOpr = $('#operation').find("option:selected").attr("operationId");
                    Nombre = $('#nbr').val();
                    if (Valeur === '' || Valeur === 0) {
                        Valeur = null;
                    }
                    if (Nombre === '' || Nombre === 0) {
                        Nombre = null;
                    }
                    Defauts.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                    SetDefauts();

                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });
            //Remove Defaut
            $('#removeDefaut').click(function (e) {
                e.preventDefault();
                latDefaut = Defauts.pop();
                if (Defauts.length > 0) {
                    SetDefauts();
                } else {
                    $('#defauts').val('');
                }
            });

            function SetDefauts() {
                $('#defauts').val('');
                Defauts.forEach(function (item, index) {
                    if (typeof item[2] !== 'undefined') {
                        obs = item[2];
                        if (item[5] > 0) {
                            obs = item[5] + ' ' + obs;
                        }
                        if (item[3] > 0) {
                            obs = obs + '(' + item[3] + ')';
                        }
                        if (Defauts.length > index + 1) {
                            NextOp = Defauts[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#defauts').val($('#defauts').val() + '+' + obs);
                        } else {
                            $('#defauts').val($('#defauts').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsMetal = $('#defauts').val();
                        if (ObsMetal.charAt(0) === '+')
                            $('#defauts').val(ObsMetal.substr(1));
                    }
                });

            }


            function initDefauts() {
                defauts["Int"] = 0;
                defauts["Ext"] = 0;
                Reps = [];
                Reps["Rep1"] = 0;
                Reps["Rep2"] = 0;
                Reps["Rep3"] = 0;
                $('.defs').each(function () {

                    $(this).addClass('btn-outline-secondary');
                    $(this).removeClass('btn-danger');

                });

            }

            function initReps() {
                for (const [key, value] of Object.entries(Reps)) {
                    if (Reps[key]) {
                        $("#" + key).removeClass('btn-outline-secondary');
                        $("#" + key).addClass('btn-danger');
                    } else {
                        $("#" + key).addClass('btn-outline-secondary');
                        $("#" + key).removeClass('btn-danger');
                    }
                }

            }

            $('#Rep1').click(function () {
                Reps["Rep1"] = !Reps["Rep1"];
                if (Reps["Rep1"]) {
                    Reps["Rep2"] = !Reps["Rep1"];
                    Reps["Rep3"] = !Reps["Rep1"];
                }
                initReps();
            });
            $('#Rep2').click(function () {
                Reps["Rep2"] = !Reps["Rep2"];
                if (Reps["Rep2"]) {
                    Reps["Rep1"] = !Reps["Rep2"];
                    Reps["Rep3"] = !Reps["Rep2"];
                }
                initReps();
            });
            $('#Rep3').click(function () {
                Reps["Rep3"] = !Reps["Rep3"];
                if (Reps["Rep3"]) {
                    Reps["Rep1"] = !Reps["Rep3"];
                    Reps["Rep2"] = !Reps["Rep3"];
                }
                initReps();
            });
            $('#Ext').click(function () {
                defauts["Ext"] = !defauts["Ext"];
                    $("#Ext").toggleClass('btn-outline-secondary');
                    $("#Ext").toggleClass('btn-danger');

            });
            $('#Int').click(function () {
                defauts["Int"] = !defauts["Int"];
                    $("#Int").toggleClass('btn-outline-secondary');
                    $("#Int").toggleClass('btn-danger');
            });

            //Ajouter Reparation
            $('#Ajouter').click(function (e) {
                if ($('#repForm')[0].checkValidity()) {
                    e.preventDefault();
                    if ((defauts["Ext"] || defauts["Int"]) && (Reps["Rep1"] || Reps["Rep2"] || Reps["Rep3"])) {

                        const id = $('#Numero').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        if (Defauts.length > 0 || $('#operation').val() === 'R.A.S') {
                            if (Defauts.length > 0) {

                                obs = $('#defauts').val() + '|' + Defauts[Defauts.length - 1][0] + '|';
                            } else if ($('#operation').val() === 'R.A.S') {
                                obs = $('#operation').val();
                                Defauts.push([
                                    Opr = $('#operation').val(), null, null, null, $('#operation').find("option:selected").attr("operationId"), null]);
                            }
                            if ($('#Ajouter').html() !== ' Modifier ') {
                                $.ajax({
                                    url: "{{ route('Reparation.store')}}",
                                    method: 'post',
                                    data: {
                                        _token: '{{csrf_token()}}',
                                        Pid: $('#Pid').val(),
                                        Did: $('#Did').val(),
                                        NumeroRap: $('#NumRap').val(),
                                        ntube: $('#ntube').val(),
                                        bis: $('#bis:checked').length > 0,
                                        Observation: $('#observation').val() + "",
                                        Longueur: $('#Longueur').val(),
                                        Int: defauts["Int"],
                                        Ext: defauts["Ext"],
                                        Rep1: Reps["Rep1"],
                                        Rep2: Reps["Rep2"],
                                        Rep3: Reps["Rep3"],
                                        Defauts: Defauts,
                                        Obs: obs,
                                    },
                                    success: function (result) {
                                        var item = result.rep;
                                        $('#reps').append('<tr id="rep' + item.Id + '">\n' +
                                            '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                            '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                            '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                            '                                <td    id="Operation' + item.Id + '">' + item.Defauts + '</td>\n' +
                                            '                                <td    id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                            '                                <td id="Int' + item.Id + '"><input type="checkbox" ' + item.Int_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Ext' + item.Id + '"><input type="checkbox" ' + item.Ext_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep1_' + item.Id + '"><input type="checkbox" ' + item.Rep1_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep2_' + item.Id + '"><input type="checkbox" ' + item.Rep2_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep3_' + item.Id + '"><input type="checkbox" ' + item.Rep3_t + '  onclick="return false;"></td>' +
                                            '                                <td     id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                            '                                <td>\n' +
                                            '                                    <button id="rep' + item.Id + 'Edit" class="repEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                            '                                    <button id="rep' + item.Id + 'Delete" class="repDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                            '                                </td>\n' +
                                            '                            </tr>');
                                        $('#repForm').trigger("reset");
                                        $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                        defauts = [];
                                        initDefauts();
                                        Defauts = [];
                                        addRapprodsListeners();
                                    },
                                    error: function (result) {
                                        alert(result.responseJSON.message);
                                        console.log(result);
                                    }
                                });

                            } else {
                                $.ajax({
                                    url: "{{url('/Reparation/')}}/" + id,
                                    method: 'post',
                                    data: {
                                        _method: 'put',
                                        _token: '{{csrf_token()}}',
                                        Pid: $('#Pid').val(),
                                        Did: $('#Did').val(),
                                        NumeroRap: $('#NumRap').val(),
                                        ntube: $('#ntube').val(),
                                        bis: $('#bis:checked').length > 0,
                                        Observation: $('#observation').val() + "",
                                        Longueur: $('#Longueur').val(),
                                        Int: defauts["Int"],
                                        Ext: defauts["Ext"],
                                        Rep1: Reps["Rep1"],
                                        Rep2: Reps["Rep2"],
                                        Rep3: Reps["Rep3"],
                                        Defauts: Defauts,
                                        Obs: obs,
                                        id: id
                                    },
                                    success: function (result) {
                                        var item = result.rep;
                                        console.log(item);
                                        $('#rep' + id).html('<td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                            '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                            '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                            '                                <td    id="Operation' + item.Id + '">' + item.Defauts + '</td>\n' +
                                            '                                <td    id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                            '                                <td id="Int' + item.Id + '"><input type="checkbox" ' + item.Int_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Ext' + item.Id + '"><input type="checkbox" ' + item.Ext_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep1_' + item.Id + '"><input type="checkbox" ' + item.Rep1_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep2_' + item.Id + '"><input type="checkbox" ' + item.Rep2_t + '  onclick="return false;"></td>' +
                                            '                                <td id="Rep3_' + item.Id + '"><input type="checkbox" ' + item.Rep3_t + '  onclick="return false;"></td>' +
                                            '                                <td   id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                            '                                <td>\n' +
                                            '                                    <button id="rep' + item.Id + 'Edit" class="repEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                            '                                    <button id="rep' + item.Id + 'Delete" class="repDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                            '                                </td>');
                                        // $('#rep' + id).replaceWith('<tr id="rep' + item.Id + '">\n' +
                                        // '                                \n' +
                                        // '                            </tr>');
                                        $('#repForm').trigger("reset");
                                        $('#Ajouter').html(' Ajouter ');
                                        $('#annulerButton').hide();
                                        $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                        defauts = [];
                                        Defauts = [];
                                        initDefauts();
                                        $('#ntube').prop('disabled', false);
                                        addRapprodsListeners();
                                    },
                                    error: function (result) {
                                        alert(result.responseJSON.message);
                                        console.log(result);

                                    }
                                });

                            }
                        } else {
                            alert("Choisir soit l'opération R.A.S ou signaler un défaut et choisir une opération correspendante");
                        }
                    } else {
                        alert("Choisir Le type de defaut Ext ou Int et Le nombre de réparations");
                    }
                } else {
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#repForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#defauts').val('');
                $('#ntube').prop('disabled', false);
                defauts = [];
                initDefauts();
                Defauts = [];
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.repDelete').each(function (e) {

                    $(this).off('click');
                    $(this).click(function (e) {
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/Reparation/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });

                    $('#repForm').trigger("reset");
                    $('#Ajouter').html(' Ajouter ');
                    $('#annulerButton').hide();
                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                    $('#defauts').val('');
                    $('#ntube').prop('disabled', false);
                    defauts = [];
                    initDefauts();
                    Defauts = [];
                });
                $('.repEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/Reparation/')}}/" + id + '/edit',
                            method: 'get',
                            data: {
                                id: id,


                            },
                            success: function (result) {
                                $('#Numero').val(id);
                                rep = result.rep;
                                Defauts = [];
                                rep.defs.forEach(function (item, index) {
                                    Defauts.push([item.Opr, item.IdDef, item.Defaut, item.Valeur, item.NbOpr, item.Nombre]);
                                });
                                SetDefauts();
                                $('#operation').val(Defauts[Defauts.length - 1][0]);
                                $('#defaut').val(Defauts[Defauts.length - 1][2]);
                                $('#ntube').prop('disabled', true);
                                $('#Numero').val(id);
                                $('#ntube').val($("#tube" + id).html());
                                $('#Longueur').val($("#Longueur" + id).html());
                                $('#observation').val($("#Observation" + id).html());
                                if ($('#bis' + id).html().includes('checked'))
                                    $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"   checked      >');
                                else
                                    $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"          >');

                                if ($('#Int' + id).html().includes('checked')) {
                                    $('#Int').removeClass('btn-outline-secondary');
                                    $('#Int').addClass('btn-danger');
                                    defauts['Int'] = 1;
                                } else {
                                    $('#Int').addClass('btn-outline-secondary');
                                    $('#Int').removeClass('btn-danger');
                                    defauts['Int'] = 0;
                                }
                                if ($('#Ext' + id).html().includes('checked')) {
                                    $('#Ext').removeClass('btn-outline-secondary');
                                    $('#Ext').addClass('btn-danger');
                                    defauts['Ext'] = 1;
                                } else {
                                    $('#Ext').addClass('btn-outline-secondary');
                                    $('#Ext').removeClass('btn-danger');
                                    defauts['Ext'] = 0;
                                }
                                if ($('#Rep1_' + id).html().includes('checked')) {
                                    $('#Rep1').removeClass('btn-outline-secondary');
                                    $('#Rep1').addClass('btn-danger');
                                    Reps['Rep1'] = 1;
                                } else {
                                    $('#Rep1').addClass('btn-outline-secondary');
                                    $('#Rep1').removeClass('btn-danger');
                                    Reps['Rep1'] = 0;
                                }
                                if ($('#Rep2_' + id).html().includes('checked')) {
                                    $('#Rep2').removeClass('btn-outline-secondary');
                                    $('#Rep2').addClass('btn-danger');
                                    Reps['Rep2'] = 1;
                                } else {
                                    $('#Rep2').addClass('btn-outline-secondary');
                                    $('#Rep2').removeClass('btn-danger');
                                    Reps['Rep2'] = 0;
                                }

                                if ($('#Rep3_' + id).html().includes('checked')) {
                                    $('#Rep3').removeClass('btn-outline-secondary');
                                    $('#Rep3').addClass('btn-danger');
                                    Reps['Rep3'] = 1;
                                } else {
                                    $('#Rep3').addClass('btn-outline-secondary');
                                    $('#Rep3').removeClass('btn-danger');
                                    Reps['Rep3'] = 0;
                                }

                                $('#Ajouter').html(' Modifier ');
                                $('#annulerButton').show();
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });

                    });
                });
            }

            $('#cloturer').click(function (e) {
                const Numero = $('#NumRap').val();
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/cloturer')}}/" + Numero,
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                            window.location.href = '{{route("rapports_Rep.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });
            $('#imprimer').click(function (e) {
                e.preventDefault();

                window.open('{{route("printRX1Rap",["id"=>$rapport->Numero])}}', '_blank');
            });

        });


    </script>
    @include('layouts.ArretScript');
    @include('layouts.CarteTubeScript');
@endsection
