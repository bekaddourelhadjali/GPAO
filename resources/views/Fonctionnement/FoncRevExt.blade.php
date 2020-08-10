@extends('layouts.app')

@section('style')
    <title>Rapport De Fonctionnement PE</title>
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
        <section>
            <form id="arretForm" autocomplete="off">

                <input name="id" type="hidden" id="id" value="">
                <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="form-group row">
                            <label class="col-12" for="type_arret">Type D'arrêt</label>
                            <select class="form-control col-10" id="type_arret" name="type_arret" required>
                                <option value="Arret" selected>Arret</option>
                                <option value="Panne">Panne</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8 col-6">
                        <div class="form-group row">
                            <label class="col-12" for="cause">Cause</label>
                            <select class="form-control col-12" id="cause" name="cause" required>
                                @if(isset($defauts))
                                    @foreach($defauts as $defaut)
                                        <option value="{{$defaut->Defaut}}">{{$defaut->Defaut}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-8">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group  ">
                                    <label class="col-12" for="du">Du</label>
                                    <input class="col-12 form-control" type="time" id="du" name="du" value="00:00"
                                           required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group  ">
                                    <label class="col-12" for="au">Au</label>
                                    <input class="col-12 form-control" type="time" id="au" name="au" value="00:00"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-2 col-4">
                        <div class="form-group row">
                            <label class="col-12" for="duree">Durée(m)</label>
                            <input class="col-10 form-control" type="number" id="duree" name="duree" min="1" value=""
                                   required>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-4">
                        <div class="form-group row">
                            <label class="col-12" for="ndi">N°DI</label>
                            <input class="col-10 form-control" type="number" id="ndi" name="ndi" value="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-8">
                        <div class="form-group row">
                            <label class="col-12" for="obs">Obs</label>
                            <input class="col-11 form-control" type="text" id="obs" name="obs" value="">
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-2 col-5 " id="annulerButtson">
                        <div class="col-12">
                            <label class="col-12"> &nbsp;</label>
                            <button type="reset" class="btn btn-secondary"> Annuler</button>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-7">
                        <div class="col-10"><label class="col-12"> &nbsp;</label>
                        </div>
                        <button class="col-10 btn btn-success offset-2" type="button" type="submit" id="ajouterPanne">
                            Ajouter panne
                        </button>
                    </div>
                </div>


            </form>
            <hr>
            <div class="table-container">
                <table class="table table-striped table-hover table-borderless" id="ArretTable">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Type Arret</th>
                        <th>Du</th>
                        <th>Au</th>
                        <th>Duree</th>
                        <th>Cause</th>
                        <th>N°DI</th>
                        <th>Obs</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($arrets))
                        @foreach($arrets as $arret)
                            <tr id="arret{{$arret->id}}">
                                <td id="type{{$arret->id}}">{{$arret->TypeArret}}</td>
                                <td id="du{{$arret->id}}">{{$arret->Du}}</td>
                                <td id="au{{$arret->id}}">{{$arret->Au}}</td>
                                <td id="duree{{$arret->id}}">{{$arret->Durée}}</td>
                                <td id="cause{{$arret->id}}">{{$arret->Cause}}</td>
                                <td id="ndi{{$arret->id}}"> {{$arret->NDI}}</td>
                                <td id="obs{{$arret->id}}">{{$arret->Obs}}</td>
                                <td>
                                    <button id="arret{{$arret->id}}Edit" class="arretEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="arret{{$arret->id}}Delete" class="arretDelete text-danger"><i
                                                class="fa fa-trash"></i></button>
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
            <div class="row" id="bottom-actions">
                <div class=" col-lg-3 col-md-3 col-sm-6">
                </div>

                <div class=" col-lg-3 col-md-3 col-sm-6">
                </div>
                <div class="  col-lg-3 col-md-3 col-sm-6">
                    <form method="post" action="{{route('rapports_FoncRevExt.destroy',["id"=>$rapport->Numero])}}">
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

@endsection
@section('script')

    <script>

        $(document).ready(function () {

            $('#annulerPanne').hide();
                addArretsListeners();
                $('#annulerPanne').click(function () {
                    $('#ajouterPanne').html(' Ajouter ');
                    $('#annulerPanne').hide();
                    $('#arretForm').trigger("reset");
                });

                function addArretsListeners() {
                    $('.arretDelete').each(function (e) {
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
                                url: "{{url('/arret_machine/')}}/" + id,
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    id: id,
                                    _method: 'delete'

                                },
                                success: function (result) {
                                    tr.remove();
                                    $('#ajouterPanne').html(' Ajouter ');
                                    $('#annulerPanne').hide();
                                    $('#arretForm').trigger("reset");
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                }
                            });
                        });
                    });
                    $('.arretEdit').each(function (e) {
                        $(this).off('click');
                        $(this).click(function (e) {
                            e.preventDefault();
                            tr = $(this).parent().parent();
                            const id = $(this).attr("id").replace(/[^0-9]/g, '');
                            $('#cause').val(tr.find('#cause' + id).html());
                            $('#type_arret').val(tr.find('#type' + id).html());
                            $('#du').val(tr.find('#du' + id).html());
                            $('#au').val(tr.find('#au' + id).html());
                            $('#duree').val(tr.find('#duree' + id).html());
                            $('#ndi').val(tr.find('#ndi' + id).html());
                            $('#obs').val(tr.find('#obs' + id).html());
                            $('#relv').val(tr.find('#relv' + id).html());
                            $('#id').val(id);
                            $('#ajouterPanne').html(' Modifier panne ');
                            $('#annulerPanne').show();

                        });
                    });
                }
                $('#ajouterPanne').click(function (e) {
                    if ($('#arretForm')[0].checkValidity()) {
                        const id = $('#id').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        e.preventDefault();
                        if ($('#ajouterPanne').html() !== ' Modifier panne ') {

                            $.ajax({
                                url: "{{ route('arret_machine.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    Machine: $('#Machine').val(),
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumRap: $('#NumRap').val(),
                                    type_arret: $('#type_arret').val(),
                                    du: $('#du').val(),
                                    au: $('#au').val(),
                                    duree: $('#duree').val(),
                                    cause: $('#cause').val(),
                                    ndi: $('#ndi').val(),
                                    obs: $('#obs').val(),
                                },
                                success: function (result) {


                                    $('#ArretTable').append('<tr id="arret' + result.arret.id + '">' +
                                        '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                        '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                        '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                        '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                        '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                        '<td id="ndi' + result.arret.id + '">' + $('#ndi').val() + '</td>' +
                                        '<td id="obs' + result.arret.id + '">' + $('#obs').val() + '</td>' +
                                        '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                        '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td></tr>');

                                    $('#arretForm').trigger("reset");
                                    addArretsListeners();
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                }
                            });
                        } else {
                            $.ajax({
                                url: "{{url('/arret_machine/')}}/" + id,
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    id: id,
                                    _method: 'put',
                                    Machine: $('#Machine').val(),
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumRap: $('#NumRap').val(),
                                    type_arret: $('#type_arret').val(),
                                    du: $('#du').val(),
                                    au: $('#au').val(),
                                    duree: $('#duree').val(),
                                    cause: $('#cause').val(),
                                    ndi: $('#ndi').val(),
                                    obs: $('#obs').val(),
                                },
                                success: function (result) {

                                    $('#ArretTable').find('#arret' + result.arret.id).html(
                                        '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                        '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                        '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                        '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                        '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                        '<td id="ndi' + result.arret.id + '">' + $('#ndi').val() + '</td>' +
                                        '<td id="obs' + result.arret.id + '">' + $('#obs').val() + '</td>' +
                                        '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                        '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td>');
                                    $('#ajouterPanne').html(' Ajouter panne ');
                                    $('#annulerPanne').hide();
                                    $('#arretForm').trigger("reset");
                                    addArretsListeners();
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                }
                            });


                        }
                    } else {
                        alert('Remplir tous les champs qui sont obligatoires svp!');
                    }
                });
                $("#au , #du").change(function (event) {


                    if ($("#du").val() != "" && $("#au").val() != "") {
                        var du = parseTime($("#du").val()) / 60000;
                        var au = parseTime($("#au").val()) / 60000;
                        if (du > au) {
                            au = au + (24 * 60);
                        }
                        $('#duree').val((au - du));
                    }
                });

                function parseTime(cTime) {
                    if (cTime == '') return null;
                    var d = new Date();
                    var time = cTime.match(/(\d+)(:(\d\d))?\s*(p?)/);
                    d.setHours(parseInt(time[1]) + ((parseInt(time[1]) < 12 && time[4]) ? 12 : 0));
                    d.setMinutes(parseInt(time[3]) || 0);
                    d.setSeconds(0, 0);
                    return d;
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
                            window.location.href = '{{route("rapports_FoncRevExt.index")}}';

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
