@extends('layouts.app')

@section('style')
    <style>

        button {
            margin: 10px 0;
        }

        span.valeur {
            color: red;
        }

        div.col-xl-3 {
            text-align: center;
        }

        .small-td {
            padding-left: 25px;

        }

        .small-td input {
            width: 18px;
            height: 18px;
            margin-top: -10px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        td {
            width: 20%;
            vertical-align: middle !important;
            text-align: center;

        }

        .table {
            color: #000;
            table-layout: fixed;
            width: 100%;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .large-td {
            width: 40%;
            vertical-align: super;
        }

        .btn {
            width: 100%;
        }

        .rapprods {
            table-layout: auto;
            width: 100%;
        }

        .rapprods td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .form-control {
            padding: 5px;
        }

        .inputs {
            margin-top: 10px;
            text-align: center;
        }
        .inputs label{
            font-weight: bold;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid">
        <section>
            <div class="row ">
                <div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">
                    <div class="row ">
                        <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                        <div class="col-10">
                            <h1>Project : {{$rapport->Project->Nom}}</h1>
                            <h5>Client: {{$rapport->Project->client->name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-xl-4 col-lg-4">
                    <div class="col-12">Information projet:</div>
                    <div class="col-12"><span class="valeur">   <span
                                    class="valeur"> Epais: {{$rapport->details->Epaisseur}}
                                mm -Diam : {{$rapport->details->Diametre}}mm</span></span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-3 col-lg-3">
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-2 col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-sm-12 col-md-8 col-xl-3 col-lg-3">
                    <div class="row">Agent: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}</span></div>
                    <div class="row">Machine: &nbsp; <span class="valeur">{{$rapport->Machine}}</span></div>
                </div>

            </div>
        </section>
        <section>
            <form id="rapprodForm">

                <div class="row">

                    <input name="Numero" type="hidden" id="Numero" value=" ">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6  inputs">
                        <label class="form-label" for="bobine">Bobine</label>

                        <input class="form-control" list="bobines" id="bobine" name="bobine" required>
                        <datalist id="bobines">
                            @if(isset($bobines))
                                @php
                                    $i=0;
                                @endphp

                                @foreach($bobines as $bobine)
                                    <option order="{{$i++}}" value="{{$bobine->Bobine}}">{{$bobine->Bobine}}</option>
                                @endforeach
                            @endif
                        </datalist>
                        <datalist id="bobines2">
                        </datalist>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs">
                        <label class="form-label" for="coulee">Coulee</label>
                        <input class="form-control" list="coulees" id="coulee" name="coulee" required>
                        <datalist id="coulees">
                            @if(isset($bobines))
                                @php
                                    $j=0;
                                @endphp
                                @foreach($bobines as $bobine)
                                    <option order="{{$j++}}" value="{{$bobine->Coulee}}">{{$bobine->Coulee}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                   for="Poids">Poids</label>
                        <input class="form-control" type="text" id="Poids" name="Poids" maxlength="10" minlength="5"
                               required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="LargeurD">Large
                            Debut</label>
                        <input class="form-control" type="number" value="" id="LargeurD" name="LargeurD" required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="LargeurF">Large
                            Fin</label>
                        <input class="form-control" type="number" value="" id="LargeurF" name="LargeurF" required></div>

                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurD">Epais
                            Debut</label>
                        <input class="form-control" type="number" value="" id="EpaisseurD" name="EpaisseurD" required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurC">Epais
                            Centre</label>
                        <input class="form-control" type="number" value="" id="EpaisseurC" name="EpaisseurC" required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurF">Epais
                            Fin</label>
                        <input class="form-control" type="number" value="" id="EpaisseurF" name="EpaisseurF" required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="ChuteT">Chute
                            Tete</label>
                        <input class="form-control" type="number" value="" id="ChuteT" name="ChuteT" required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="ChuteQ">Chute
                            Queue</label>
                        <input class="form-control" type="number" value="" id="ChuteQ" name="ChuteQ" required></div>

                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="DDB" name="DDB"
                               style="width:20px; height: 20px;">&nbsp;
                        <label class="form-check-label" for="DDB">DDB</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="DDB_R" name="DDB_R"
                               style="width:20px; height: 20px;">&nbsp;
                        <label class="form-check-label" for="DDB_R">DDB/R</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="FT" name="FT"
                               style="width:20px; height: 20px;">&nbsp;
                        <label class="form-check-label" for="FT">FT</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="GB_MB" name="GB_MB"
                               style="width:20px; height: 20px;">&nbsp;
                        <label class="form-check-label" for="GB_MB">GB/MB</label>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="Test1" name="Test1"
                               style="width:20px; height: 20px;">&nbsp;
                        <label class="form-check-label" for="Test1">Test (1)</label>
                    </div>

                    <div class=" col-lg-6 col-md-12 col-sm-6 inputs row "
                         style="margin-top:20px; font-size: 18px">
                        <label class="col-xl-3 col-lg-4 col-sm-12" for="observation">Observation</label>
                        <input class="col-xl-9 col-lg-8 col-sm-12 form-control" type="text" id="observation"
                               name="observation">
                    </div>
                    <hr>
                </div>
                <div class="row">
                    {{--<div class="col-xl-2 col-sm-6">--}}
                        {{--<button type="button" class="btn btn-secondary" data-toggle="modal"--}}
                                {{--data-target="#staticBackdrop">--}}
                            {{--Nouvelle Bobine--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    <div class="col-lg-2 col-md-3 col-sm-6 offset-lg-7 offset-md-5 ">
                        <button type="reset" id="annulerButton" class="btn btn-secondary"> Annuler</button>
                    </div>


                    <div class="col-lg-3 col-md-4 col-sm-6   ">
                        <button type="submit" id="ajouterRapprod" class="btn btn-success">Ajouter</button>
                    </div>


                </div>


            </form>
            <br>
            <div class="table-container">
                <table id="rapprodsTable" class="table table-striped table-hover table-bordered rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th rowspan="2">Coulee</th>
                        <th rowspan="2">Bobine</th>
                        <th rowspan="2">Poids</th>
                        <th colspan="2"> Largeur</th>
                        <th colspan="3"> Epaisseur</th>
                        <th colspan="5"> Defaut Metal</th>
                        <th colspan="5"> Chutes</th>
                        <th rowspan="2">Observation</th>

                    </tr>
                    <tr>
                        <th>Deb</th>
                        <th>Fin</th>
                        <th>Debut</th>
                        <th>Centre</th>
                        <th>Fin</th>
                        <th>DDB</th>
                        <th>DDB/R</th>
                        <th>FT</th>
                        <th>GB/MB</th>
                        <th>Test1</th>
                        <th>Tete</th>
                        <th>Queue</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($rapprods))
                        @foreach($rapprods as $rapprod)
                            <tr id="rapprod{{$rapprod->Numero}}">
                                <td id="coulee{{$rapprod->Numero}}">{{$rapprod->Coulee}}</td>
                                <td id="bobine{{$rapprod->Numero}}">{{$rapprod->Bobine}}</td>
                                <td id="tube{{$rapprod->Numero}}">{{$rapprod->Tube}}</td>
                                <td id="bis{{$rapprod->Numero}}">@if($rapprod->Bis) <input type="checkbox" checked
                                                                                           onclick="return false;">
                                    @elseif(!$rapprod->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="longueur{{$rapprod->Numero}}">{{$rapprod->Longueur}}</td>
                                <td id="macro{{$rapprod->Numero}}">{{$rapprod->macro}}</td>
                                <td id="rb{{$rapprod->Numero}}">@if($rapprod->RB) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                    @elseif(!$rapprod->R)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="observation{{$rapprod->Numero}}">{{$rapprod->Observation}}</td>
                                <td>
                                    <button id="rapprod{{$rapprod->Numero}}Edit" class="rapprodEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="rapprod{{$rapprod->Numero}}Delete" class="rapprodDelete text-danger"><i
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
                <div class="col-lg-6 col-sm-12 inputs row " style="margin-top:10px; font-size: 18px">
                    <label class="col-xl-4 col-lg-4 col-sm-12" for="observation">Observation</label>
                    <textarea class="col-xl-8 col-lg-8 col-sm-12 form-control" type="text" id="observation"
                              name="observation">
                    </textarea>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-4">
                    <form method="post" action="{{route('rapports.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-4">
                    <button id="cloturer" class="btn btn-success">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer</b>
                    </button>
                </div>
            </div>
        </section>
    </div>


    {{--<!-- Modal -->--}}
    {{--<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"--}}
         {{--aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document" id="BobineModal">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title" id="staticBackdropLabel">Ajout Bobine</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="form-group row">--}}
                        {{--<input type="hidden" id="RapportNum" name="RapportNum" value="{{$rapport->Numero}}">--}}
                        {{--<input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">--}}
                        {{--<input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">--}}
                        {{--<label class="col-4" for="coulee">Coulee</label>--}}
                        {{--<input class="col-6 form-control" name="coulee" id="Bcoulee" type="text" required>--}}
                    {{--</div>--}}
                    {{--<div class="form-group row">--}}
                        {{--<label class="col-4" for="bobine">Bobine</label>--}}
                        {{--<input class="col-6 form-control" name="bobine" id="Bbobine" type="text" required>--}}
                    {{--</div>--}}
                    {{--<div class="form-group row">--}}
                        {{--<label class="col-4" for="poids">Poids</label>--}}
                        {{--<input class="col-6 form-control" name="poids" id="poids" type="text" required>--}}
                    {{--</div>--}}
                    {{--<div class="form-group row">--}}
                    {{--<label class="col-4" for="fournisseur">Fournisseur</label>--}}
                    {{--<select class="form-control col-6" id="fournisseur" name="fournisseur" required>--}}
                    {{--<option value="1">ARCELOR</option>--}}
                    {{--<option value="2">THYSSEN</option>--}}
                    {{--<option value="3">SEVERSTAL</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}

                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>--}}
                        {{--<button id="AjouterBobine" class="btn btn-primary">Ajouter</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
@section('script')

    <script>

        $(document).ready(function () {

            $('#annulerButton').hide();
            addRapprodsListeners();
            $('#AjouterBobine').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('bobine')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        fournisseur: $('#fournisseur').val(),
                        bobine: $('#Bbobine').val(),
                        coulee: $('#Bcoulee').val(),
                        poids: $('#poids').val(),
                        Pid: $('#Pid').val(),
                        Did: $('#Did').val()
                    },
                    success: function (result) {
                        $('#bobine').append('<option value="' + result.bobine.Bobine + '">' + result.bobine.Bobine + '</option>');
                        $('#coulee').append('<option value="' + result.bobine.Coulee + '">' + result.bobine.Coulee + '</option>')
                        $('.modal').modal('hide');
                        $('.modal').on('hidden.bs.modal', function (e) {
                            $(this).removeData();
                        });
                    },
                    error: function (result) {
                        alert(result.responseJSON.message);
                        console.log(result)
                    }
                });
            });
            $('#ajouterRapprod').click(function (e) {
                if ($('#rapprodForm')[0].checkValidity()) {
                    ntube = $('#ntube').val();
                    if (ntube.length === 3) {
                        ntube = '0' + ntube;
                    } else if (ntube.length === 2) {
                        ntube = '00' + ntube;
                    } else if (ntube.length === 1) {
                        ntube = '000' + ntube;
                    }
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    if ($('#ajouterRapprod').html() !== ' Modifier tube ') {

                        $.ajax({
                            url: "{{ route('rapprod.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                machine: $('#machine').val(),
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                bobine: $('#bobine').val(),
                                coulee: $('#coulee').val(),
                                ntube: ntube,
                                bis: $('#bis:checked').length > 0,
                                longueur: $('#longueur').val(),
                                rb: $('#rb:checked').length > 0,
                                macro: $('#macro').val(),
                                sur_mas: $('#sur_mas:checked').length > 0,
                                test_1: $('#test_1:checked').length > 0,
                                test_2: $('#test_2:checked').length > 0,
                                test_3: $('#test_3:checked').length > 0
                            },
                            success: function (result) {
                                var bis = "";
                                var rb = "";
                                if (result.rapprod.Bis) {
                                    bis = "checked"
                                }
                                if (result.rapprod.RB) {
                                    rb = "checked"
                                }
                                $('#rapprodsTable').append('<tr id="rapprod' + result.rapprod.Numero + '">' +
                                    '                        <td id="coulee' + result.rapprod.Numero + '">' + result.rapprod.Coulee + '</td> ' +
                                    '                        <td id="bobine' + result.rapprod.Numero + '">' + result.rapprod.Bobine + '</td> ' +
                                    '                        <td id="tube' + result.rapprod.Numero + '">' + result.rapprod.Tube + '</td>' +
                                    '                        <td id="bis' + result.rapprod.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                    '                        <td id="longueur' + result.rapprod.Numero + '">' + result.rapprod.Longueur + '</td>' +
                                    '                        <td id="macro' + result.rapprod.Numero + '">' + result.rapprod.macro + '</td> ' +
                                    '                        <td id="rb' + result.rapprod.Numero + '">' + '<input type="checkbox" ' + rb + ' onclick="return false;">' +
                                    '                        <td id="observation' + result.rapprod.Numero + '">' + result.rapprod.Observation + '</td>' +
                                    '                        <td><button id="rapprod' + result.rapprod.Numero + 'Edit" class="rapprodEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="rapprod' + result.rapprod.Numero + 'Delete" class="rapprodDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');

                                addRapprodsListeners();
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('tube_pid_did_machine_numtube_unique')) {
                                        alert('Le tube n°=' + $('#machine').val() + ntube + ' existe dejà');
                                    } else {
                                        alert(result.responseJSON.message);
                                        console.log(result);
                                    }
                                } else {
                                    alert(result.responseJSON.error);

                                }
                            }
                        });
                    } else {

                        $.ajax({
                            url: "{{ url('/rapprod/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                machine: $('#machine').val(),
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                bobine: $('#bobine').val(),
                                coulee: $('#coulee').val(),
                                ntube: ntube,
                                bis: $('#bis:checked').length > 0,
                                longueur: $('#longueur').val(),
                                rb: $('#rb:checked').length > 0,
                                macro: $('#macro').val(),
                                Z01: true,
                                sur_mas: $('#sur_mas:checked').length > 0,
                                test_1: $('#test_1:checked').length > 0,
                                test_2: $('#test_2:checked').length > 0,
                                test_3: $('#test_3:checked').length > 0
                            },
                            success: function (result) {
                                var bis = "";
                                var rb = "";
                                if (result.rapprod.Bis) {
                                    bis = "checked"
                                }
                                if (result.rapprod.RB) {
                                    rb = "checked"
                                }
                                $('#rapprodsTable').find('#rapprod' + result.rapprod.Numero).replaceWith('<tr id="rapprod' + result.rapprod.Numero + '">' +
                                    '                        <td id="coulee' + result.rapprod.Numero + '">' + result.rapprod.Coulee + '</td> ' +
                                    '                        <td id="bobine' + result.rapprod.Numero + '">' + result.rapprod.Bobine + '</td> ' +
                                    '                        <td id="tube' + result.rapprod.Numero + '">' + result.rapprod.Tube + '</td>' +
                                    '                        <td id="bis' + result.rapprod.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                    '                        <td id="longueur' + result.rapprod.Numero + '">' + result.rapprod.Longueur + '</td>' +
                                    '                        <td id="macro' + result.rapprod.Numero + '">' + result.rapprod.macro + '</td> ' +
                                    '                        <td id="rb' + result.rapprod.Numero + '">' + '<input type="checkbox" ' + rb + ' onclick="return false;">' +
                                    '                        <td id="observation' + result.rapprod.Numero + '">' + result.rapprod.Observation + '</td>' +
                                    '                        <td><button id="rapprod' + result.rapprod.Numero + 'Edit" class="rapprodEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="rapprod' + result.rapprod.Numero + 'Delete" class="rapprodDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');
                                $('#ajouterRapprod').html(' Ajouter ');
                                $('#annulerButton').hide();
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });


                    }
                } else {

                }
            });
            $('#annulerButton').click(function () {

                refreshData();
                getLatestTube($('#machine').val());
            });

            function addRapprodsListeners() {
                refreshData();
                getLatestTube($('#machine').val());
                $('.rapprodDelete').each(function (e) {
                    refreshData();
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
                            url: "{{url('/rapprod/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                refreshData();
                                getLatestTube($('#machine').val());
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.rapprodEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {

                        $('#bobine').find('option[selected=selected]').removeAttr('selected');
                        $('#coulee').find('option[selected=selected]').removeAttr('selected');
                        e.preventDefault();
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#bobine').find('option[value=' + tr.find('#bobine' + id).html() + ']').first()
                            .replaceWith('<option value=' + tr.find('#bobine' + id).html() + ' selected >' + tr.find('#bobine' + id).html() + '</option>');
                        $('#coulee').find('option[value=' + tr.find('#coulee' + id).html() + ']').first()
                            .replaceWith('<option value=' + tr.find('#coulee' + id).html() + ' selected >' + tr.find('#coulee' + id).html() + '</option>');
                        $('#ntube').val(tr.find('#tube' + id).html().replace(/[^0-9]/g, '')).attr('readonly', 'readonly');
                        if ($('#bis' + id).find('input[checked]').length > 0) {

                            $('#bis').parent().html('<input class="form-check-input"  type="checkbox"  id="bis" name="bis" checked    >');
                        } else {
                            $('#bis').parent().html('<input class="form-check-input"  type="checkbox"  id="bis" name="bis"     >');
                        }
                        if ($('#rb' + id).find('input[checked]').length > 0) {
                            $('#rb').parent().html('<input class="form-check-input"  type="checkbox"  id="rb" name="rb"  checked   >');
                        } else {
                            $('#rb').parent().html('<input class="form-check-input"  type="checkbox"  id="rb" name="rb"     >');
                        }
                        $('#longueur').val(tr.find('#longueur' + id).html());
                        $('#macro').val(tr.find('#macro' + id).html());
                        $('#relv').val(tr.find('#relv' + id).html());
                        $('#Numero').val(id);
                        $('#ajouterRapprod').html(' Modifier tube ');
                        $('#annulerButton').show();
                        if ($('#observation' + id).html().includes('Sur Mas')) {

                            $('#sur_mas').parent().html('<input class="form-check-input" type="checkbox"  id="sur_mas" name="sur_mas" checked >' +
                                '<label class="form-check-label" for="sur_mas" >Sur Mas</label>');
                        } else {
                            $('#sur_mas').parent().html('<input class="form-check-input" type="checkbox"  id="sur_mas" name="sur_mas"  >' +
                                '<label class="form-check-label" for="sur_mas" >Sur Mas</label>');
                        }
                        if ($('#observation' + id).html().includes('Test (1)')) {
                            $('#test_1').parent().html('<input class="form-check-input" type="checkbox" id="test_1" name="test_1" checked >' +
                                '<label for="test_1">Test (1)</label>');
                        } else {
                            $('#test_1').parent().html('<input class="form-check-input" type="checkbox" id="test_1" name="test_1"  >' +
                                '<label for="test_1">Test (1)</label>');
                        }
                        if ($('#observation' + id).html().includes('Test (2)')) {
                            $('#test_2').parent().html('<input class="form-check-input" type="checkbox" id="test_2" name="test_2" checked >' +
                                '<label for="test_2">Test (2)</label>');
                        } else {
                            $('#test_2').parent().html('<input class="form-check-input" type="checkbox" id="test_2" name="test_2"  >' +
                                '<label for="test_2">Test (2)</label>');
                        }
                        if ($('#observation' + id).html().includes('Test (3)')) {
                            $('#test_3').parent().html('<input class="form-check-input" type="checkbox" id="test_3" name="test_3" checked >' +
                                '<label for="test_3">Test (3)</label>');
                        } else {
                            $('#test_3').parent().html('<input class="form-check-input" type="checkbox" id="test_3" name="test_3"  >' +
                                '<label for="test_3">Test (3)</label>');
                        }
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
                            window.location.href = '{{route("rapports.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);
                        console.log(result)

                    }
                });
            });

            function getLatestTube(machine) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/dernierTube/')}}/" + machine,
                    method: 'get',
                    data: {},
                    success: function (result) {
                        if (typeof result.dernierTubetab !== 'undefined') {
                            ntube = parseInt(result.dernierTubetab.Tube.replace(/[^0-9]/g, '')) + 1;
                            ntube = ntube + '';
                            if (ntube.length === 3) {
                                ntube = '0' + ntube;
                            } else if (ntube.length === 2) {
                                ntube = '00' + ntube;
                            } else if (ntube.length === 1) {
                                ntube = '000' + ntube;
                            }
                        } else {
                            ntube = '0001';
                        }
                        $('#ntube').val(ntube);
                    },
                    error: function (result) {
                        console.log(result);
                        if (result.responseJSON.message.includes('Undefined offset: 0')) {
                            $('#ntube').val('0001');
                        } else {
                            alert(result.responseJSON.message);
                            console.log(result)
                        }
                    }
                });

            }

            function refreshData() {
                $('#ntube').removeAttr('readonly');
                $('#ajouterRapprod').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bobine').find('option[selected=selected]').removeAttr('selected');
                $('#coulee').find('option[selected=selected]').removeAttr('selected');
                $('#bis').parent().html('<input class="form-check-input"  type="checkbox"  id="bis" name="bis"     >');
                $('#rb').parent().html('<input class="form-check-input"  type="checkbox"  id="rb" name="rb"     >');
                $('#sur_mas').parent().html('<input class="form-check-input" type="checkbox"  id="sur_mas" name="sur_mas"  >' +
                    '<label class="form-check-label" for="sur_mas" >Sur Mas</label>');

                $('#test_1').parent().html('<input class="form-check-input" type="checkbox" id="test_1" name="test_1"  >' +
                    '<label for="test_1">Test (1)</label>');
                $('#test_2').parent().html('<input class="form-check-input" type="checkbox" id="test_2" name="test_2"  >' +
                    '<label for="test_2">Test (2)</label>');
                $('#test_3').parent().html('<input class="form-check-input" type="checkbox" id="test_3" name="test_3"  >' +
                    '<label for="test_3">Test (3)</label>');
                $('#bobine').find('option:selected').removeAttr('selected');
                $('#coulee').find('option:selected').removeAttr('selected');
            }

            $('#bobine').keydown(function () {
                if ($(this).val() === "") {
                    $(this).attr('list', "bobines");
                }
            });
            $('#bobine').on('change', function () {
                if ($(this).val() !== "") {
                    const bobine = $(this).val();
                    var Pid = $('#Pid').val();
                    var Did = $("#Did").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{url('/couleeGet')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            bobine: bobine,
                            Pid: Pid,
                            Did: Did,
                        },
                        success: function (result) {
                            if (result.bobine != null) {
                                $('#coulee').val(result.bobine.Coulee);
                                $('#Poids').val(result.bobine.Poids);
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.error);
                            console.log(result);
                        }
                    });
                }
            });
            $('#coulee').on('change', function () {
                const coulee = $(this).val();
                var Pid = $('#Pid').val();
                var Did = $("#Did").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/bobineGet')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        coulee: coulee,
                        Pid: Pid,
                        Did: Did,
                    },
                    success: function (result) {
                        if (result.bobines != null) {
                            var bobines = result.bobines;
                            bobines.forEach(function (item, index) {
                                $('#bobines2').append('<option order="' + index + '" value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                $('#bobine').attr('list', 'bobines2');
                            });
                            //  $('#bobine').val(result.bobines);
                        }
                    },
                    error: function (result) {
                        alert(result.responseJSON.error);
                        console.log(result);
                    }
                });
            });
        });


    </script>
@endsection
