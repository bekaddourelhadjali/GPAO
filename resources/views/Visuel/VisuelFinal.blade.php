@extends('layouts.app')

@section('style')
    <title>Rapport Visuel Final</title>
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

        .defs {
            font-weight: bold;
            cursor: pointer;
            border-width: 2px;
        }

        #defauts {
            margin-bottom: 10px;
        }

        .form-group label{
            text-align: center;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <div class="container-fluid">

        <section id="head-section">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="row">Détail de Projet: &nbsp; <span class="valeur">{{$detailP->Nom}}
                            : Epaisseur : {{$detailP->Epaisseur}} mm -- Diametre : {{$detailP->Diametre}} mm</span>
                    </div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-6 col-sm-2  col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-6 col-sm-6  col-lg-3">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                            / {{$rapport->CodeAgent}}</span></div>
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                </div>

            </div>
        </section>
        <div class="row">
            <div class="   col-lg-7 col-sm-12">

                <form   id="repForm" autocomplete="off">
                <section class="top-actions">
                    <h5>Info Tube</h5>
                    @php  @endphp
                    <input name="Numero" type="hidden" id="Numero" value="">
                    <input name="NumeroRap" type="hidden" id="NumeroRap" value="{{$rapport->Numero}}">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                    <div class="row">
                        <div class="  col-md-3 col-4">
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
                        <div class="  col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="EpaisseurD" style="padding-left: 0">Epaisseur_D</label>
                                <input class=" col-12 form-control" type="number" step="0.01" id="EpaisseurD"
                                       name="EpaisseurD"
                                       required>
                            </div>
                        </div>
                        <div class="  col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="EpaisseurC" style="padding-left: 0">Epaisseur_C</label>
                                <input class=" col-12 form-control"  type="number" step="0.01" id="EpaisseurC"
                                       name="EpaisseurC"
                                       required>
                            </div>
                        </div>
                        <div class="  col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="EpaisseurF" style="padding-left: 0">Epaisseur F</label>
                                <input class=" col-12 form-control"  type="number" step="0.01" id="EpaisseurF"
                                       name="EpaisseurF"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="DiametreD" style="padding-left: 0">Diametre_D</label>
                                <input class=" col-12 form-control" type="number" step="0.01" id="DiametreD"
                                       name="DiametreD"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="DiametreC" style="padding-left: 0">Diametre_C</label>
                                <input class=" col-12 form-control"  type="number" step="0.01" id="DiametreC"
                                       name="DiametreC"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="DiametreF" style="padding-left: 0">Diametre_F</label>
                                <input class=" col-12 form-control"  type="number" step="0.01" id="DiametreF"
                                       name="DiametreF"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="Ovalisation" style="padding-left: 0">Ovalisation</label>
                                <input class=" col-12 form-control" type="text" id="Ovalisation"
                                       name="Ovalisation"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="OrthogonaliteD" style="padding-left: 0">Orthogonalite_D</label>
                                <input class=" col-12 form-control" type="text" id="OrthogonaliteD"
                                       name="OrthogonaliteD"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="OrthogonaliteF" style="padding-left: 0">Orthogonalite_F</label>
                                <input class=" col-12 form-control" type="text" id="OrthogonaliteF"
                                       name="OrthogonaliteF"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="Rectitude" style="padding-left: 0">Rectitude</label>
                                <input class=" col-12 form-control" type="text" id="Rectitude"
                                       name="Rectitude"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="ChanfreinD" style="padding-left: 0">Chanfrein_D</label>
                                <input class=" col-12 form-control" type="text" id="ChanfreinD"
                                       name="ChanfreinD"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="ChanfreinF" style="padding-left: 0">Chanfrein_F</label>
                                <input class=" col-12 form-control" type="text" id="ChanfreinF"
                                       name="ChanfreinF"
                                       required>
                            </div>
                        </div>
                        <div class="   col-md-3 col-4">
                            <div class="form-group ">
                                <label class="col-12" for="Longueur" style="padding-left: 0">Longueur</label>
                                <input class=" col-12 form-control" type="number" id="Longueur" min="0"
                                       name="Longueur"
                                       required>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-6 ">
                            <label for="ObsTube" class="col-12">Observation</label>
                            <textarea type="text" class="form-control" name="ObsTube" id="ObsTube"></textarea>
                        </div>
                        <div class="col-6 ">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0">&nbsp;</label>
                                <button style=" margin-top: 0; " type="reset"
                                        class=" col-5 btn btn-outline-secondary " id="annulerButton">Annuler
                                </button>
                                </button>
                                <button style="  margin-top: 0;" type="submit" class=" col-6 btn btn-success"
                                        id="Ajouter">Ajouter
                                </button>
                            </div>
                        </div>

                    </div>
                </section>

        </form>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-8 offset-md-2 offset-lg-0 col-sm-12">
                <section class="top-actions">
                    <h5>Désignation des anomalies</h5>

                    <div class="row">
                        <div class="col-4 col-sm-2 col-lg-2">
                            <div class="form-group ">
                                <label class="col-12" for="nbr">Nbr</label>
                                <input class="  form-control" type="number" id="nbr" name="nbr">
                            </div>
                        </div>
                        <div class="col-8   col-sm-4">
                            <div class="form-group ">
                                <label class="col-12" for="defaut">Defaut</label>
                                <select class="form-control" id="defaut" name="defaut" required>
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
                        <div class="col-4 col-sm-2">
                            <div class="form-group ">
                                <label class="col-12" for="valeur">Valeur</label>
                                <input class=" form-control" type="number" id="valeur" name="valeur">
                            </div>
                        </div>
                        <div class="col-8 col-sm-4">
                            <div class="form-group ">
                                <label class="col-12" for="operation">Operation</label>
                                <select class="form-control" id="operation" name="operation" required>
                                    <option hidden disabled selected value></option>
                                    <option operationId="1"  value="R.A.S">R.A.S</option>
                                    <option operationId="2"   value="Déclassé">Déclassé</option>
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
                        <div class="form-group col-8  ">
                            <label for="observation" class="col-12">Observation</label>
                            <input type="text" class="form-control" name="observation" id="observation">
                        </div>
                        <div class="col-2">

                            <label class="col-12" for=""> </label>
                            <button id="addDefaut" class=" btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-2">
                            <label class="col-12" for=""> </label>
                            <button id="removeDefaut" class="btn btn-danger"><b><i class="fa fa-minus "></i></b>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <input type="text" id="defauts" class=" form-control col-12" readonly>

                    </div>


                </section>

            </div>
        </div>
        <section class="col-12">
            <div class="table-container" style="max-width: 120%">
                <table id="rx1sTable" class="table  table-bordered table-striped table-hover   ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th style="min-width:80px"  rowspan="2">Tube</th>
                        <th rowspan="2">Bis</th>
                        <th colspan="3"> Epaisseur</th>
                        <th colspan="3"> Diametre</th>
                        <th rowspan="2">Ovalisation</th>
                        <th colspan="2"> Orthogonalité</th>
                        <th rowspan="2"> Rectitude</th>
                        <th colspan="2">Chanfrein</th>
                        <th rowspan="2">Longueur</th>
                        <th rowspan="2">Defauts</th>
                        <th rowspan="2">Observations</th>
                        <th style="min-width:100px" rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Deb</th>
                        <th>Corps</th>
                        <th>Fin</th>
                        <th>Deb</th>
                        <th>Corps</th>
                        <th>Fin</th>
                        <th>Deb</th>
                        <th>Fin</th>
                        <th>Deb</th>
                        <th >Fin</th>
                    </tr>
                    </thead>
                    <tbody id="reps">
                    @if(isset($visuelFinals))
                        @foreach($visuelFinals as $item)
                            <tr id="rep{{$item->Id}}">
                                <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                                <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked
                                                                                 onclick="return false;">
                                    @elseif(!$item->Bis)<input type="checkbox" onclick="return false;"> @endif</td>

                                <td id="EpaisseurD{{$item->Id}}">{{$item->EpaisseurD}}</td>
                                <td id="EpaisseurC{{$item->Id}}">{{$item->EpaisseurC}}</td>
                                <td id="EpaisseurF{{$item->Id}}">{{$item->EpaisseurF}}</td>
                                <td id="DiametreD{{$item->Id}}">{{$item->DiametreD}}</td>
                                <td id="DiametreC{{$item->Id}}">{{$item->DiametreC}}</td>
                                <td id="DiametreF{{$item->Id}}">{{$item->DiametreF}}</td>
                                <td id="Ovalisation{{$item->Id}}">{{$item->Ovalisation}}</td>
                                <td id="OrthogonaliteD{{$item->Id}}">{{$item->OrthogonaliteD}}</td>
                                <td id="OrthogonaliteF{{$item->Id}}">{{$item->OrthogonaliteF}}</td>
                                <td id="Rectitude{{$item->Id}}">{{$item->Rectitude}}</td>
                                <td id="ChanfreinD{{$item->Id}}">{{$item->ChanfreinD}}</td>
                                <td id="ChanfreinF{{$item->Id}}">{{$item->ChanfreinF}}</td>
                                <td id="Longueur{{$item->Id}}">{{$item->Longueur}}</td>
                                <td id="Defauts{{$item->Id}}">{{$item->Defauts}}</td>
                                <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>

                                <td>
                                    <button id="rep{{$item->Id}}Edit" class="repEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="rep{{$item->Id}}Delete" class="repDelete text-danger"><i
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
                <div class=" col-lg-3 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>

                <div class=" col-lg-3 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#cardBackdrop">
                        <b><i class="fa fa-file-alt" style="font-size: 20px;"></i> &nbsp;Carte Tube </b></button>
                </div>
                <div class="  col-lg-3  col-md-4 col-sm-6 ">
                    <form method="post" action="{{route('rapports_VisuelFinal.destroy',["id"=>$rapport->Numero])}}">
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

    <script>

        $(document).ready(function () {
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();
            var Defauts = [];
            //Add Defaut
            $('#addDefaut').click(function (e) {
                e.preventDefault();
                if ($('#defaut').val() !== null && $('#operation').val() !== null) {
                    if ($('#operation').val() !== 'R.A.S'&&$('#operation').val() !== 'Déclassé') {
                    Opr = $('#operation').val();
                    IdDef = $('#defaut').find("option:selected").attr("defautId");

                    Defaut = $('#defaut').val();

                    Valeur = $('#valeur').val();
                    NbOpr = $('#operation').find("option:selected").attr("operationId");
                    Nombre = $('#nbr').val();
                    if (Valeur === '' || Valeur === 0) {
                        Valeur = null;
                    }
                    if (Nombre === '' || Nombre === 0) {
                        Nombre = null;
                    }


                    Obs = $('#observation').val();
                    Defauts.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre, , Obs]);
                    SetDefauts();
                        $('#valeur').val('');
                        $('#nbr').val('');
                    } else {
                        alert('Sélectionner une opération autre que R.A.S et Déclassé');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });
            //Remove Defaut
            $('#removeDefaut').click(function (e) {
                e.preventDefault();
                latDefaut = Defauts.pop();
                if (Defauts.length > 0) {
                    SetDefauts();
                } else {
                    $('#defauts').val('');
                }
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
                        if (ObsMetal.charAt(0) ===  '+')
                            $('#defauts').val(ObsMetal.substr(1));

                    }
                    if($('#defauts').val()=="null"){
                        $('#defauts').val('');
                    }

                    $('#defaut').val('');
                    $('#operation').val(Defauts[Defauts.length - 1][0]);
                    $('#observation').val(Defauts[Defauts.length - 1][6]);
                });

            }


            //Ajouter Reparation
            $('#Ajouter').click(function (e) {
                if ($('#repForm')[0].checkValidity() && $('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    e.preventDefault();
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if (Defauts.length > 0 || $('#operation').val() === 'R.A.S'|| $('#operation').val() === 'Déclassé' ) {
                        if (Defauts.length > 0) {

                            obs = $('#defauts').val() + '|' + Defauts[Defauts.length - 1][0] + '|';
                        } else if ($('#operation').val() === 'R.A.S'|| $('#operation').val() === 'Déclassé') {
                            obs = $('#operation').val();
                            Defauts.push([
                                Opr = $('#operation').val(), null, null, null, $('#operation').find("option:selected").attr("operationId"), null,null]);
                        }
                        var formData = new FormData(document.getElementById('repForm'));
                        var json_Defauts = JSON.stringify(Defauts);
                        formData.append('Defauts',json_Defauts);
                        formData.append('defauts',obs);
                        if ($('#Ajouter').html() !== ' Modifier ') {
                            $.ajax({
                                url: "{{ route('VisuelFinal.store')}}",
                                method: 'post',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    var item = result.visFin;
                                    $('#reps').append('<tr id="rep' + item.Id + '">\n' +
                                        '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                        '                                <td    id="EpaisseurD' + item.Id + '">' + item.EpaisseurD + '</td>\n' +
                                        '                                <td    id="EpaisseurC' + item.Id + '">' + item.EpaisseurC + '</td>\n' +
                                        '                                <td    id="EpaisseurF' + item.Id + '">' + item.EpaisseurF + '</td>\n' +
                                        '                                <td    id="DiametreD' + item.Id + '">' + item.DiametreD + '</td>\n' +
                                        '                                <td    id="DiametreC' + item.Id + '">' + item.DiametreC + '</td>\n' +
                                        '                                <td    id="DiametreF' + item.Id + '">' + item.DiametreF + '</td>\n' +
                                        '                                <td    id="Ovalisation' + item.Id + '">' + item.Ovalisation + '</td>\n' +
                                        '                                <td    id="OrthogonaliteD' + item.Id + '">' + item.OrthogonaliteD + '</td>\n' +
                                        '                                <td    id="OrthogonaliteF' + item.Id + '">' + item.OrthogonaliteF + '</td>\n' +
                                        '                                <td    id="Rectitude' + item.Id + '">' + item.Rectitude + '</td>\n' +
                                        '                                <td    id="ChanfreinD' + item.Id + '">' + item.ChanfreinD + '</td>\n' +
                                        '                                <td    id="ChanfreinF' + item.Id + '">' + item.ChanfreinF + '</td>\n' +
                                        '                                <td    id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                        '                                <td    id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                        '                                <td    id="Observation' + item.Id + '">' + item.Observation + '</td>\n' +
                                        '                                <td>\n' +
                                        '                                    <button id="rep' + item.Id + 'Edit" class="repEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                                    <button id="rep' + item.Id + 'Delete" class="repDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                        '                                </td>\n' +
                                        '                            </tr>');
                                    $('#repForm').trigger("reset");
                                    $('#nbr').val('');
                                    $('#defaut').val('');
                                    $('#valeur').val('');
                                    $('#operation').val('');
                                    $('#Ajouter').html(' Ajouter ');
                                    $('#annulerButton').hide();
                                    Defauts = [];
                                    $('#ntube').prop('disabled', false);
                                    addRapprodsListeners();
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                    console.log(result);
                                }
                            });

                        } else {
                            formData.append("_method","put");
                            $.ajax({
                                url: "{{url('/VisuelFinal/')}}/" + id,
                                method: 'post',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    var item = result.visFin;
                                    console.log(item);
                                    $('#rep' + id).replaceWith('<tr id="rep' + item.Id + '">\n' +
                                        '                                <td id="tube' + item.Id + '">' + item.Tube + '</td>\n' +
                                        '                               <td id="bis' + item.Id + '"> <input type="checkbox" ' + item.Bis_t + '  onclick="return false;"></td>' +
                                        '                                <td    id="EpaisseurD' + item.Id + '">' + item.EpaisseurD + '</td>\n' +
                                        '                                <td    id="EpaisseurC' + item.Id + '">' + item.EpaisseurC + '</td>\n' +
                                        '                                <td    id="EpaisseurF' + item.Id + '">' + item.EpaisseurF + '</td>\n' +
                                        '                                <td    id="DiametreD' + item.Id + '">' + item.DiametreD + '</td>\n' +
                                        '                                <td    id="DiametreC' + item.Id + '">' + item.DiametreC + '</td>\n' +
                                        '                                <td    id="DiametreF' + item.Id + '">' + item.DiametreF + '</td>\n' +
                                        '                                <td    id="Ovalisation' + item.Id + '">' + item.Ovalisation + '</td>\n' +
                                        '                                <td    id="OrthogonaliteD' + item.Id + '">' + item.OrthogonaliteD + '</td>\n' +
                                        '                                <td    id="OrthogonaliteF' + item.Id + '">' + item.OrthogonaliteF + '</td>\n' +
                                        '                                <td    id="Rectitude' + item.Id + '">' + item.Rectitude + '</td>\n' +
                                        '                                <td    id="ChanfreinD' + item.Id + '">' + item.ChanfreinD + '</td>\n' +
                                        '                                <td    id="ChanfreinF' + item.Id + '">' + item.ChanfreinF + '</td>\n' +
                                        '                                <td    id="Longueur' + item.Id + '">' + item.Longueur + '</td>\n' +
                                        '                                <td    id="Defauts' + item.Id + '">' + item.Defauts + '</td>\n' +
                                        '                                <td    id="Observation' + item.Id + '">' + item.Observation + '</td>\n' +
                                        '                                <td>\n' +
                                        '                                    <button id="rep' + item.Id + 'Edit" class="repEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                                    <button id="rep' + item.Id + 'Delete" class="repDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                        '                                </td>\n' +
                                        '                            </tr>');
                                    $('#repForm').trigger("reset");
                                    $('#Ajouter').html(' Ajouter ');
                                    $('#annulerButton').hide();
                                    $('#nbr').val('');
                                    $('#defaut').val('');
                                    $('#valeur').val('');
                                    $('#operation').val('');
                                    Defauts = [];
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
                        alert("Choisir soit l'opération R.A.S ou signaler un défaut et choisir une opération correspendante");

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
                $('#repForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#defauts').val('');
                $('#nbr').val('');
                $('#defaut').val('');
                $('#valeur').val('');
                $('#operation').val('');
                $('#ntube').prop('disabled', false);
                Defauts = [];
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.repDelete').each(function (e) {

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
                            url: "{{url('/VisuelFinal/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                $('#repForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#defauts').val('');
                                $('#nbr').val('');
                                $('#defaut').val('');
                                $('#valeur').val('');
                                $('#operation').val('');
                                $('#ntube').prop('disabled', false);
                                Defauts = [];
                            },
                            error: function (result) {
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });


                });
                $('.repEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/VisuelFinal/')}}/" + id + '/edit',
                            method: 'get',
                            data: {
                                id: id,


                            },
                            success: function (result) {
                                $('#Numero').val(id);
                                rep = result.visFin;

                                console.log(rep)
                                $('#ntube').prop('disabled', true);

                                if ($('#bis' + id).html().includes('checked'))
                                    $('#ntube').val($("#tube" + id).html() + "bis");
                                else
                                    $('#ntube').val($("#tube" + id).html());
                                $('#EpaisseurD').val($('#EpaisseurD' + id).html());
                                $('#EpaisseurC').val($('#EpaisseurC' + id).html());
                                $('#EpaisseurF').val($('#EpaisseurF' + id).html());
                                $('#DiametreD').val($('#DiametreD' + id).html());
                                $('#DiametreC').val($('#DiametreC' + id).html());
                                $('#DiametreF').val($('#DiametreF' + id).html());
                                $('#Ovalisation').val($('#Ovalisation' + id).html());
                                $('#OrthogonaliteD').val($('#OrthogonaliteD' + id).html());
                                $('#OrthogonaliteF').val($('#OrthogonaliteF' + id).html());
                                $('#Rectitude').val($('#Rectitude' + id).html());
                                $('#ChanfreinD').val($('#ChanfreinD' + id).html());
                                $('#ChanfreinF').val($('#ChanfreinF' + id).html());
                                $('#Longueur').val($('#Longueur' + id).html());
                                $('#ObsTube').val($('#Observation' + id).html());
                                Defauts = [];
                                rep.defs.forEach(function (item, index) {
                                    Defauts.push([item.Opr, item.IdDef, item.Defaut, item.Valeur, item.NbOpr, item.Nombre,  item.Observation]);
                                });
                                SetDefauts()


                                $('#Ajouter').html(' Modifier ');
                                $('#annulerButton').show();
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
                            window.location.href = '{{route("rapports_VisuelFinal.index")}}';

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
