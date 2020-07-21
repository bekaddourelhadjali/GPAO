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
            <div class=" col-12  ">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="msForm" autocomplete="off">
                        <input name="Numero" type="hidden" id="Numero" value="">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                <div class="form-group ">
                                    <label class="col-lg-12" style="padding-left: 0">Tube</label>
                                    <input class="form-control col-12 text-center" style="color:#00f" id="ntube"
                                           name="ntube"
                                           required list="tubes">
                                    <datalist id="tubes">
                                        <option disabled selected></option>
                                        @if(isset($tubes))
                                        @foreach($tubes as $tube)
                                            @if($tube->Bis)
                                                <option value="{{$tube->Tube}}bis"  coulee="{{$tube->Coulee}}" >{{$tube->Tube}}bis</option>
                                            @else
                                                <option value="{{$tube->Tube}}" coulee="{{$tube->Coulee}}" >{{$tube->Tube}}</option>
                                                &nbsp; @endif
                                        @endforeach
                                            @endif
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Coulee" style="padding-left: 0">Coulee</label>
                                    <input class="form-control col-12" type="number" id="Coulee" name="Coulee"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Longueur" style="padding-left: 0">Longueur</label>
                                    <input class="form-control col-12" type="number" id="Longueur" name="Longueur"
                                           min="5000" max="20000"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Poids" style="padding-left: 0">Poids</label>
                                    <input class="form-control col-12" type="number" id="Poids" name="Poids"
                                           >
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="NumExpedition"
                                           style="padding-left: 0">NumExpedition</label>
                                    <input class="form-control col-12" type="number" id="NumExpedition"
                                           name="NumExpedition" min="1" value="{{$maxNumExp}}"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="NumBon"
                                           style="padding-left: 0">N°Bon</label>
                                    <input class="form-control col-12" type="number" id="NumBon"
                                           name="NumBon" min="1"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="DateExpedition"
                                           style="padding-left: 0">Date Expedition</label>
                                    <input class="form-control col-12" type="date" id="DateExpedition"
                                           name="DateExpedition" value="{{date('Y-m-d')}}"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Site"
                                           style="padding-left: 0">Site</label>
                                    <input class="form-control col-12" type="text" id="Site"
                                           name="Site"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-sm-4 col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Transporteur"
                                           style="padding-left: 0">Transporteur</label>
                                    <input class="form-control col-12" type="text" id="Transporteur"
                                           name="Transporteur"
                                           required>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-9 col-12 ">
                                <label for="observation" class="col-12">Observation</label>
                                <input type="text" class="form-control" name="observation" id="observation">
                            </div>

                            <div class="offset-md-0 offset-md-8 col-md-2 col-6"><label class="col-12"></label>
                                <button style="margin-right: 10px;" type="reset"
                                        class=" col-12  btn btn-outline-secondary " id="annulerButton">Annuler
                                </button>
                            </div>
                            <div class="col-md-2 col-6"><label class="col-12"></label>
                                <button style="margin-right: 10px;" type="submit" class="col-12   btn btn-success"
                                        id="Ajouter">Ajouter
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div class=" col-sm-12">
                <section>

                    <div class="table-container">
                        <table id="rx1sTable" class="table table-striped table-hover table-borderless rapprods ">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Tube</th>
                                <th>Bis</th>
                                <th>Coulee</th>
                                <th>Longueur</th>
                                <th>Poids</th>
                                <th>N°Expedition</th>
                                <th>N°Bon</th>
                                <th>Date Expédition</th>
                                <th>Site</th>
                                <th>Transporteur</th>
                                <th>Observation</th>
                            </tr>
                            </thead>
                            <tbody id="ms">
                            @if(isset($Expeditions))
                                @foreach($Expeditions as $item)
                                    <tr id="ms{{$item->Id}}">
                                        <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                        <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
                                        <td id="Coulee{{$item->Id}}">{{$item->Coulee}}</td>
                                        <td id="Longueur{{$item->Id}}">{{$item->Longueur}}</td>
                                        <td id="Poids{{$item->Id}}">{{$item->Poids}}</td>
                                        <td id="NumExpedition{{$item->Id}}">{{$item->NumExpedition}}</td>
                                        <td id="NumBon{{$item->Id}}">{{$item->NumBon}}</td>
                                        <td id="DateExpedition{{$item->Id}}">{{$item->DateExpedition}}</td>
                                        <td id="Site{{$item->Id}}">{{$item->Site}}</td>
                                        <td id="Transporteur{{$item->Id}}">{{$item->Transporteur}}</td>
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
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">
                        <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b></button>
                </div>

                <div class=" col-lg-3 col-md-3 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class="  col-lg-3 col-md-3 col-sm-6">
                    <form method="post" action="{{route('rapports_Expedition.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter
                                le Rapport</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-3 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp; Clôturer le Rapport</b>
                    </button>
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

            $('#Ajouter').click(function (e) {
                e.preventDefault();
                if ($('#msForm')[0].checkValidity() ) {
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#Ajouter').html() !== ' Modifier ') {
                        if($('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined){
                        $.ajax({
                            url: "{{ route('Expedition.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val(),
                                Coulee: $('#Coulee').val(),
                                Longueur: $('#Longueur').val(),
                                Poids: $('#Poids').val(),
                                NumBon: $('#NumBon').val(),
                                DateExpedition: $('#DateExpedition').val(),
                                NumExpedition: $('#NumExpedition').val(),
                                Site: $('#Site').val(),
                                Transporteur: $('#Transporteur').val(),

                            },
                            success: function (result) {
                                var item = result.exp;
                                $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td     id="Coulee' + item.Id + '">' + $('#Coulee').val() + '</td>\n' +
                                    '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                    '                                <td     id="Poids' + item.Id + '">' + item.Poids + '</td>\n' +
                                    '                                <td     id="NumExpedition' + item.Id + '">' + item.NumExpedition + '</td>\n' +
                                    '                                <td     id="NumBon' + item.Id + '">' + item.NumBon + '</td>\n' +
                                    '                                <td     id="DateExpedition' + item.Id + '">' + item.DateExpedition + '</td>\n' +
                                    '                                <td     id="Site' + item.Id + '">' + item.Site + '</td>\n' +
                                    '                                <td     id="Transporteur' + item.Id + '">' + item.Transporteur + '</td>\n' +
                                    '                                <td    id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');

                                $("#tubes option[value=" + $('#ntube').val() + "]").remove();
                                $('#msForm').trigger("reset");
                                $('#NumExpedition').val(parseInt(item.NumExpedition) + 1);
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                if(result.responseJSON.message.includes('expedition_numexpedition_did_unique')){
                                    alert('Changer le numero d"expedition svp!');
                                }else{
                                alert(result.responseJSON.message);
                                console.log(result);
                                }
                            }
                        });
                    } else {
                            if ($('#tubes option[value=' + $('#ntube').val() + ']').val() === undefined) {
                                alert("Sélectionner le tube qui existe dans la liste svp!");
                                $('#ntube').val('');
                            }
                        }
                    } else {
                        $.ajax({
                            url: "{{url('/Expedition/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: $('#ntube').val(),
                                Observation: $('#observation').val(),
                                Longueur: $('#Longueur').val(),
                                Poids: $('#Poids').val(),
                                NumBon: $('#NumBon').val(),
                                DateExpedition: $('#DateExpedition').val(),
                                NumExpedition: $('#NumExpedition').val(),
                                Site: $('#Site').val(),
                                Transporteur: $('#Transporteur').val(),
                                id: id
                            },
                            success: function (result) {
                                var item = result.exp;
                                $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                    '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                    '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                    '                                <td     id="Coulee' + item.Id + '">' + $('#Coulee').val() + '</td>\n' +
                                    '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                    '                                <td     id="Poids' + item.Id + '">' + item.Poids + '</td>\n' +
                                    '                                <td     id="NumExpedition' + item.Id + '">' + item.NumExpedition + '</td>\n' +
                                    '                                <td     id="NumBon' + item.Id + '">' + item.NumBon + '</td>\n' +
                                    '                                <td     id="DateExpedition' + item.Id + '">' + item.DateExpedition + '</td>\n' +
                                    '                                <td     id="Site' + item.Id + '">' + item.Site + '</td>\n' +
                                    '                                <td     id="Transporteur' + item.Id + '">' + item.Transporteur + '</td>\n' +
                                    '                                <td    id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
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
                            },
                            error: function (result) {
                                if(result.responseJSON.message.includes('reception_numexpedition_did_unique')){
                                alert('Changer le numero de reception svp!');
                            }else{
                                alert(result.responseJSON.message);
                                console.log(result);
                                }
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
                $('#ntube').prop('disabled', false);
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.msDelete').each(function (e) {

                    $(this).off('click');
                    $(this).click(function (e) {
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        Coulee= $("#Coulee" + id).html();
                        ntube=$('#tube' + id).html();
                        bis=$('#bis' + id).html().includes('checked');

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/Expedition/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,
                            },
                            success: function (result) {
                                tr.remove();
                                if (bis)
                                    $('#tubes').append('<option value="'+ntube+'bis" coulee="'+Coulee+'">'+ntube+'bis</option>');
                                else
                                    $('#tubes').append('<option value="'+ntube+'" coulee="'+Coulee+'">'+ntube+'</option>');
                                $('#msForm').trigger("reset");
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
                $('.msEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#Longueur').val($("#Longueur" + id).html());
                        $('#Poids').val($("#Poids" + id).html());
                        $('#NumExpedition').val($("#NumExpedition" + id).html());
                        $('#Coulee').val($("#Coulee" + id).html());
                        $('#NumBon').val($("#NumBon" + id).html());
                        $('#DateExpedition').val($("#DateExpedition" + id).html());
                        $('#Site').val($("#Site" + id).html());
                        $('#Transporteur').val($("#Transporteur" + id).html());
                        $('#observation').val($("#Observation" + id).html());
                        if ($('#bis' + id).html().includes('checked'))
                            $('#ntube').val($("#tube" + id).html() + "bis");
                        else
                            $('#ntube').val($("#tube" + id).html());
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
                            window.location.href = '{{route("rapports_Expedition.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });
            $('#ntube').change(function () {
                    if($('#ntube').val()){
                if ($('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    $('#Coulee').val($('#tubes option[value=' + $('#ntube').val() + ']').attr('coulee'));
                } else {
                    $('#ntube').val('');
                    $('#Coulee').val('');

                }}else{
                        $('#ntube').val('');
                        $('#Coulee').val('');
                    }
            });
        });


    </script>
    @include('layouts.ArretScript')
    @include('layouts.CarteTubeScript')
@endsection
