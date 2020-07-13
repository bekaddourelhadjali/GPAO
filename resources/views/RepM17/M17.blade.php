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

        #defauts span {
            margin-right: 10px;
            font-weight: bold;
            cursor: pointer;
            border-width: 2px;
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
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-8 offset-md-2 offset-lg-0 col-sm-12 ">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="msForm">
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
                                    <label class="col-12" for="LongCh" style="padding-left: 0">Long Chute</label>
                                    <input class="form-control col-12" type="number" id="LongCh" name="LongCh" required>
                                </div>
                            </div>
                            <div class="form-group col-12  ">
                                <label for="observation" class="col-12">Observation</label>
                                <input type="text" class="form-control" name="observation" id="observation">
                            </div>


                        </div>
                    </form>
                </section>
            </div>

            <div class="col-xl-8 col-lg-7 col-sm-12">
                <section class="top-actions">
                    <h5>Désignation des anomalies</h5>
                    <form id="Form">
                        <div class="row" id="defauts">
                            <span class="mb-3 col-5 col-lg-2 col-md-3 col-sm-3 btn btn-outline-secondary" id="Oxyc">OXYC.M</span>
                            <span class="mb-3 col-5 col-lg-2 col-md-2 col-sm-3 btn btn-outline-secondary"
                                  id="RB">RB</span>
                            <span class="mb-3 col-5 col-lg-2 col-md-3 col-sm-3 btn btn-outline-secondary" id="Eprouv">Eprouv</span>
                            <span class="mb-3 col-5 col-lg-3 col-md-3 col-sm-3 btn btn-outline-secondary" id="NdHt">Q ND HT</span>
                            <span class="mb-3 col-5 col-lg-2 col-md-3 col-sm-3 btn btn-outline-secondary" id="Vis">VISUEL</span>
                            <span class="mb-3 col-5 col-lg-2 col-md-3 col-sm-3 btn btn-outline-secondary" id="Scop">SCOPE</span>
                            <span class="mb-3 col-5 col-lg-2 col-md-3 col-sm-3 btn btn-outline-secondary" id="Final">FINAL</span>
                            <span class="mb-3 col-5 col-lg-3 col-md-3 col-sm-3 btn btn-outline-secondary" id="DdbFt">MD DDB FT</span>

                        </div>
                        <div class="row   flex-row-reverse">
                            <button style="margin-right: 10px;" type="submit" class=" mb-3 col-2    btn btn-success"
                                    id="Ajouter">Ajouter
                            </button>
                            <button style="margin-right: 10px;" type="reset"
                                    class=" mb-3 col-2 btn btn-outline-secondary " id="annulerButton">Annuler
                            </button>


                        </div>
                    </form>

                </section>

            </div>
        </div>
        <section class="col-12">
            <div class="table-container">
                <table id="rx1sTable" class="table table-striped table-hover table-bordered rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>opération</th>
                        <th>Long Chute</th>
                        <th>OXYC.M</th>
                        <th>RB</th>
                        <th>EPROUV</th>
                        <th>Q ND HT</th>
                        <th>VISUEL</th>
                        <th>SCOPE</th>
                        <th>FINAL</th>
                        <th>MD DDB FT</th>
                        <th>Observation</th>
                    </tr>
                    </thead>
                    <tbody id="ms">
                    @if(isset($m17))
                        @foreach($m17 as $item)
                            <tr id="ms{{$item->Id}}">
                                <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="operation{{$item->Id}}">{{$item->Operation}}</td>
                                <td id="longChute{{$item->Id}}">{{$item->LongCh}}</td>
                                <td id="Oxyc{{$item->Id}}">@if($item->Oxyc) <input type="checkbox" checked
                                                                                   onclick="return false;">
                                    @elseif(!$item->Oxyc)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="RB{{$item->Id}}">@if($item->RB) <input type="checkbox" checked
                                                                               onclick="return false;">
                                    @elseif(!$item->RB)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Eprouv{{$item->Id}}">@if($item->Eprouv) <input type="checkbox" checked
                                                                                       onclick="return false;">
                                    @elseif(!$item->Eprouv)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="NdHt{{$item->Id}}">@if($item->NdHt) <input type="checkbox" checked
                                                                                   onclick="return false;">
                                    @elseif(!$item->NdHt)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Vis{{$item->Id}}">@if($item->Vis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Vis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Scop{{$item->Id}}">@if($item->Scop) <input type="checkbox" checked
                                                                                   onclick="return false;">
                                    @elseif(!$item->Scop)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Final{{$item->Id}}">@if($item->Final) <input type="checkbox" checked
                                                                                     onclick="return false;">
                                    @elseif(!$item->Final)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Ddbft{{$item->Id}}">@if($item->DdbFt) <input type="checkbox" checked
                                                                                     onclick="return false;">
                                    @elseif(!$item->DdbFt)<input type="checkbox" onclick="return false;"> @endif</td>

                                <td class="obsS" id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                <td>
                                    <button id="ms{{$item->Id}}Edit" class="msEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="ms{{$item->Id}}Delete" class="msDelete text-danger"><i
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
                        <b><i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i> &nbsp;Rapport
                            Réparation</b>
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
                <div class="  col-lg-2 col-md-4 col-sm-6">
                    <form method="post" action="{{route('rapports_M17.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter
                                le rapport</b></button>
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
            var defauts = [];
            initDefauts();

            function initDefauts() {
                defauts["Oxyc"] = 0;
                defauts["RB"] = 0;
                defauts["Eprouv"] = 0;
                defauts["NdHt"] = 0;
                defauts["Vis"] = 0;
                defauts["Scop"] = 0;
                defauts["Final"] = 0;
                defauts["DdbFt"] = 0;
                $('#defauts span').each(function () {

                    $(this).addClass('btn-outline-secondary');
                    $(this).removeClass('btn-danger');

                });

            }

            $('#defauts span').each(function () {

                $(this).click(function () {
                    defauts[$(this).attr("id")] = !defauts[$(this).attr("id")];
                    $(this).toggleClass('btn-outline-secondary');
                    $(this).toggleClass('btn-danger');

                });
            });
            $('#Ajouter').click(function (e) {
                e.preventDefault();
                if ($('#msForm')[0].checkValidity()) {
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#Ajouter').html() !== ' Modifier ') {
                        $.ajax({
                            url: "{{ route('M17.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                bis: $('#bis:checked').length > 0,
                                Observation: $('#observation').val(),
                                LongCh: $('#LongCh').val(),
                                oxyc: defauts["Oxyc"],
                                rb: defauts["RB"],
                                Eprouv: defauts["Eprouv"],
                                ndht: defauts["NdHt"],
                                vis: defauts["Vis"],
                                scope: defauts["Scop"],
                                final: defauts["Final"],
                                DdbFt: defauts["DdbFt"],
                            },
                            success: function (result) {
                                var item = result.m17;
                                $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="operation' + item.Id + '">' + item.Operation + '</td>\n' +
                                    '                                <td     id="longChute' + item.Id + '">' + item.LongCh + '</td>\n' +
                                    '                                <td id="Oxyc' + item.Id + '"><input type="checkbox" ' + item.Oxyc_t + '  onclick="return false;"></td>' +
                                    '                                <td id="RB' + item.Id + '"><input type="checkbox" ' + item.RB_t + '  onclick="return false;"></td>' +
                                    '                                <td id="Eprouv' + item.Id + '"><input type="checkbox" ' + item.Eprouv_t + '  onclick="return false;"></td>' +
                                    '                                <td id="NdHt' + item.Id + '"><input type="checkbox" ' + item.NdHt_t + '  onclick="return false;"></td>' +
                                    '                                <td id="Vis' + item.Id + '"><input type="checkbox" ' + item.Vis_t + '  onclick="return false;"></td>' +
                                    '                                <td id="Scop' + item.Id + '"><input type="checkbox" ' + item.Scop_t + '  onclick="return false;"></td>' +
                                    '                                <td id="Final' + item.Id + '"><input type="checkbox" ' + item.Final_t + '  onclick="return false;"></td>' +
                                    '                                <td id="Ddbft' + item.Id + '"><input type="checkbox" ' + item.DdbFt_t + '  onclick="return false;"></td>' +
                                    '\n' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                defauts = [];
                                initDefauts();
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });

                    } else {
                        $.ajax({
                            url: "{{url('/M17/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                bis: $('#bis:checked').length > 0,
                                Observation: $('#observation').val(),
                                LongCh: $('#LongCh').val(),
                                oxyc: defauts["Oxyc"],
                                rb: defauts["RB"],
                                Eprouv: defauts["Eprouv"],
                                ndht: defauts["NdHt"],
                                vis: defauts["Vis"],
                                scope: defauts["Scop"],
                                final: defauts["Final"],
                                DdbFt: defauts["DdbFt"],
                                id: id
                            },
                            success: function (result) {
                                var item = result.m17;
                                $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="operation' + item.Id + '">' + item.Operation + '</td>\n' +
                                    '                                <td     id="longChute' + item.Id + '">' + item.LongCh + '</td>\n' +
                                    '                                 <td id="Oxyc' + item.Id + '"><input type="checkbox" ' + item.Oxyc_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="RB' + item.Id + '"><input type="checkbox" ' + item.RB_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="Eprouv' + item.Id + '"><input type="checkbox" ' + item.Eprouv_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="NdHt' + item.Id + '"><input type="checkbox" ' + item.NdHt_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="Vis' + item.Id + '"><input type="checkbox" ' + item.Vis_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="Scop' + item.Id + '"><input type="checkbox" ' + item.Scop_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="Final' + item.Id + '"><input type="checkbox" ' + item.Final_t + '  onclick="return false;"></td>\n' +
                                    '                                <td id="Ddbft' + item.Id + '"><input type="checkbox" ' + item.DdbFt_t + '  onclick="return false;"></td>\n' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                defauts = [];
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
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#msForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#defauts').val('');
                $('#ntube').prop('disabled', false);
                defauts = [];
                initDefauts();
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.msDelete').each(function (e) {

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
                            url: "{{url('/M17/')}}/" + id,
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

                    $('#msForm').trigger("reset");
                    $('#Ajouter').html(' Ajouter ');
                    $('#annulerButton').hide();
                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                    $('#ntube').prop('disabled', false);
                    defauts = [];
                    initDefauts();
                });
                $('.msEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#ntube').val($("#tube" + id).html());
                        $('#LongCh').val($("#longChute" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"   checked      >');
                        else
                            $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"          >');


                        if ($('#Oxyc' + id).html().includes('checked')) {
                            $('#Oxyc').removeClass('btn-outline-secondary');
                            $('#Oxyc').addClass('btn-danger');
                            defauts['Oxyc'] = 1;
                        } else {
                            $('#Oxyc').addClass('btn-outline-secondary');
                            $('#Oxyc').removeClass('btn-danger');
                            defauts['Oxyc'] = 0;
                        }
                        if ($('#RB' + id).html().includes('checked')) {
                            $('#RB').removeClass('btn-outline-secondary');
                            $('#RB').addClass('btn-danger');
                            defauts['RB'] = 1;
                        } else {
                            $('#RB').addClass('btn-outline-secondary');
                            $('#RB').removeClass('btn-danger');
                            defauts['RB'] = 0;
                        }
                        if ($('#Eprouv' + id).html().includes('checked')) {
                            $('#Eprouv').removeClass('btn-outline-secondary');
                            $('#Eprouv').addClass('btn-danger');
                            defauts['Eprouv'] = 1;
                        } else {
                            $('#Eprouv').addClass('btn-outline-secondary');
                            $('#Eprouv').removeClass('btn-danger');
                            defauts['Eprouv'] = 0;
                        }
                        if ($('#NdHt' + id).html().includes('checked')) {
                            $('#NdHt').removeClass('btn-outline-secondary');
                            $('#NdHt').addClass('btn-danger');
                            defauts['NdHt'] = 1;
                        } else {
                            $('#NdHt').addClass('btn-outline-secondary');
                            $('#NdHt').removeClass('btn-danger');
                            defauts['NdHt'] = 0;
                        }

                        if ($('#Vis' + id).html().includes('checked')) {
                            $('#Vis').removeClass('btn-outline-secondary');
                            $('#Vis').addClass('btn-danger');
                            defauts['Vis'] = 1;
                        } else {
                            $('#Vis').addClass('btn-outline-secondary');
                            $('#Vis').removeClass('btn-danger');
                            defauts['Vis'] = 0;
                        }
                        if ($('#Scop' + id).html().includes('checked')) {
                            $('#Scop').removeClass('btn-outline-secondary');
                            $('#Scop').addClass('btn-danger');
                            defauts['Scop'] = 1;
                        } else {
                            $('#Scop').addClass('btn-outline-secondary');
                            $('#Scop').removeClass('btn-danger');
                            defauts['Scop'] = 0;
                        }
                        if ($('#Final' + id).html().includes('checked')) {
                            $('#Final').removeClass('btn-outline-secondary');
                            $('#Final').addClass('btn-danger');
                            defauts['Final'] = 1;
                        } else {
                            $('#Final').addClass('btn-outline-secondary');
                            $('#Final').removeClass('btn-danger');
                            defauts['Final'] = 0;
                        }
                        if ($('#Ddbft' + id).html().includes('checked')) {
                            $('#DdbFt').removeClass('btn-outline-secondary');
                            $('#DdbFt').addClass('btn-danger');
                            defauts['DdbFt'] = 1;
                        } else {
                            $('#DdbFt').addClass('btn-outline-secondary');
                            $('#DdbFt').removeClass('btn-danger');
                            defauts['DdbFt'] = 0;
                        }

                        $('#Ajouter').html(' Modifier ');
                        $('#annulerButton').show();
                        $('#ntube').prop('disabled', true);
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
                            window.location.href = '{{route("rapports_RX1.index")}}';

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
