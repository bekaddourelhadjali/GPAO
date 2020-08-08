@extends('layouts.app')

@section('style')

    <title>Rapport De Chutage</title>
      <style>
        div.item {
            background-color: #fe4c50 !important;
            color: #fff !important;
            font-weight: bold;
            border-radius: 5px;
        }

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
        <div class="row">
            <div  class="col-12 col-md-10 col-lg-4 offset-lg-0  offset-md-1">
            <section id="head-section" >
                <div class="row text-center" style="padding-left: 10px">
                    <h5>Info Rapport</h5>
                    <div class="col-12 ">
                        <div class="row">Détail de Projet: &nbsp; <span class="valeur">{{$detailP->Nom}}
                                : Epaisseur : {{$detailP->Epaisseur}} mm -- Diametre : {{$detailP->Diametre}} mm</span>
                        </div>

                        <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                    </div>
                    <div class="col-6  ">
                        <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                        <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                    </div>
                    <div class="col-6 ">
                        <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                                / {{$rapport->CodeAgent}}</span></div>
                        <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    </div>

                </div>
            </section>
            </div>
            <div  class="col-12 col-md-10 col-lg-8 offset-lg-0  offset-md-1">
            <section class="top-actions">
                <h5>Info Tube</h5>
                <form id="msForm" autocomplete="off">
                    <input name="Numero" type="hidden" id="Numero" value="">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-6">
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
                        <div class="  col-md-3 col-6">
                            <div class="form-group text-center">
                                <label class="col-12" for="LongCh" style="padding-left: 0">Long Chute</label>
                                <input class="form-control col-12" type="number" id="LongCh" name="LongCh" required>
                            </div>
                        </div>
                        <div class="  col-lg-7 col-md-7 col-12 ">
                            <div class="form-group text-center">
                                <label class="col-12" for="Defauts" style="padding-left: 0">Defauts</label>
                                <select class="col-12" type="number" id="Defauts" name="Defauts" required>
                                    <option disabled selected></option>
                                    @if(isset($defauts))
                                        @foreach($defauts as $defaut)
                                            <option value="{{$defaut->Defaut}}">{{$defaut->Defaut}}</option>
                                        @endforeach
                                    @endif
                                    <option value="Autres">Autres</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-8  col-12  ">
                            <label for="observation" class="col-12">Observation</label>
                            <input type="text" class="form-control" name="observation" id="observation">
                        </div>
                        <div class="form-group col-md-2 col-6  ">
                            <label> </label>
                            <button type="reset"
                                    class=" mb-3 col-12 btn btn-outline-secondary " id="annulerButton">Annuler
                            </button>
                        </div>
                        <div class="form-group col-md-2  col-6  ">
                            <label> </label>
                            <button type="submit" class=" mb-3 col-12   btn btn-success"
                                    id="Ajouter">Ajouter
                            </button>
                        </div>


                    </div>
                </form>

            </section>
            </div>
        </div>
        <section class="col-12">
            <div class="table-container">
                <table id="rx1sTable" class="table table-striped table-hover table-borderless rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>Long Chute</th>
                        <th>Defauts</th>
                        <th>Observation</th>
                        <th></th>
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
                                <td id="longChute{{$item->Id}}">{{$item->LongCh}}</td>
                                <td class="obsS" id="Defauts{{$item->Id}}">{{$item->Defauts}}</td>
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
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">
                        <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b></button>
                </div>
                <div class="  col-lg-3 col-md-4 col-sm-6">
                    <form method="post" action="{{route('rapports_M17.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter
                                le rapport</b></button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-6">
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

    @include('layouts.ArretScript')
    @include('layouts.CarteTubeScript')
    <script>

        $(document).ready(function () {


            var $select = $('#Defauts').selectize({maxItems: 100});
            var selectize = $select[0].selectize;
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#Ajouter').click(function (e) {
                if ($('#msForm')[0].checkValidity() && $('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {

                    e.preventDefault();
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
                                Observation: $('#observation').val(),
                                LongCh: $('#LongCh').val(),
                                Defauts: $('#Defauts').val(),
                            },
                            success: function (result) {
                                var item = result.m17;
                                $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td     id="longChute' + item.Id + '">' + item.LongCh + '</td>\n' +
                                    '                                <td   class="obsS" id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                selectize.setValue('');
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
                                Observation: $('#observation').val(),
                                Defauts: $('#Defauts').val(),
                                LongCh: $('#LongCh').val(),
                                id: id
                            },
                            success: function (result) {
                                var item = result.m17;
                                $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td     id="longChute' + item.Id + '">' + item.LongCh + '</td>\n' +
                                    '                                <td   class="obsS" id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#ntube').prop('disabled', false);
                                selectize.setValue('');
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });

                    }
                } else {
                    if ($('#tubes option[value=' + $('#ntube').val() + ']').val() === undefined) {
                        alert("Sélectionner le tube qui existe dans la liste svp!");
                        $('#ntube').val('');
                    } else
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

                selectize.setValue('');
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
                    selectize.setValue('');
                });
                $('.msEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#LongCh').val($("#longChute" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#ntube').val($("#tube" + id).html() + "bis");
                        else
                            $('#ntube').val($("#tube" + id).html());
                        selectize.setValue($("#Defauts" + id).html().split(','));
                        console.log($("#Defauts" + id).html().split(','));
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
                            window.location.href = '{{route("rapports_M17.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });


        });


    </script>
@endsection
