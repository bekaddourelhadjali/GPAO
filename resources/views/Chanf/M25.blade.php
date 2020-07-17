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
        .defs {
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
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-8 offset-md-2 offset-lg-0 col-sm-12 ">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="msForm" autocomplete="off">
                        <input name="Numero" type="hidden" id="Numero" value="">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                        <div class="row">
                            <div class=" col-5">
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

                            <div class="col-7  ">
                                <div class="form-group text-center">
                                    <label class="col-12">Chanfreinage</label>
                                    <span class="  col-6 btn btn-outline-secondary defs" id="Debut">Debut</span>
                                    <span class="  col-5 btn btn-outline-secondary defs" id="Fin">Fin</span>
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
                            <th>Debut</th>
                            <th>Fin</th>
                            <th>Observation</th>
                        </tr>
                        </thead>
                            <tbody id="ms">
                            @if(isset($m25))
                                @foreach($m25 as $item)
                                    <tr id="ms{{$item->Id}}">
                                        <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                        <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
                                        <td id="Debut{{$item->Id}}">@if($item->Debut) <input type="checkbox" checked
                                                                                                                                           onclick="return false;">
                                            @elseif(!$item->Debut)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
                                        <td id="Fin{{$item->Id}}">@if($item->Fin) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->Fin)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
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
                <div class=" col-lg-3 col-md-3 col-sm-6">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal"                             data-target="#cardBackdrop">                         <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b>                     </button>
                </div>

                <div class=" col-lg-3 col-md-3 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class="  col-lg-3 col-md-3 col-sm-6">
                    <form method="post" action="{{route('rapports_M25.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le Rapport</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-3 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Clôturer le Rapport</b>
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
            var defauts = [];
            initDefauts();
            function initDefauts() {
                defauts["Debut"] = false;
                defauts["Fin"] = false;
                $('.defs').each(function () {
                    $(this).addClass('btn-outline-secondary');
                    $(this).removeClass('btn-danger');
                });

            }
            $('.defs').each(function () {
                $(this).click(function(){
                    defauts[$(this).attr("id")] = !defauts[$(this).attr("id")];
                    $(this).toggleClass('btn-outline-secondary');
                    $(this).toggleClass('btn-danger');
                })

            });
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#Ajouter').click(function (e) {
                e.preventDefault();
                if ($('#msForm')[0].checkValidity()&& $('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    if(defauts["Debut"]||defauts["Fin"]){
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#Ajouter').html() !== ' Modifier ') {
                        $.ajax({
                            url: "{{ route('M25.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val(),
                                Debut:defauts["Debut"],
                                Fin:defauts["Fin"],

                            },
                            success: function (result) {
                                var item = result.m25;
                                $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                 <td id="Debut' + item.Id + '"> <input type="checkbox" ' + item.Debut_t + '  onclick="return false;"></td>' +
                                    '                                 <td id="Fin' + item.Id + '"> <input type="checkbox" ' + item.Fin_t + '  onclick="return false;"></td>' +
                                    '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#msForm').trigger("reset");
                                addRapprodsListeners();
                                defauts=[];
                                initDefauts();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });

                    } else {
                        $.ajax({
                            url: "{{url('/M25/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val(),
                                Debut:defauts["Debut"],
                                Fin:defauts["Fin"],
                                id: id
                            },
                            success: function (result) {
                                var item = result.m25;
                                $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                 <td id="Debut' + item.Id + '"> <input type="checkbox" ' + item.Debut_t + '  onclick="return false;"></td>' +
                                    '                                 <td id="Fin' + item.Id + '"> <input type="checkbox" ' + item.Fin_t + '  onclick="return false;"></td>' +
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
                                addRapprodsListeners();
                                defauts=[];
                                initDefauts();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });

                    }
                    }else{
                        alert("Choisir L'emplacement de chanfreinage Debut ou Fin ou les deux");
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
                $('#ntube').prop('disabled', false);
                defauts=[];
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
                            url: "{{url('/M25/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,
                            },
                            success: function (result) {
                                tr.remove();
                                $('#msForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#ntube').prop('disabled', false);
                                defauts=[];
                                initDefauts();
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });


                });
                $('.msEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#Pression').val($("#Pression" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#ntube').val($("#tube" + id).html() + "bis");
                        else
                            $('#ntube').val($("#tube" + id).html());
                        $('#Ajouter').html(' Modifier ');
                        $('#annulerButton').show();
                        $('#ntube').prop('disabled', true);
                        if ($('#Debut' + id).html().includes('checked')) {
                            $('#Debut').removeClass('btn-outline-secondary');
                            $('#Debut').addClass('btn-danger');
                            defauts['Debut'] = true;
                        } else {
                            $('#Debut').addClass('btn-outline-secondary');
                            $('#Debut').removeClass('btn-danger');
                            defauts['Debut'] = false;
                        }
                        if ($('#Fin' + id).html().includes('checked')) {
                            $('#Fin').removeClass('btn-outline-secondary');
                            $('#Fin').addClass('btn-danger');
                            defauts['Fin'] = true;
                        } else {
                            $('#Fin').addClass('btn-outline-secondary');
                            $('#Fin').removeClass('btn-danger');
                            defauts['Fin'] = false;
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
                            window.location.href = '{{route("rapports_M25.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });

        });


    </script>
    @include('layouts.ArretScript');
    @include('layouts.CarteTubeScript');
@endsection
