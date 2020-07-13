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
                                    <label class="col-12" for="Pression" style="padding-left: 0">Pression</label>
                                    <input class="form-control col-12" type="number" id="Pression" name="Pression"
                                           required>
                                </div>
                            </div>
                            <div class="form-group col-12  ">
                                <label for="observation" class="col-12">Observation</label>
                                <input type="text" class="form-control" name="observation" id="observation">
                            </div>
                            <button style="margin-right: 10px;" type="reset"
                                    class="   col-5 btn btn-outline-secondary " id="annulerButton">Annuler
                            </button>
                            <button style="margin-right: 10px;" type="submit" class="   col-6   btn btn-success"
                                    id="Ajouter">Ajouter
                            </button>

                        </div>
                    </form>
                </section>
            </div>

            <div class="col-xl-8 col-lg-7 col-sm-12">
                <section>

                    <div class="table-container">
                        <table id="rx1sTable" class="table table-striped table-hover table-bordered rapprods ">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Tube</th>
                                <th>Bis</th>
                                <th>opération</th>
                                <th>N°Opr</th>
                                <th>Pression</th>
                                <th>Observation</th>
                            </tr>
                            </thead>
                            <tbody id="ms">
                            @if(isset($m24))
                                @foreach($m24 as $item)
                                    <tr id="ms{{$item->Id}}">
                                        <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                        <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
                                        <td id="Operation{{$item->Id}}">{{$item->Operation}}</td>
                                        <td id="NbOpr{{$item->Id}}">{{$item->NbOpr}}</td>
                                        <td id="Pression{{$item->Id}}">{{$item->Pression}}</td>
                                        <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>
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

            </div>
        </div>
        <section>
            <div class="row" id="bottom-actions">
                <div class=" col-lg-2 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">                         <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b>                     </button>
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
                <div class="  col-lg-2 col-md-4 col-sm-6">
                    <form method="post" action="{{route('rapports_M24.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le Rapport</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-2 col-md-4 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp; Clôturer le Rapport</b>
                    </button>
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
                            url: "{{ route('M24.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                bis: $('#bis:checked').length > 0,
                                Observation: $('#observation').val(),
                                Pression: $('#Pression').val(),

                            },
                            success: function (result) {
                                var item = result.m24;
                                $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="operation' + item.Id + '">' + item.Operation + '</td>\n' +
                                    '                                <td    id="NbOpr' + item.Id + '">' + item.NbOpr + '</td>\n' +
                                    '                                <td     id="Pression' + item.Id + '">' + item.Pression + '</td>\n' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });

                    } else {
                        $.ajax({
                            url: "{{url('/M24/')}}/" + id,
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
                                Pression: $('#Pression').val(),
                                id: id
                            },
                            success: function (result) {
                                var item = result.m24;
                                $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="operation' + item.Id + '">' + item.Operation + '</td>\n' +
                                    '                                <td    id="NbOpr' + item.Id + '">' + item.NbOpr + '</td>\n' +
                                    '                                <td     id="Pression' + item.Id + '">' + item.Pression + '</td>\n' +
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
                $('#ntube').prop('disabled', false);
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
                            url: "{{url('/M24/')}}/" + id,
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
                });
                $('.msEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#ntube').val($("#tube" + id).html());
                        $('#Pression').val($("#Pression" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"   checked      >');
                        else
                            $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"          >');
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
                            window.location.href = '{{route("rapports_M24.index")}}';

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
