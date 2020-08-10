@extends('layouts.app')

@section('style')

    <title>Rapport De Revêtement Extérieur</title>
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
                            <div class=" col-6">
                                <div class="form-group ">
                                    <label class="col-lg-12" style="padding-left: 0">Tube</label>
                                    <input class="form-control col-12 text-center" style="color:#00f" id="ntube"
                                           name="ntube"
                                           required list="tubes">
                                    <datalist id="tubes">
                                        <option disabled selected></option>
                                        @foreach($tubes as $tube)
                                            @if($tube->Bis)
                                                <option value="{{$tube->Tube}}bis"
                                                        NumReception="{{$tube->NumReception}}">{{$tube->Tube}}bis
                                                </option>
                                            @else
                                                <option value="{{$tube->Tube}}"
                                                        NumReception="{{$tube->NumReception}}"> {{$tube->Tube}}  </option>
                                                &nbsp; @endif
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class=" col-6">
                                <div class="form-group ">
                                    <label class="col-lg-12" style="padding-left: 0">NumReception</label>
                                    <input class="form-control col-12 text-center" style="color:#00f" id="NumReception"
                                           name="NumReception"
                                           required list="numreceptions">
                                    <datalist id="numreceptions">
                                        <option disabled selected></option>
                                        @foreach($tubes as $tube)
                                            @if($tube->Bis)
                                                <option value="{{$tube->NumReception}}"
                                                        Tube="{{$tube->Tube}}bis">{{$tube->NumReception}}</option>
                                            @else
                                                <option value="{{$tube->NumReception}}"
                                                        Tube="{{$tube->Tube}}"> {{$tube->NumReception}}  </option>
                                                &nbsp; @endif
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="  col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Longueur" style="padding-left: 0">Longueur</label>
                                    <input class="form-control col-12" type="number" id="Longueur" name="Longueur"
                                           min="5000" max="20000" required>
                                </div>
                            </div>
                            <div class="  col-6">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Aspect" style="padding-left: 0">Aspect</label>
                                    <select class="form-control col-12" id="Aspect" name="Aspect"
                                            required>
                                        @if(isset($defauts))
                                            @foreach($defauts as $defaut)
                                                <option value="{{$defaut->Operation}}">{{$defaut->Operation}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group text-center">
                                    <span class="  col-5 btn btn-outline-secondary defs" id="Accepte">Accepté</span>
                                    <span class="  col-5 btn btn-outline-secondary defs" id="Refuse">Refusé</span>
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
                        <table id="rx1sTable" class="table table-striped table-hover table-borderless rapprods ">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Tube</th>
                                <th>Bis</th>
                                <th>NumReception</th>
                                <th>Longueur</th>
                                <th>Aspect</th>
                                <th>Accepté</th>
                                <th>Observation</th>
                            </tr>
                            </thead>
                            <tbody id="ms">
                            @if(isset($revExt))
                                @foreach($revExt as $item)
                                    <tr id="ms{{$item->Id}}">
                                        <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                        <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif
                                        </td>
                                        <td id="NumReception{{$item->Id}}">{{$item->NumReception}}</td>
                                        <td id="Longueur{{$item->Id}}">{{$item->Longueur}}</td>
                                        <td id="Aspect{{$item->Id}}">{{$item->Aspect}}</td>
                                        @if($item->Accepte)
                                            <td id="Accepte{{$item->Id}}">Oui</td>
                                        @else
                                            <td id="Accepte{{$item->Id}}">Non</td>
                                        @endif
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
                </div>
                <div class="  col-lg-3 col-md-3 col-sm-6">
                    <form method="post" action="{{route('rapports_RevExt.destroy',["id"=>$rapport->Numero])}}">
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

    @include('layouts.CarteTubeLayout')

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
                defauts["Accepte"] = false;
                defauts["Refuse"] = false;
                $("#Refuse").addClass('btn-outline-secondary');
                $("#Refuse").removeClass('btn-danger');
                $("#Accepte").addClass('btn-outline-secondary');
                $("#Accepte").removeClass('btn-success');

            }

            $('#Accepte').click(function () {
                defauts["Accepte"] = !defauts["Accepte"];
                defauts["Refuse"] = !defauts["Accepte"];
                $("#Accepte").toggleClass('btn-outline-secondary');
                $("#Accepte").toggleClass('btn-success');
                if (defauts["Refuse"]) {
                    $("#Refuse").removeClass('btn-outline-secondary');
                    $("#Refuse").addClass('btn-danger');
                } else {
                    $("#Refuse").addClass('btn-outline-secondary');
                    $("#Refuse").removeClass('btn-danger');
                }
            });
            $('#Refuse').click(function () {
                defauts["Refuse"] = !defauts["Refuse"];
                defauts["Accepte"] = !defauts["Refuse"];
                $("#Refuse").toggleClass('btn-outline-secondary');
                $("#Refuse").toggleClass('btn-danger');
                if (defauts["Accepte"]) {
                    $("#Accepte").removeClass('btn-outline-secondary');
                    $("#Accepte").addClass('btn-success');
                } else {
                    $("#Accepte").addClass('btn-outline-secondary');
                    $("#Accepte").removeClass('btn-success');

                }

            });

            $('#Ajouter').click(function (e) {
                if ($('#msForm')[0].checkValidity()) {
                    if (defauts["Accepte"] || defauts["Refuse"]) {
                        e.preventDefault();
                        const id = $('#Numero').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        if ($('#Ajouter').html() !== ' Modifier ') {
                            $.ajax({
                                url: "{{ route('RevExt.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumeroRap: $('#NumRap').val(),
                                    ntube: $('#ntube').val(),
                                    Observation: $('#observation').val(),
                                    NumReception: $('#NumReception').val(),
                                    Longueur: $('#Longueur').val(),
                                    Aspect: $('#Aspect').val(),
                                    Accepte: defauts['Accepte'],

                                },
                                success: function (result) {
                                    var item = result.revExt;
                                    Accepte = "";
                                    console.log(item.Accepte);
                                    if (item.Accepte==="true") {
                                        Accepte = "Oui";
                                        $("#tubes option[value="+$('#ntube').val()+"]").remove();
                                        $("#numreceptions option[value="+item.NumReception+"]").remove();
                                    } else {
                                        Accepte = "Non";
                                    }
                                    $('#ms').append('<tr id="ms' + item.Id + '">\n' +
                                        '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                        '                                <td     id="NumReception' + item.Id + '">' + item.NumReception + '</td>\n' +
                                        '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                        '                                <td     id="Aspect' + item.Id + '">' + item.Aspect + '</td>\n' +
                                        '                                <td     id="Accepte' + item.Id + '">' + Accepte + '</td>\n' +
                                        '                                <td   class="obsS" id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                        '                                <td>\n' +
                                        '                                    <button id="ms' + item.Id + 'Edit" class="msEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                                    <button id="ms' + item.Id + 'Delete" class="msDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                        '                                </td>\n' +
                                        '                            </tr>');

                                    $('#msForm').trigger("reset");
                                    addRapprodsListeners();
                                    defauts = [];
                                    initDefauts();
                                },
                                error: function (result) {

                                    alert(result.responseJSON.message);
                                    console.log(result);
                                }
                            });

                        } else {
                            $.ajax({
                                url: "{{url('/RevExt/')}}/" + id,
                                method: 'post',
                                data: {
                                    _method: 'put',
                                    _token: '{{csrf_token()}}',
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumeroRap: $('#NumRap').val(),
                                    ntube: $('#ntube').val(),
                                    Observation: $('#observation').val(),
                                    NumReception: $('#NumReception').val(),
                                    Longueur: $('#Longueur').val(),
                                    Aspect: $('#Aspect').val(),
                                    Accepte: defauts['Accepte'],
                                    id: id
                                },
                                success: function (result) {
                                    var item = result.revExt;
                                    Accepte = "";
                                    if (item.Accepte==="true") {
                                        Accepte = "Oui";
                                        $("#tubes option[value="+$('#ntube').val()+"]").remove();
                                        $("#numreceptions option[value="+item.NumReception+"]").remove();
                                    } else {
                                        Accepte = "Non";
                                        if( !$("#tubes option[value="+$('#ntube').val()+"]").val()){
                                            $("#tubes").append('<option value="'+$('#ntube').val()+'" NumReception="'+item.NumReception+'">'+$('#ntube').val()+'</option>');

                                        }
                                        if(!$("#numreceptions option[value="+item.NumReception+"]").val()){
                                            $("#numreceptions").append ('<option value="'+item.NumReception+'" Tube="'+$('#ntube').val()+'">'+item.NumReception+'</option>');

                                        }
                                    }
                                    $('#ms' + id).replaceWith('<tr id="ms' + item.Id + '">\n' +
                                        '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                        '                                <td     id="NumReception' + item.Id + '">' + item.NumReception + '</td>\n' +
                                        '                                <td     id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                        '                                <td     id="Aspect' + item.Id + '">' + item.Aspect + '</td>\n' +
                                        '                                <td     id="Accepte' + item.Id + '">' + Accepte + '</td>\n' +
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
                                    defauts = [];
                                    initDefauts();
                                },
                                error: function (result) { 
                                    alert(result.responseJSON.message);
                                    console.log(result);

                                }
                            });

                        }
                    } else {
                        alert("Sélectionner Accepté ou Refusé svp !");
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
                            url: "{{url('/RevExt/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,
                            },
                            success: function (result) {
                                if ($('#Accepte' + id).html() == "Oui"){
                                    numRec=$("#NumReception" + id).html();
                                    if ($('#bis' + id).html().includes('checked'))
                                        ntube=$("#tube" + id).html() + "bis";
                                    else
                                        ntube=$("#tube" + id).html();

                                    $("#tubes").append('<option value="'+ntube+'" NumReception="'+numRec+'">'+ntube+'</option>');
                                    $("#numreceptions").append ('<option value="'+numRec+'" Tube="'+ntube+'">'+numRec+'</option>');

                                }

                                tr.remove();
                                $('#msForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#ntube').prop('disabled', false);
                                defauts = [];
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
                        $('#Longueur').val($("#Longueur" + id).html());
                        $('#NumReception').val($("#NumReception" + id).html());
                        $('#Aspect').val($("#Aspect" + id).html());
                        if ($('#Accepte' + id).html() == "Oui") {
                            defauts["Accepte"] = true;
                            $("#Accepte").removeClass('btn-outline-secondary');
                            $("#Accepte").addClass('btn-success');
                            defauts["Refuse"] = !defauts["Accepte"];
                            $("#Refuse").addClass('btn-outline-secondary');
                            $("#Refuse").removeClass('btn-danger');

                        } else {
                            defauts["Accepte"] = false;
                            $("#Accepte").addClass('btn-outline-secondary');
                            $("#Accepte").removeClass('btn-success');
                            defauts["Refuse"] = !defauts["Accepte"];
                            $("#Refuse").removeClass('btn-outline-secondary');
                            $("#Refuse").addClass('btn-danger');
                        }
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
                            window.location.href = '{{route("rapports_RevExt.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });
            $('#ntube').change(function () {
                if ($(this).val() != "") {
                    if ($('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                        $('#NumReception').val($('#tubes option[value=' + $('#ntube').val() + ']').attr('NumReception'));
                    } else {
                        $('#ntube').val('');
                        $('#NumReception').val('');

                    }
                } else {
                    $('#ntube').val('');
                    $('#NumReception').val('');
                }
            });
            $('#NumReception').change(function () {
                if ($(this).val() != "") {
                    if ($('#numreceptions option[value=' + $('#NumReception').val() + ']').val() !== undefined) {
                        $('#ntube').val($('#numreceptions option[value=' + $('#NumReception').val() + ']').attr('Tube'));
                    } else {
                        $('#ntube').val('');
                        $('#NumReception').val('');

                    }
                } else {
                    $('#ntube').val('');
                    $('#NumReception').val('');
                }
            });
        });


    </script>
    @include('layouts.CarteTubeScript')
@endsection
