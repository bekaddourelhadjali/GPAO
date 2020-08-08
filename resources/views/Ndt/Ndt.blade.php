@extends('layouts.app')

@section('style')
    <title>Rapport UT Automatique</title>
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

        /*input[type=number]::-webkit-inner-spin-button,*/
        /*input[type=number]::-webkit-outer-spin-button {*/
        /*-webkit-appearance: none;*/
        /*margin: 0;*/
        /*}*/

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
            <div class="row text-center" style="padding-left: 10px">
                <h5>Info Rapport</h5>
                <div class="col-md-6 col-12">
                    <div class="row">Détail de Projet: &nbsp; <span class="valeur">{{$detailP->Nom}}
                            : Epaisseur : {{$detailP->Epaisseur}} mm -- Diametre : {{$detailP->Diametre}} mm</span>
                    </div>

                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                            / {{$rapport->CodeAgent}}</span></div>
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                </div>

            </div>
        </section>
        <form class="row" id="ndtForm" autocomplete="off">
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-sm-12 ">

                <section class="top-actions">
                    <h5>Info Tube</h5>

                    <input name="Numero" type="hidden" id="Numero" value="">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                    <div class="row">
                        <div class=" col-6   col-sm-3 col-lg-2">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0">Tube</label>
                                <input class="form-control col-12 text-center" style="color:#00f" id="ntube"
                                       name="ntube"
                                       required list="tubes">
                                <datalist id="tubes">
                                    <option disabled selected></option>
                                    @foreach($tubes as $tube)
                                        @if($tube->Bis)
                                            <option value="{{$tube->Tube}}bis">{{$tube->Tube}}bis</option>
                                        @else
                                            <option value="{{$tube->Tube}}"> {{$tube->Tube}}  </option>
                                            &nbsp; @endif
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="  col-6   col-sm-4 col-md-3 col-lg-3 ">
                            <div class="form-group text-center ">
                                <label class="col-12 text-warning"
                                       style="padding-left: 0; margin-bottom:0; border-bottom:1px solid #000; ">SNUP</label>
                                <label class="col-12" for="Snup" style="padding-left: 0; ">N de K/Soudure</label>
                                <input class="form-control col-12" type="number" id="Snup" name="Snup"
                                       value="0" min="0" required>
                            </div>
                        </div>
                        <div class="  col-6 col-sm-4 col-md-3  col-lg-3">
                            <div class="form-group text-center">
                                <label class="col-12 text-warning"
                                       style="padding-left: 0; margin-bottom:0; border-bottom:1px solid #000;">O.P.R</label>
                                <label class="col-12" for="OPR" style="padding-left: 0">N de W/Métal</label>
                                <input class="form-control col-12" type="number" id="OPR" name="OPR" value="0"
                                       min="0" required>
                            </div>
                        </div>
                        <div class="  col-6 col-sm-4 col-md-3  col-lg-2">
                            <div class="form-group text-center">
                                <label class="col-12 text-warning"
                                       style="padding-left: 0; margin-bottom:0; border-bottom:1px solid #000;">REP.D</label>
                                <label class="col-12" for="Repd" style="padding-left: 0">N de W/D</label>
                                <input class="form-control col-12" type="number" id="Repd" name="Repd"
                                       value="0" min="0" required>
                            </div>
                        </div>
                        <div class="  col-6 col-sm-4 col-md-3  col-lg-2">
                            <div class="form-group text-center">
                                <label class="col-12 text-warning"
                                       style="padding-left: 0; margin-bottom:0; border-bottom:1px solid #000;">REP.G</label>
                                <label class="col-12" for="Repg" style="padding-left: 0">N de W/G</label>
                                <input class="form-control col-12" type="number" id="Repg" name="Repg"
                                       value="0" min="0" required>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-8  ">

                            <label for="observation" class="col-12">Observation</label>
                            <input type="text" class="form-control" name="observation" id="observation">
                        </div>
                        <div class="col-12 col-md-4">

                            <button style="margin:32px 10px 0 0;" type="reset"
                                    class=" col-5 btn btn-outline-secondary " id="annulerButton">Annuler
                            </button>
                            </button>
                            <button style="margin:32px 10px 0 0;" type="submit" class=" col-5 btn btn-success"
                                    id="Ajouter">Ajouter
                            </button>
                        </div>
                    </div>


                </section>

            </div>
        </form>
        <section class="col-12">
            <div class="table-container">
                <table id="rx1sTable" class="table table-striped table-hover table-borderless rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>SNUP</th>
                        <th>O.P.R</th>
                        <th>REP.D</th>
                        <th>REP.G</th>
                        <th>Observation</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="ndts">
                    @if(isset($ndts))
                        @foreach($ndts as $item)
                            <tr id="ndt{{$item->Id}}">
                                <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="Snup{{$item->Id}}">{{$item->Snup}}</td>
                                <td id="OPR{{$item->Id}}">{{$item->OPR}}</td>
                                <td id="Repd{{$item->Id}}">{{$item->Repd}}</td>
                                <td id="Repg{{$item->Id}}">{{$item->Repg}}</td>
                                <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                <td>
                                    <button id="ndt{{$item->Id}}Edit" class="ndtEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="ndt{{$item->Id}}Delete" class="ndtDelete text-danger"><i
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
                <div class=" col-md-3 col-sm-6">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">
                        <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b></button>
                </div>
                <div class=" col-md-3 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class="  col-md-3 col-sm-6 ">
                    <form method="post" action="{{route('rapports_Ndt.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter
                                le rapport</b></button>
                    </form>
                </div>
                <div class=" col-md-3 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer
                            Rapport</b></button>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->

    @include('layouts.ArretsLayout')
    @include('layouts.CarteTubeLayout')
@endsection
@section('script')

    <script>

        $(document).ready(function () {
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();


            //Ajouter Ndt
            $('#Ajouter').click(function (e) {
                if ($('#ndtForm')[0].checkValidity()&& $('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    e.preventDefault();

                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#Ajouter').html() !== ' Modifier ') {
                        $.ajax({
                            url: "{{ route('Ndt.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val() + "",
                                Snup: $('#Snup').val(),
                                OPR: $('#OPR').val(),
                                Repd: $('#Repd').val(),
                                Repg: $('#Repg').val(),
                            },
                            success: function (result) {
                                var item = result.ndt;
                                $('#ndts').append('<tr id="ndt' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="Snup' + item.Id + '">' + item.Snup + '</td>\n' +
                                    '                                <td    id="OPR' + item.Id + '">' + item.OPR + '</td>\n' +
                                    '                                <td    id="Repd' + item.Id + '">' + item.Repd + '</td>\n' +
                                    '                                <td    id="Repg' + item.Id + '">' + item.Repg + '</td>\n' +
                                    '                                <td     id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ndt' + item.Id + 'Edit" class="ndtEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ndt' + item.Id + 'Delete" class="ndtDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#ndtForm').trigger("reset");
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });

                    } else {
                        $.ajax({
                            url: "{{url('/Ndt/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val() + "",
                                Snup: $('#Snup').val(),
                                OPR: $('#OPR').val(),
                                Repd: $('#Repd').val(),
                                Repg: $('#Repg').val(),
                                id: id
                            },
                            success: function (result) {
                                var item = result.ndt;
                                console.log(item);
                                $('#ndt' + id).replaceWith('<tr id="ndt' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td    id="Snup' + item.Id + '">' + item.Snup + '</td>\n' +
                                    '                                <td    id="OPR' + item.Id + '">' + item.OPR + '</td>\n' +
                                    '                                <td    id="Repd' + item.Id + '">' + item.Repd + '</td>\n' +
                                    '                                <td    id="Repg' + item.Id + '">' + item.Repg + '</td>\n' +
                                    '                                <td     id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ndt' + item.Id + 'Edit" class="ndtEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ndt' + item.Id + 'Delete" class="ndtDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#ndtForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#ntube').prop('disabled', false);
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });

                    }


                } else {if ($('#tubes option[value=' + $('#ntube').val() + ']').val() === undefined) {
                    alert("Sélectionner le tube qui existe dans la liste svp!");
                    $('#ntube').val('');
                } else
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#ndtForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#ntube').prop('disabled', false);
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.ndtDelete').each(function (e) {

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
                            url: "{{url('/Ndt/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();

                                $('#ndtForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#ntube').prop('disabled', false);
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });
                });
                $('.ndtEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');

                        $('#Numero').val(id);
                        $('#ntube').prop('disabled', true);
                        $('#Snup').val($("#Snup" + id).html());
                        $('#OPR').val($("#OPR" + id).html());
                        $('#Repd').val($("#Repd" + id).html());
                        $('#Repg').val($("#Repg" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#ntube').val($("#tube" + id).html() + "bis");
                        else
                            $('#ntube').val($("#tube" + id).html());
                        $('#Ajouter').html(' Modifier ');
                        $('#annulerButton').show();
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
                            window.location.href = '{{route("rapports_Ndt.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });

        });


    </script>
    @include('layouts.ArretScript')
    @include('layouts.CarteTubeScript')
@endsection
