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

        .small-td {
            width: 8%
        }

        .medium-td {
            width: 12%
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

        td, th {
            padding: 2px;
            vertical-align: middle !important;
            text-align: center;
        }

        .table {
            min-width: 800px;
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }

        .table-container {
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
                <div class="col-6 col-sm-6  col-lg-2">
                    <div class="row">TENSION: &nbsp; <span class="valeur"> {{$rapport->Tension}}  </span></div>
                    <div class="row">INTENSITE: &nbsp; <span class="valeur">{{$rapport->Intensite}}  </span></div>
                </div>
                <div class="col-6 col-sm-6  col-lg-3">
                    <div class="row">TEMPS DE POSE: &nbsp; <span class="valeur"> {{$rapport->TmpPose}}  </span></div>
                    <div class="row">DISTANCE DU BRAS: &nbsp; <span class="valeur">{{$rapport->DisBras}}  </span></div>
                </div>

            </div>
        </section>
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 offset-md-2 offset-lg-0 col-sm-12 ">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="rx1Form">
                        <input name="Numero" type="hidden" id="Numero" value="">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <div class="row">
                            <div class=" col-lg-9 col-sm-12">
                                <div class="form-group ">
                                    <label class="col-lg-12" style="padding-left: 0">Detail Projet</label>
                                    <select class="form-control col-12" id="detail_project" name="detail_project">
                                        @foreach($details as $detail)
                                            <option value="{{$detail->Did}}">{{$detail->Nom}} -- Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" col-lg-2 col-sm-4 col-4">
                                <div class="form-group ">
                                    <label class="col-12" for="ntube" style="padding-left: 0">N°Tube</label>
                                    <input class=" col-12 form-control" pattern="[A-Z]\d{4}" type="text" id="ntube"
                                           pattern="[A-Z]\d{4}" name="ntube" value="" maxlength="5" minlength="5"
                                           required>
                                </div>
                            </div>
                            <div class=" col-1">
                                <div class="form-group ">
                                    <label class="col-12" for="bis" style="padding-left: 0">Bis</label>
                                    <input class=" col-12" type="checkbox" id="bis" name="bis">
                                </div>
                            </div>
                            <div class="form-group  col-8  ">
                                <label for="ObsTube" class="col-12">Observation</label>
                                <textarea type="text" class="form-control" name="ObsTube" id="ObsTube"></textarea>
                            </div>
                            <div class="form-group col-2 ">
                                <label for="" class="col-12"></label>
                                <button type="reset" class="  btn btn-secondary" type="button" id="annulerRX1Button">
                                    Annuler
                                </button>
                            </div>
                            <div class="form-group col-2  ">
                                <label for="" class="col-12"></label>
                                <button type="submit" class="    btn btn-success" type="button" id="Ajouter">Ajouter
                                </button>
                            </div>
                        </div>

                        <br>
                        <div class="row ">

                        </div>
                    </form>
                </section>
            </div>

            <div class="col-xl-7 col-lg-6 col-sm-12">
                <section class="top-actions">
                    <h5>Désignation des anomalies</h5>
                    <form id="Form">
                        <div class="row">
                            <div class=" col-sm-2">
                                <div class="form-group ">
                                    <label class="col-12" for="nbr">Nbr</label>
                                    <input class="  form-control" type="number" id="nbr" name="nbr">
                                </div>
                            </div>
                            <div class="   col-sm-4">
                                <div class="form-group ">
                                    <label class="col-12" for="defaut">Defaut</label>
                                    <select class="form-control" id="defaut" name="defaut">
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
                            <div class=" col-sm-2">
                                <div class="form-group ">
                                    <label class="col-12" for="valeur">Valeur</label>
                                    <input class=" form-control" type="number" id="valeur" name="valeur">
                                </div>
                            </div>
                            <div class=" col-sm-4">
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

                        </div>
                        <div class="row actions">
                            <div class=" col-xl-4 col-lg-6  col-sm-5">
                                <div class=" form-group bg-danger text-white text-center" style="padding: 5px 0 ; ">
                                    <label class="col-12  " for="defautRx">Defaut Signalé par RX </label>
                                    <input class=" " type="checkbox" id="defautRx" name="defautRx">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-6 col-sm-6 ">
                                <div class="form-group  ">
                                    <label class="col-12" for="observation">Observation</label>
                                    <input class=" form-control" type="text" id="observation" name="observation">
                                </div>
                            </div>
                            <div class="col-1"><label class="col-12" for=""> </label>
                                <button id="addDefaut" class="btn btn-success"><b><i class="fa fa-plus"></i></b>
                                </button>
                            </div>
                            <div class="col-1"><label class="col-12" for=""> </label>
                                <button id="removeDefaut" class="btn btn-danger"><b><i class="fa fa-minus "></i></b>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <input type="text" id="defauts" class=" form-control col-12" readonly>

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
                        <th>Defauts</th>
                        <th>Observation</th>

                    </tr>
                    </thead>
                    <tbody id="rxs">
                    @if(isset($rx1))
                        @foreach($rx1 as $item)
                            <tr id="rx{{$item->Id}}">
                                <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td class="obsS" id="Defaut{{$item->Id}}">{{$item->Defauts}}</td>
                                <td class="obsS" id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                <td>
                                    <button id="rx{{$item->Id}}Edit" class="rx1Edit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="rx{{$item->Id}}Delete" class="rx1Delete text-danger"><i
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
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal"                             data-target="#cardBackdrop">                         <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b>                     </button>
                </div>

                <div class="  col-lg-3  col-md-6 col-sm-12">
                    <form method="post" action="{{route('rapports_RX1.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter
                                le rapport</b></button>
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
    @include('layouts.CarteTubeLayout')

@endsection
@section('script')

    <script>

        $(document).ready(function () {
            rxdef = 0;
            Defauts = [];
            $('#annulerRX1Button').hide();
            addRapprodsListeners();

            $('#addDefaut').click(function (e) {
                e.preventDefault();
                if ($('#defaut').val() !== null && $('#operation').val() !== null) {
                    if ($('#operation').val() !== 'R.A.S') {
                        Opr = $('#operation').val();
                        IdDef = $('#defaut').find("option:selected").attr("defautId");
                        if ($('#defautRx:checked').length > 0) {
                            ++rxdef;
                            Defaut = 'U' + rxdef + '. ' + $('#defaut').val();
                        }
                        else {
                            Defaut = $('#defaut').val();
                        }

                        Valeur = $('#valeur').val();
                        NbOpr = $('#operation').find("option:selected").attr("operationId");
                        Nombre = $('#nbr').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        observation=$('#observation').val();
                        Defauts.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre,observation]);
                        SetDefauts();
                    } else {
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });

            $('#removeDefaut').click(function (e) {
                e.preventDefault();
                latDefaut = Defauts.pop();
                if (latDefaut[2].includes('. '))
                    --rxdef;
                if (Defauts.length > 0) {
                    SetDefauts();
                } else {
                    $('#defauts').val('');
                }
            });
            $('#Ajouter').click(function (e) {
                e.preventDefault();
                if ($('#rx1Form')[0].checkValidity()) {


                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    ntube = $('#ntube').val();
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
                                url: "{{ route('RX1.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    Did: $('#detail_project').val(),
                                    NumeroRap: $('#NumRap').val(),
                                    ntube: ntube,
                                    bis: $('#bis:checked').length > 0,
                                    Obs: obs,
                                    Observation: $('#ObsTube').val(),
                                    Defauts: Defauts,
                                },
                                success: function (result) {
                                    var bis = "";
                                    var item = result.rx1;
                                    if (item.Bis) {
                                        bis = "checked"
                                    }
                                    $('#rxs').append('<tr id="rx' + item.Id + '">\n' +
                                        '                         <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                         <td id="bis' + item.Id + '"> <input type="checkbox" ' + bis + '  onclick="return false;"> </td>\n' +
                                        '                         <td   class="obsS" id="Defaut' + item.Id + '">' + item.Defauts + '</td>\n' +
                                        '                         <td   class="obsS" id="Observation' + item.Id + '">' + $('#ObsTube').val() + '</td>\n' +
                                        '                         <td>\n' +
                                        '                             <button id="rx' + item.Id + 'Edit" class="rx1Edit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                             <button id="rx' + item.Id + 'Delete" class="rx1Delete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                        '                         </td>\n' +
                                        '                     </tr> ');
                                    $('#rx1Form').trigger("reset");
                                    $('#Form').trigger("reset");
                                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                    $('#Defauts').val('');
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
                                url: "{{url('/RX1/')}}/" + id,
                                method: 'post',
                                data: {
                                    _method: 'put',
                                    _token: '{{csrf_token()}}',
                                    ntube: ntube,
                                    bis: $('#bis:checked').length > 0,
                                    Obs: obs,
                                    Observation: $('#ObsTube').val(),
                                    Defauts: Defauts,
                                    id: id
                                },
                                success: function (result) {
                                    console.log(result.rx1);
                                    var bis = "";
                                    var item = result.rx1;
                                    if (item.Bis) {
                                        bis = "checked"
                                    }
                                    $('#rx' + id).replaceWith('<tr id="rx' + item.Id + '">\n' +
                                        '                         <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                         <td id="bis' + item.Id + '"> <input type="checkbox" ' + bis + '  onclick="return false;">\n' +
                                        '                         <td   class="obsS" id="Defaut' + item.Id + '">' + item.Defauts + '</td>\n' +
                                        '                         <td   class="obsS" id="Observation' + item.Id + '">' + $('#ObsTube').val() + '</td>\n' +
                                        '                         <td>\n' +
                                        '                             <button id="rx' + item.Id + 'Edit" class="rx1Edit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                             <button id="rx' + item.Id + 'Delete" class="rx1Delete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                        '                         </td>\n' +
                                        '                     </tr> ');
                                    $('#rx1Form').trigger("reset");
                                    $('#Ajouter').html(' Ajouter ');
                                    $('#annulerRX1Button').hide();
                                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                    $('#defauts').val('');
                                    $('#ntube').prop('disabled', false);
                                    Defauts = [];

                                    addRapprodsListeners();
                                    $('#ntube').prop('disabled', false);
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
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerRX1Button').click(function () {
                $('#rx1Form').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerRX1Button').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#defauts').val('');
                $('#ntube').prop('disabled', false);
                Defauts = [];
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.rx1Delete').each(function (e) {
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
                            url: "{{url('/RX1/')}}/" + id,
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

                    $('#rx1Form').trigger("reset");
                    $('#Ajouter').html(' Ajouter ');
                    $('#annulerRX1Button').hide();
                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                    $('#defauts').val('');
                    $('#ntube').prop('disabled', false);
                    Defauts = [];
                });
                $('.rx1Edit').each(function (e) {
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
                            url: "{{url('/RX1/')}}/" + id + '/edit',
                            method: 'get',
                            data: {
                                id: id,


                            },
                            success: function (result) {
                                $('#Numero').val(id);
                                rxdef = 0;
                                rx1 = result.rx1;
                                $('#detail_project').val(rx1.Did);
                                $('#ntube').val(rx1.Tube);
                                Defauts = [];
                                $('#ObsTube').val($('#Observation'+id).html());
                                rx1.defs.forEach(function (item, index) {
                                    if (item.Defaut.includes('. ')) ++rxdef;
                                    Defauts.push([item.Opr, item.IdDef, item.Defaut, item.Valeur, item.NbOpr, item.Nombre,item.Observation]);
                                });
                                if (rx1.Bis)
                                    $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"   checked      >');
                                else {
                                    $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"          >');
                                }
                                SetDefauts();
                                $('#operation').val(Defauts[Defauts.length - 1][0]);
                                $('#defaut').val(Defauts[Defauts.length - 1][2]);
                                $('#observation').val(Defauts[Defauts.length - 1][8]);
                                $('#Ajouter').html(' Modifier ');
                                $('#annulerRX1Button').show();
                                $('#ntube').prop('disabled', true);

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
                            window.location.href = '{{route("rapports_RX1.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
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
        });

    </script>
    @include('layouts.ArretScript');
    @include('layouts.CarteTubeScript');
@endsection
