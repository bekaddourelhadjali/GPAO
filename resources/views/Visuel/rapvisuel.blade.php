    @extends('layouts.app')

@section('style')
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

        .actions .col-1 {
            margin-right: 4px;

        }

        #arretForm button {
            margin-top: 0;
        }

        #annulerButton {
            padding: 0;
        }

        .visuelEdit, .visuelDelete {
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
        }

        .small-td {
            width: 8%
        }

        .medium-td {
            width: 12%
        }

        input[type=checkbox] {
            width: 18px;
            height: 18px;
            margin-top: 5px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        td, th {
            padding: 2px;
            vertical-align: middle !important;
            text-align: center;
        }

        .table {
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }

        .table-container {
            width: 100%;
            overflow: auto;
        }

        .table td {
            overflow: hidden;
            word-break: break-all;
            white-space: normal;
            text-overflow: ellipsis;
            color: #000;
        }

        .large-td {
            width: 17%;
            vertical-align: super;
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

        td {
            vertical-align: middle !important;
            text-align: center;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }


    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <div class="container-fluid">

        <section id="head-section">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-xl-5 col-lg-5">
                    <div class="col-12">Information Rapport:&nbsp;<span class="valeur">   <span
                                    class="valeur"> Epais: {{$rapport->details->Epaisseur}}
                                mm -Diam : {{$rapport->details->Diametre}}mm</span></span></div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-2 col-lg-2">
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-2 col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-sm-12 col-md-8 col-xl-3 col-lg-3">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                            / {{$rapport->CodeAgent}}</span></div>
                    <div class="row">Agent2: &nbsp; <span class="valeur">{{$rapport->NomAgents1}}
                            / {{$rapport->CodeAgent1}}</span></div>
                </div>

            </div>
        </section>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <hr>
                    <form id="visuelForm" autocomplete="off">
                        <input name="Numero" type="hidden" id="Numero" value=" ">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                        <table>
                            <thead>
                            <tr>
                                <th> N°Tube</th>
                                <th> Bis</th>
                                <th> Longueur</th>
                                <th> Diam-D</th>
                                <th> Diam-F</th>
                                <th> E</th>
                                <th> Y</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="large-td"><input class="  form-control" type="text" id="ntube" name="ntube"
                                                            value="" maxlength="5" minlength="5" required pattern="[A-E]\d{4}"></td>
                                <td class="small-td"><input class=" " type="checkbox" id="bis" name="bis"></td>
                                <td class="large-td"><input class=" form-control" type="number" min="7500" max="13500"
                                                            id="longueur" name="longueur" required></td>

                                <td class="large-td"><input class="  form-control" type="number" id="diam_d"
                                                            name="diam_d" required></td>
                                <td class="large-td"><input class="  form-control" type="number" id="diam_f"
                                                            name="diam_f" required></td>
                                <td class="medium-td"><input class=" form-control" type="number" id="E" name="E"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="number" id="Y" name="Y"
                                                             required></td>

                            </tr>
                            <tr>

                                <th>Tube Sond</th>
                                <th> RB</th>
                                <th> EY</th>
                                <th> U</th>
                                <th> S</th>
                                <th> W</th>
                                <th>A.C.</th>

                            </tr>
                            <tr>
                                <td class="small-td"><input class=" " type="checkbox" id="Sond" name="Sond"></td>
                                <td class="small-td"><input class=" " type="checkbox" id="RB" name="RB"></td>
                                <td class="medium-td"><input class=" form-control" type="number" id="EY" name="EY"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="text" id="U" name="U"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="text" id="S" name="S"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="text" id="W" name="W"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="text" id="AC" name="AC"
                                                             required></td>

                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="row " >


                            <button type="reset" class="col-2  btn btn-secondary" type="button" id="annulerButton">
                                Annuler
                            </button>
                            <button type="submit" class="col-4   offset-1  btn btn-success" type="button" id="Ajouter">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <section class="top-actions">
                    <h5>Observation sur Soudure</h5>
                    <hr>
                    <form id="Form1">
                        <table>
                            <thead>
                            <tr>
                                <th> Nbr</th>
                                <th> Defaut</th>
                                <th> Val</th>
                                <th> Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class=" " style="width:10%"><input class="  form-control" type="number" id="nbr1"
                                                                       name="nbr1"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="defaut1"
                                                                        name="defaut1">
                                        <option hidden disabled selected value></option>
                                        @if(isset($defautsSoudure))
                                            @foreach($defautsSoudure as $defaut )
                                                <option defautId="{{$defaut->id}}" data-tokens="{{$defaut->Defaut}}"
                                                        value="{{$defaut->Defaut}}"
                                                        class="my-select">{{$defaut->Defaut}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>
                                <td class=" " style="width:20%"><input class=" form-control" type="number" id="valeur1"
                                                                       name="valeur1"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="operation1"
                                                                        name="operation1" required>
                                        <option hidden disabled selected value></option>
                                        @if(isset($operations))
                                            @foreach($operations as $operation)
                                                <option operationId="{{$operation->id}}"
                                                        value="{{$operation->Operation}}"
                                                        class="my-select">{{$operation->Operation}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>

                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row actions">
                        <div class="col-1">
                            <button id="addObsSoudure" class="btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-1">
                            <button id="removeObsSoudure" class="btn btn-danger"><b><i class="fa fa-minus "></i></b></button>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="ObsSoudure" class=" form-control col-12" readonly>

                    </div>


                </section>
            </div>
            <div class="col-xl-4 col-lg-6  col-md-6 col-sm-12">
                <section class="top-actions">
                    <h5>Observation sur metal de base</h5>
                    <hr>
                    <form id="Form2">
                        <table>
                            <thead>
                            <tr>
                                <th> Nbr</th>
                                <th> Defaut</th>
                                <th> Val</th>
                                <th> Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class=" " style="width:10%"><input class="  form-control" type="number" id="nbr2"
                                                                       name="nbr2"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="defaut2"
                                                                        name="defaut2">
                                        <option hidden disabled selected value></option>
                                        @if(isset($defautsMetal))
                                            @foreach($defautsMetal as $defaut )
                                                <option defautId="{{$defaut->id}}" value="{{$defaut->Defaut}}"
                                                        class="my-select">{{$defaut->Defaut}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class=" " style="width:20%"><input class=" form-control" type="number" id="valeur2"
                                                                       name="valeur2"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="operation2"
                                                                        name="operation2" required>
                                        <option hidden disabled selected value></option>
                                        @if(isset($operations))
                                            @foreach($operations as $operation)
                                                <option operationId="{{$operation->id}}"
                                                        value="{{$operation->Operation}}"
                                                        class="my-select">{{$operation->Operation}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>

                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row actions">
                        <div class="col-1">
                            <button id="addObsMetal" class="btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-1">
                            <button id="removeObsMetal" class="btn btn-danger"><b><i class="fa fa-minus "></i></b></button>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="ObsMetal" class=" form-control col-12" readonly>

                    </div>
                </section>

            </div>
        </div>
        <section class="col-12">
            <div class="table-container">
                <table id="visuelsTable" class="table table-striped table-hover table-bordered rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width:80px">Tube</th>
                        <th>Bis</th>
                        <th>Sond</th>
                        <th>Longueur</th>
                        <th>E</th>
                        <th>Y</th>
                        <th>EY</th>
                        <th>RB</th>
                        <th>U</th>
                        <th>S</th>
                        <th>W</th>
                        <th>A.C</th>
                        <th>DiamD</th>
                        <th>DiamF</th>
                        <th style="min-width:300px">ObsSoudure</th>
                        <th style="min-width:300px">ObsMetal</th>
                        <th style="min-width:100px"> </th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($visuels))
                        @foreach($visuels as $visuel)
                            <tr id="visuel{{$visuel->Numero}}">
                                <td id="tube{{$visuel->Numero}}">{{$visuel->Tube}}</td>
                                <td id="bis{{$visuel->Numero}}">@if($visuel->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                    @elseif(!$visuel->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="sond{{$visuel->Numero}}">@if($visuel->Sond) <input type="checkbox" checked
                                                                                           onclick="return false;">
                                    @elseif(!$visuel->Sond)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="longueur{{$visuel->Numero}}">{{$visuel->Longueur}}</td>
                                <td id="E{{$visuel->Numero}}">{{$visuel->E}}</td>
                                <td id="Y{{$visuel->Numero}}">{{$visuel->Y}}</td>
                                <td id="EY{{$visuel->Numero}}">{{$visuel->EY}}</td>
                                <td id="RB{{$visuel->Numero}}">@if($visuel->RB) <input type="checkbox" checked
                                                                                           onclick="return false;">
                                    @elseif(!$visuel->RB)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="U{{$visuel->Numero}}">{{$visuel->U}}</td>
                                <td id="S{{$visuel->Numero}}">{{$visuel->S}}</td>
                                <td id="W{{$visuel->Numero}}">{{$visuel->W}}</td>
                                <td id="AC{{$visuel->Numero}}">{{$visuel->AC}}</td>
                                <td id="diam_d{{$visuel->Numero}}">{{$visuel->DiamD}}</td>
                                <td id="diam_f{{$visuel->Numero}}">{{$visuel->DiamF}}</td>
                                <td class="obsS" id="obsSoudure{{$visuel->Numero}}">{{$visuel->ObsSoudure}}</td>
                                <td class="obsM" id="obsMetal{{$visuel->Numero}}">{{$visuel->ObsMetal}}</td>
                                <td>
                                    <button id="visuel{{$visuel->Numero}}Edit" class="visuelEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="visuel{{$visuel->Numero}}Delete" class="visuelDelete text-danger"><i
                                                class="fa fa-trash"></i></button>
                                </td>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div class="row">
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    {{--<button type="button" id="imprimer" class="btn btn-outline-primary col-12">--}}
                        {{--<b><i class="fa fa-print" style="font-size: 20px;"></i> &nbsp;&nbsp;Imprimer</b>--}}
                    {{--</button>--}}
                </div>
                <div class=" col-lg-3  col-md-6 col-sm-12">
                    <form method="post" action="{{route('rapports_visuels.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le
                                rapport</b></button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer
                            Rapport</b></button>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    @include('layouts.ArretsLayout')


@endsection
@section('script')

    @include('layouts.ArretScript')
    <script>

        $(document).ready(function () {
            DefautsSoudure = [];
            DefautsMetal = [];
            $('.my-select').selectpicker();
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#addObsSoudure').click(function (e) {
                e.preventDefault();
                if ($('#defaut1').val() !== null && $('#operation1').val() !== null) {
                    if ($('#operation1').val() !== 'R.A.S') {
                        Opr = $('#operation1').val();
                        IdDef = $('#defaut1').find("option:selected").attr("defautId");
                        Defaut = $('#defaut1').val();
                        Valeur = $('#valeur1').val();
                        NbOpr = $('#operation1').find("option:selected").attr("operationId");
                        Nombre = $('#nbr1').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        DefautsSoudure.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                        console.log(DefautsSoudure);
                        SetDefautsSoudure();

                    } else {
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }

            });
            $('#addObsMetal').click(function (e) {
                e.preventDefault();
                if ($('#defaut2').val() !== null && $('#operation2').val() !== null) {
                    if ($('#operation2').val() !== 'R.A.S') {
                        Opr = $('#operation2').val();
                        IdDef = $('#defaut2').find("option:selected").attr("defautId");
                        Defaut = $('#defaut2').val();
                        Valeur = $('#valeur2').val();
                        NbOpr = $('#operation2').find("option:selected").attr("operationId");
                        Nombre = $('#nbr2').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        DefautsMetal.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                        console.log(DefautsMetal);
                        SetDefautsMetal();
                    } else {
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });
            $('#removeObsSoudure').click(function (e) {
                e.preventDefault();
                DefautsSoudure.shift();
                if (DefautsSoudure.length > 0) {
                    SetDefautsSoudure();
                } else {
                    $('#ObsSoudure').val('');
                }

            });
            $('#removeObsMetal').click(function (e) {
                e.preventDefault()
                DefautsMetal.shift();
                if (DefautsMetal.length > 0) {
                    SetDefautsMetal();
                } else {
                    $('#ObsMetal').val('');
                }
            });
            $('#Ajouter').click(function (e) {
                if ($('#visuelForm')[0].checkValidity()) {
                e.preventDefault();

                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    ntube = $('#ntube').val();

                    if ($('#Ajouter').html() !== ' Modifier ') {
                        if ((DefautsSoudure.length > 0 || $('#operation1').val() === 'R.A.S')
                            && (DefautsMetal.length > 0 || $('#operation2').val() === 'R.A.S')) {
                            if (DefautsSoudure.length > 0) {

                                obsSoud = $('#ObsSoudure').val() + '|' + DefautsSoudure[DefautsSoudure.length - 1][0] + '|';
                            } else if ($('#operation1').val() === 'R.A.S') {
                                obsSoud = $('#operation1').val();
                                DefautsSoudure.push([
                                    Opr = $('#operation1').val(), null, null, null, $('#operation1').find("option:selected").attr("operationId"), null]);
                            }
                            if (DefautsMetal.length > 0) {

                                obsMet = $('#ObsMetal').val() + '|' + DefautsMetal[DefautsMetal.length - 1][0] + '|';

                            } else if ($('#operation2').val() === 'R.A.S') {
                                obsMet = $('#operation2').val();
                                DefautsMetal.push([
                                    Opr = $('#operation2').val(), null, null, null, $('#operation2').find("option:selected").attr("operationId"), null]);
                            }
                            $.ajax({
                                url: "{{ route('visuels.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    machine: $('#machine').val(),
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumeroRap: $('#NumRap').val(),
                                    ntube: ntube,
                                    bis: $('#bis:checked').length > 0,
                                    longueur: $('#longueur').val(),
                                    sond: $('#Sond:checked').length > 0,
                                    RB: $('#RB:checked').length > 0,
                                    E: $('#E').val(),
                                    Y: $('#Y').val(),
                                    EY: $('#EY').val(),
                                    U: $('#U').val(),
                                    S: $('#S').val(),
                                    W: $('#W').val(),
                                    AC: $('#AC').val(),
                                    Diam_D: $('#diam_d').val(),
                                    Diam_F: $('#diam_f').val(),
                                    ObsMetal: obsMet,
                                    ObsSoudure: obsSoud,
                                    Defauts: DefautsSoudure.concat(DefautsMetal),
                                },
                                success: function (result) {
                                    var bis = "";
                                    var sond = "";
                                    var RB = "";
                                    if (result.visuel.Bis) {
                                        bis = "checked"
                                    }
                                    if (result.visuel.Sond) {
                                        sond = "checked"
                                    }
                                    if (result.visuel.RB) {
                                        RB = "checked"
                                    }
                                    $('#visuelsTable').append('<tr id="visuel' + result.visuel.Numero + '">' +
                                        '                        <td id="tube' + result.visuel.Numero + '">' + result.visuel.Tube + '</td> ' +
                                        '                        <td id="bis' + result.visuel.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                        '                        <td id="sond' + result.visuel.Numero + '">' + '<input type="checkbox" ' + sond + ' onclick="return false;">' +
                                        '                        <td id="longueur' + result.visuel.Numero + '">' + result.visuel.Longueur + '</td>' +
                                        '                        <td id="E' + result.visuel.Numero + '">' + result.visuel.E + '</td> ' +
                                        '                        <td id="Y' + result.visuel.Numero + '">' + result.visuel.Y + '</td> ' +
                                        '                        <td id="EY' + result.visuel.Numero + '">' + result.visuel.EY + '</td> ' +
                                        '                        <td id="RB' + result.visuel.Numero + '">' + '<input type="checkbox" ' + RB + ' onclick="return false;">' +
                                        '                        <td id="U' + result.visuel.Numero + '">' + result.visuel.U + '</td> ' +
                                        '                        <td id="S' + result.visuel.Numero + '">' + result.visuel.S + '</td> ' +
                                        '                        <td id="W' + result.visuel.Numero + '">' + result.visuel.W + '</td> ' +
                                        '                        <td id="AC' + result.visuel.Numero + '">' + result.visuel.AC + '</td> ' +
                                        '                        <td id="diam_d' + result.visuel.Numero + '">' + result.visuel.DiamD + '</td>' +
                                        '                        <td id="diam_f' + result.visuel.Numero + '">' + result.visuel.DiamF + '</td>' +
                                        '                        <td id="obsSoudure' + result.visuel.Numero + '">' + result.visuel.ObsSoudure + '</td>' +
                                        '                        <td id="obsMetal' + result.visuel.Numero + '">' + result.visuel.ObsMetal + '</td>' +
                                        '                        <td><button id="visuel' + result.visuel.Numero + 'Edit" class="visuelEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                        '                            <button id="visuel' + result.visuel.Numero + 'Delete" class="visuelDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                        '                             </td>' +
                                        '                    </tr>');
                                    $('#visuelForm').trigger("reset");
                                    $('#Form1').trigger("reset");
                                    $('#Form2').trigger("reset");
                                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                    $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                                    $('#RB').prop('checked',false);
                                    $('#ObsMetal').val('');
                                    $('#ObsSoudure').val('');
                                    DefautsSoudure = [];
                                    DefautsMetal = [];

                                    addRapprodsListeners();
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                    console.log(result);
                                }
                            });
                    } else {
                        alert("Choisir soit l'opération R.A.S ou signaler un défaut et choisir une opération correspendante");
                    }

                    } else {

                        $.ajax({
                            url: "{{url('/visuels/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                machine: $('#machine').val(),
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: ntube,
                                longueur: $('#longueur').val(),
                                sond: $('#Sond:checked').length > 0,
                                RB: $('#RB:checked').length > 0,
                                E: $('#E').val(),
                                Y: $('#Y').val(),
                                EY: $('#EY').val(),
                                U: $('#U').val(),
                                S: $('#S').val(),
                                W: $('#W').val(),
                                AC: $('#AC').val(),
                                Diam_D: $('#diam_d').val(),
                                Diam_F: $('#diam_f').val(),
                            },
                            success: function (result) {
                                console.log(result);
                                var bis = "";
                                var sond = "";
                                var RB = "";
                                if (result.visuel.Bis) {
                                    bis = "checked"
                                }
                                if (result.visuel.Sond) {
                                    sond = "checked"
                                }
                                if (result.visuel.Sond) {
                                    RB = "checked"
                                }
                                $('#visuel' + id).replaceWith('<tr id="visuel' + result.visuel.Numero + '">' +
                                    '                        <td id="tube' + result.visuel.Numero + '">' + result.visuel.Tube + '</td> ' +
                                    '                        <td id="bis' + result.visuel.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                    '                        <td id="sond' + result.visuel.Numero + '">' + '<input type="checkbox" ' + sond + ' onclick="return false;">' +
                                    '                        <td id="longueur' + result.visuel.Numero + '">' + result.visuel.Longueur + '</td>' +
                                    '                        <td id="E' + result.visuel.Numero + '">' + result.visuel.E + '</td> ' +
                                    '                        <td id="Y' + result.visuel.Numero + '">' + result.visuel.Y + '</td> ' +
                                    '                        <td id="EY' + result.visuel.Numero + '">' + result.visuel.EY + '</td> ' +
                                    '                        <td id="RB' + result.visuel.Numero + '">' + '<input type="checkbox" ' + RB + ' onclick="return false;">' +
                                    '                        <td id="U' + result.visuel.Numero + '">' + result.visuel.U + '</td> ' +
                                    '                        <td id="S' + result.visuel.Numero + '">' + result.visuel.S + '</td> ' +
                                    '                        <td id="W' + result.visuel.Numero + '">' + result.visuel.W + '</td> ' +
                                    '                        <td id="AC' + result.visuel.Numero + '">' + result.visuel.AC + '</td> ' +
                                    '                        <td id="diam_d' + result.visuel.Numero + '">' + result.visuel.DiamD + '</td>' +
                                    '                        <td id="diam_f' + result.visuel.Numero + '">' + result.visuel.DiamF + '</td>' +
                                    '                        <td id="obsSoudure' + result.visuel.Numero + '">' + result.visuel.ObsSoudure + '</td>' +
                                    '                        <td id="obsMetal' + result.visuel.Numero + '">' + result.visuel.ObsMetal + '</td>' +
                                    '                        <td><button id="visuel' + result.visuel.Numero + 'Edit" class="visuelEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="visuel' + result.visuel.Numero + 'Delete" class="visuelDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');


                                $('#visuelForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                                $('#RB').prop('checked',false);
                                $('#ObsMetal').val('');
                                $('#ObsSoudure').val('');
                                $('#ntube').removeAttr("readonly");
                                $('#Bis').removeAttr("readonly");
                                EnableForms();
                                addRapprodsListeners();
                                DefautsSoudure = [];
                                DefautsMetal = [];
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });

                    }


                } else {
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#visuelForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                $('#RB').prop('checked',false);
                $('#ObsMetal').val('');
                $('#ObsSoudure').val('');
                $('#ntube').removeAttr("readonly");
                $('#Bis').removeAttr("readonly");
                EnableForms();
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.visuelDelete').each(function (e) {
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
                            url: "{{url('/visuels/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                $('#visuelForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                                $('#RB').prop('checked',false);
                                $('#ObsMetal').val('');
                                $('#ObsSoudure').val('');
                                $('#ntube').removeAttr("readonly");
                                $('#Bis').removeAttr("readonly");
                                EnableForms();
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });

                    $('#ntube').removeAttr("readonly");
                });
                $('.visuelEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#ntube').val($('#tube' + id).html()).attr('readonly', 'readonly');
                        $('#bis').prop('checked',$('#bis' + id).find('input[checked]').length > 0).attr('readonly', 'readonly');
                        $('#Sond').prop('checked',$('#sond' + id).find('input[checked]').length > 0);
                        $('#RB').prop('checked',$('#RB' + id).find('input[checked]').length > 0);
                        $('#longueur').val($('#longueur' + id).html());
                        $('#E').val($('#E' + id).html());
                        $('#Y').val($('#Y' + id).html());
                        $('#EY').val($('#EY' + id).html());
                        $('#U').val($('#U' + id).html());
                        $('#S').val($('#S' + id).html());
                        $('#W').val($('#W' + id).html());
                        $('#AC').val($('#AC' + id).html());
                        $('#diam_d').val($('#diam_f' + id).html());
                        $('#diam_f').val($('#diam_f' + id).html());
                        $('#ObsMetal').val($('#obsMetal' + id).html());
                        $('#ObsSoudure').val($('#obsSoudure' + id).html());
                        $('#Ajouter').html(' Modifier ');
                        $('#annulerButton').show();
                        DisableForms();
                        $('#bis').removeAttr("readonly");
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
                            window.location.href = '{{route("rapports_visuels.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });

            function SetDefautsSoudure() {
                $('#ObsSoudure').val('');

                DefautsSoudure.forEach(function (item, index) {

                    if (typeof item[2] !== 'undefined') {
                        obs = item[2];
                        if ($('#nbr1').val() > 0) {
                            obs = $('#nbr1').val() + ' ' + obs;
                        }
                        if ($('#valeur1').val() > 0) {
                            obs = obs + '(' + $('#valeur1').val() + ')';
                        }
                        if (DefautsSoudure.length > index + 1) {
                            NextOp = DefautsSoudure[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#ObsSoudure').val($('#ObsSoudure').val() + '+' + obs);
                        } else {
                            $('#ObsSoudure').val($('#ObsSoudure').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsSoudure = $('#ObsSoudure').val();
                        if (ObsSoudure.charAt(0) === '+')
                            $('#ObsSoudure').val(ObsSoudure.substr(1));
                    }
                });


            }

            function SetDefautsMetal() {
                $('#ObsMetal').val('');
                DefautsMetal.forEach(function (item, index) {
                    if (typeof item[2] !== 'undefined') {
                        obs = item[2];
                        if ($('#nbr2').val() > 0) {
                            obs = $('#nbr2').val() + ' ' + obs;
                        }
                        if ($('#valeur2').val() > 0) {
                            obs = obs + '(' + $('#valeur2').val() + ')';
                        }
                        if (DefautsMetal.length > index + 1) {
                            NextOp = DefautsMetal[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#ObsMetal').val($('#ObsMetal').val() + '+' + obs);
                        } else {
                            $('#ObsMetal').val($('#ObsMetal').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsMetal = $('#ObsMetal').val();
                        if (ObsMetal.charAt(0) === '+')
                            $('#ObsMetal').val(ObsMetal.substr(1));
                    }
                });

            }

            function DisableForms() {
                $('#nbr1').prop('disabled', true);
                $('#nbr2').prop('disabled', true);
                $('#defaut1').prop('disabled', true);
                $('#defaut2').prop('disabled', true);
                $('#valeur1').prop('disabled', true);
                $('#valeur2').prop('disabled', true);
                $('#operation1').prop('disabled', true);
                $('#operation2').prop('disabled', true);
                $('#addObsMetal').prop('disabled', true);
                $('#addObsSoudure').prop('disabled', true);
                $('#removeObsMetal').prop('disabled', true);
                $('#removeObsSoudure').prop('disabled', true);
            }

            function EnableForms() {
                $('#nbr1').prop('disabled', false);
                $('#nbr2').prop('disabled', false);
                $('#defaut1').prop('disabled', false);
                $('#defaut2').prop('disabled', false);
                $('#valeur1').prop('disabled', false);
                $('#valeur2').prop('disabled', false);
                $('#operation1').prop('disabled', false);
                $('#operation2').prop('disabled', false);
                $('#addObsMetal').prop('disabled', false);
                $('#addObsSoudure').prop('disabled', false);
                $('#removeObsMetal').prop('disabled', false);
                $('#removeObsSoudure').prop('disabled', false);
            }
        });
        $('#imprimer').click(function (e) {
            e.preventDefault();

            window.open('{{route("printRap",["id"=>$rapport->Numero])}}', '_blank');
        });

    </script>

@endsection
