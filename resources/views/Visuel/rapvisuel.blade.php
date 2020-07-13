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
            height: 225px;
        }

        .actions .col-1 {
            margin-right: 4px;

        }

        #arretForm button {
            margin-top: 0;
        }

        #annulerButton {
            padding: 0;
        }

        .visuelEdit, .visuelDelete {
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
        }

        .small-td {
            width: 8%
        }

        .medium-td {
            width: 12%
        }

        input[type=checkbox] {
            width: 18px;
            height: 18px;
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
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }

        .table-container {
            width: 100%;
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
                <div class="col-sm-12 col-md-9 col-xl-5 col-lg-5">
                    <div class="col-12">Information Rapport:&nbsp;<span class="valeur">   <span
                                    class="valeur"> Epais: {{$rapport->details->Epaisseur}}
                                mm -Diam : {{$rapport->details->Diametre}}mm</span></span></div>
                    <div class="col-12">Machine: &nbsp; <span class="valeur">  {{$rapport->Machine}} </span></div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-2 col-lg-2">
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-2 col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-sm-12 col-md-8 col-xl-3 col-lg-3">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                            / {{$rapport->CodeAgent}}</span></div>
                    <div class="row">Agent2: &nbsp; <span class="valeur">{{$rapport->NomAgents1}}
                            / {{$rapport->CodeAgent1}}</span></div>
                </div>

            </div>
        </section>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="visuelForm">
                        <input name="Numero" type="hidden" id="Numero" value=" ">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                        <table>
                            <thead>
                            <tr>
                                <th> N°Tube</th>
                                <th> Bis</th>
                                <th> Longueur</th>
                                <th> E</th>
                                <th> Y</th>
                                <th> Diam-D</th>
                                <th> Diam-F</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="large-td"><input class="  form-control" type="text" id="ntube" name="ntube"
                                                            value="" maxlength="5" minlength="5" required></td>
                                <td class="small-td"><input class=" " type="checkbox" id="bis" name="bis"></td>
                                <td class="large-td"><input class=" form-control" type="number" min="7500" max="13500"
                                                            id="longueur" name="longueur" required></td>
                                <td class="medium-td"><input class=" form-control" type="number" id="E" name="E"
                                                             required></td>
                                <td class="medium-td"><input class=" form-control" type="number" id="Y" name="Y"
                                                             required></td>
                                <td class="large-td"><input class="  form-control" type="number" id="diam_d"
                                                            name="diam_d" required></td>
                                <td class="large-td"><input class="  form-control" type="number" id="diam_f"
                                                            name="diam_f" required></td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="row ">
                            <label class="col-4 " for="Sond"><b> Tube Sondage</b></label>
                            <input class=" col-1" type="checkbox" id="Sond" name="Sond">

                            <button type="reset" class="col-2  btn btn-secondary" type="button" id="annulerButton">
                                Annuler
                            </button>
                            <button type="button" class="col-4   offset-1  btn btn-success" type="button" id="Ajouter">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <section class="top-actions">
                    <h5>Observation sur Soudure</h5>
                    <form id="Form1">
                        <table>
                            <thead>
                            <tr>
                                <th> Nbr</th>
                                <th> Defaut</th>
                                <th> Val</th>
                                <th> Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class=" " style="width:10%"><input class="  form-control" type="number" id="nbr1"
                                                                       name="nbr1"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="defaut1"
                                                                        name="defaut1">
                                        <option hidden disabled selected value></option>
                                        @if(isset($defautsSoudure))
                                            @foreach($defautsSoudure as $defaut )
                                                <option defautId="{{$defaut->id}}" data-tokens="{{$defaut->Defaut}}"
                                                        value="{{$defaut->Defaut}}"
                                                        class="my-select">{{$defaut->Defaut}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>
                                <td class=" " style="width:20%"><input class=" form-control" type="number" id="valeur1"
                                                                       name="valeur1"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="operation1"
                                                                        name="operation1" required>
                                        <option hidden disabled selected value></option>
                                        @if(isset($operations))
                                            @foreach($operations as $operation)
                                                <option operationId="{{$operation->id}}"
                                                        value="{{$operation->Operation}}"
                                                        class="my-select">{{$operation->Operation}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>

                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row actions">
                        <div class="col-1">
                            <button id="addObsSoudure" class="btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-1">
                            <button id="removeObsSoudure" class="btn btn-danger"><b><i class="fa fa-minus "></i></b></button>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="ObsSoudure" class=" form-control col-12" readonly>

                    </div>


                </section>
            </div>
            <div class="col-xl-4 col-lg-6  col-md-6 col-sm-12">
                <section class="top-actions">
                    <h5>Observation sur metal de base</h5>
                    <form id="Form2">
                        <table>
                            <thead>
                            <tr>
                                <th> Nbr</th>
                                <th> Defaut</th>
                                <th> Val</th>
                                <th> Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class=" " style="width:10%"><input class="  form-control" type="number" id="nbr2"
                                                                       name="nbr2"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="defaut2"
                                                                        name="defaut2">
                                        <option hidden disabled selected value></option>
                                        @if(isset($defautsMetal))
                                            @foreach($defautsMetal as $defaut )
                                                <option defautId="{{$defaut->id}}" value="{{$defaut->Defaut}}"
                                                        class="my-select">{{$defaut->Defaut}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class=" " style="width:20%"><input class=" form-control" type="number" id="valeur2"
                                                                       name="valeur2"></td>
                                <td class=" " style="width:35%"><select class="form-control" id="operation2"
                                                                        name="operation2" required>
                                        <option hidden disabled selected value></option>
                                        @if(isset($operations))
                                            @foreach($operations as $operation)
                                                <option operationId="{{$operation->id}}"
                                                        value="{{$operation->Operation}}"
                                                        class="my-select">{{$operation->Operation}}</option>
                                            @endforeach
                                        @endif
                                    </select></td>

                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="row actions">
                        <div class="col-1">
                            <button id="addObsMetal" class="btn btn-success"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                        <div class="col-1">
                            <button id="removeObsMetal" class="btn btn-danger"><b><i class="fa fa-minus "></i></b></button>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="ObsMetal" class=" form-control col-12" readonly>

                    </div>
                </section>

            </div>
        </div>
        <section class="col-12">
            <div class="table-container">
                <table id="visuelsTable" class="table table-striped table-hover table-bordered rapprods ">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>Sond</th>
                        <th>Longueur</th>
                        <th>E</th>
                        <th>Y</th>
                        <th>DiamD</th>
                        <th>DiamF</th>
                        <th>ObsSoudure</th>
                        <th>ObsMetal</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($visuels))
                        @foreach($visuels as $visuel)
                            <tr id="visuel{{$visuel->Numero}}">
                                <td id="tube{{$visuel->Numero}}">{{$visuel->Tube}}</td>
                                <td id="bis{{$visuel->Numero}}">@if($visuel->Bis) <input type="checkbox" checked
                                                                                         onclick="return false;">
                                    @elseif(!$visuel->Bis)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="sond{{$visuel->Numero}}">@if($visuel->Sond) <input type="checkbox" checked
                                                                                           onclick="return false;">
                                    @elseif(!$visuel->Sond)<input type="checkbox" onclick="return false;"> @endif</td>
                                <td id="longueur{{$visuel->Numero}}">{{$visuel->Longueur}}</td>
                                <td id="E{{$visuel->Numero}}">{{$visuel->E}}</td>
                                <td id="Y{{$visuel->Numero}}">{{$visuel->Y}}</td>
                                <td id="diam_d{{$visuel->Numero}}">{{$visuel->DiamD}}</td>
                                <td id="diam_f{{$visuel->Numero}}">{{$visuel->DiamF}}</td>
                                <td class="obsS" id="obsSoudure{{$visuel->Numero}}">{{$visuel->ObsSoudure}}</td>
                                <td class="obsM" id="obsMetal{{$visuel->Numero}}">{{$visuel->ObsMetal}}</td>
                                <td>
                                    <button id="visuel{{$visuel->Numero}}Edit" class="visuelEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="visuel{{$visuel->Numero}}Delete" class="visuelDelete text-danger"><i
                                                class="fa fa-trash"></i></button>
                                </td>
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
            <div class="row">
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class=" col-lg-3 col-md-6 col-sm-12">
                    <button type="button" id="imprimer" class="btn btn-outline-primary col-12">
                        <b><i class="fa fa-print" style="font-size: 20px;"></i> &nbsp;&nbsp;Imprimer</b>
                    </button>
                </div>
                <div class=" col-lg-3  col-md-6 col-sm-12">
                    <form method="post" action="{{route('rapports_visuels.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le
                                rapport</b></button>
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
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  " role="document" id="BobineModal">
            <section>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Arrets Machine</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"
                                                              onclick="$('#arretForm').trigger('reset')"
                                                              class="btn btn-danger"><b>X</b></button></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="arretForm">
                            <input name="idArret" type="hidden" id="idArret" value="">
                            <input type="hidden" name="Pid" id="Pid" value="{{$rapport->Pid}}">
                            <input type="hidden" name="Did" id="Did" value="{{$rapport->Did}}">
                            <input type="hidden" name="NumRap" id="NumRap" value="{{$rapport->Numero}}">
                            <input type="hidden" name="Machine" id="Machine" value="{{$rapport->Machine}}">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-12" for="type_arret">Type Arret</label>
                                        <select class="form-control col-10" id="type_arret" name="type_arret">
                                            <option value="panne">Panne</option>
                                            <option value="arret" selected>Arret</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group  ">
                                                <label class="col-12" for="du">Du</label>
                                                <input class="col-12 form-control" type="time" id="du" name="du"
                                                       value="00:00" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group  ">
                                                <label class="col-12" for="au">Au</label>
                                                <input class="col-12 form-control" type="time" id="au" name="au"
                                                       value="00:00" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="duree">Durée(m)</label>
                                        <input class="col-12 form-control" type="number" id="duree" name="duree"
                                               value="" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-11 offset-1" for="cause">Cause</label>
                                        <input class="col-11 offset-1 form-control" type="text" id="cause" name="cause"
                                               value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="ndi">N°DI</label>
                                        <input class="col-10 form-control" type="text" id="ndi" name="ndi" value="">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-12" for="obs">Obs</label>
                                        <input class="col-11 form-control" type="text" id="obs" name="obs" value="">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-12" for="relv">Relv_Compt</label>
                                        <input class="col-12 form-control" type="text" id="relv" name="relv" value="">
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-3 " id="annulerButton">
                                    <div class="col-10">
                                        <label class="col-10"> &nbsp;</label>
                                        <button type="reset" id="annulerPanne" class="btn btn-secondary"> Annuler
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                    <div class="col-10"><label class="col-12"> &nbsp;</label>
                                    </div>
                                    <button class="col-10 btn btn-success offset-2" type="button" type="submit"
                                            id="ajouterPanne"> Ajouter panne
                                    </button>
                                </div>
                            </div>


                        </form>
                        <hr>
                        <div class="table-container">
                            <table class="table table-striped table-hover table-bordered" id="ArretTable">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th>Type Arret</th>
                                    <th>Du</th>
                                    <th>Au</th>
                                    <th>Duree</th>
                                    <th>Cause</th>
                                    <th>N°DI</th>
                                    <th>Obs</th>
                                    <th>Relv_Compt</th>

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
                                            <td id="relv{{$arret->id}}">{{$arret->Relv_Compt}}</td>
                                            <td class="actions">
                                                <button id="arret{{$arret->id}}Edit" class="arretEdit text-primary"><i
                                                            class="fa fa-edit"></i></button>
                                                <button id="arret{{$arret->id}}Delete" class="arretDelete text-danger">
                                                    <i class="fa fa-trash"></i></button>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection
@section('script')

    <script>

        $(document).ready(function () {
            DefautsSoudure = [];
            DefautsMetal = [];
            $('.my-select').selectpicker();
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#addObsSoudure').click(function (e) {
                e.preventDefault();
                if ($('#defaut1').val() !== null && $('#operation1').val() !== null) {
                    if ($('#operation1').val() !== 'R.A.S') {
                        Opr = $('#operation1').val();
                        IdDef = $('#defaut1').find("option:selected").attr("defautId");
                        Defaut = $('#defaut1').val();
                        Valeur = $('#valeur1').val();
                        NbOpr = $('#operation1').find("option:selected").attr("operationId");
                        Nombre = $('#nbr1').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        DefautsSoudure.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                        console.log(DefautsSoudure);
                        SetDefautsSoudure();

                    } else {
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }

            });
            $('#addObsMetal').click(function (e) {
                e.preventDefault();
                if ($('#defaut2').val() !== null && $('#operation2').val() !== null) {
                    if ($('#operation2').val() !== 'R.A.S') {
                        Opr = $('#operation2').val();
                        IdDef = $('#defaut2').find("option:selected").attr("defautId");
                        Defaut = $('#defaut2').val();
                        Valeur = $('#valeur2').val();
                        NbOpr = $('#operation2').find("option:selected").attr("operationId");
                        Nombre = $('#nbr2').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        DefautsMetal.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                        console.log(DefautsMetal);
                        SetDefautsMetal();
                    } else {
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                } else {
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });
            $('#removeObsSoudure').click(function (e) {
                e.preventDefault();
                DefautsSoudure.shift();
                if (DefautsSoudure.length > 0) {
                    SetDefautsSoudure();
                } else {
                    $('#ObsSoudure').val('');
                }

            });
            $('#removeObsMetal').click(function (e) {
                e.preventDefault()
                DefautsMetal.shift();
                if (DefautsMetal.length > 0) {
                    SetDefautsMetal();
                } else {
                    $('#ObsMetal').val('');
                }
            });
            $('#Ajouter').click(function (e) {
                if ($('#visuelForm')[0].checkValidity()) {


                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    ntube = $('#ntube').val().replace(/[^0-9]/g, '');
                    if ((DefautsSoudure.length > 0 || $('#operation1').val() === 'R.A.S')
                        && (DefautsMetal.length > 0 || $('#operation2').val() === 'R.A.S')) {
                        if (DefautsSoudure.length > 0) {

                            obsSoud = $('#ObsSoudure').val() + '|' + DefautsSoudure[DefautsSoudure.length - 1][0] + '|';
                        } else if ($('#operation1').val() === 'R.A.S') {
                            obsSoud = $('#operation1').val();
                            DefautsSoudure.push([
                                Opr = $('#operation1').val(), null, null, null, $('#operation1').find("option:selected").attr("operationId"), null]);
                        }
                        if (DefautsMetal.length > 0) {

                            obsMet = $('#ObsMetal').val() + '|' + DefautsMetal[DefautsMetal.length - 1][0] + '|';

                        } else if ($('#operation2').val() === 'R.A.S') {
                            obsMet = $('#operation2').val();
                            DefautsMetal.push([
                                Opr = $('#operation2').val(), null, null, null, $('#operation2').find("option:selected").attr("operationId"), null]);
                        }
                    if ($('#Ajouter').html() !== ' Modifier ') {


                            $.ajax({
                                url: "{{ route('visuels.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    machine: $('#machine').val(),
                                    Pid: $('#Pid').val(),
                                    Did: $('#Did').val(),
                                    NumeroRap: $('#NumRap').val(),
                                    ntube: ntube,
                                    bis: $('#bis:checked').length > 0,
                                    longueur: $('#longueur').val(),
                                    sond: $('#Sond:checked').length > 0,
                                    E: $('#E').val(),
                                    Y: $('#Y').val(),
                                    Diam_D: $('#diam_d').val(),
                                    Diam_F: $('#diam_f').val(),
                                    ObsMetal: obsMet,
                                    ObsSoudure: obsSoud,
                                    Defauts: DefautsSoudure.concat(DefautsMetal),
                                },
                                success: function (result) {
                                    var bis = "";
                                    var sond = "";
                                    if (result.visuel.Bis) {
                                        bis = "checked"
                                    }
                                    if (result.visuel.Sond) {
                                        sond = "checked"
                                    }
                                    $('#visuelsTable').append('<tr id="visuel' + result.visuel.Numero + '">' +
                                        '                        <td id="tube' + result.visuel.Numero + '">' + result.visuel.Tube + '</td> ' +
                                        '                        <td id="bis' + result.visuel.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                        '                        <td id="sond' + result.visuel.Numero + '">' + '<input type="checkbox" ' + sond + ' onclick="return false;">' +
                                        '                        <td id="longueur' + result.visuel.Numero + '">' + result.visuel.Longueur + '</td>' +
                                        '                        <td id="E' + result.visuel.Numero + '">' + result.visuel.E + '</td> ' +
                                        '                        <td id="Y' + result.visuel.Numero + '">' + result.visuel.Y + '</td> ' +
                                        '                        <td id="diam_d' + result.visuel.Numero + '">' + result.visuel.DiamD + '</td>' +
                                        '                        <td id="diam_f' + result.visuel.Numero + '">' + result.visuel.DiamF + '</td>' +
                                        '                        <td id="obsSoudure' + result.visuel.Numero + '">' + result.visuel.ObsSoudure + '</td>' +
                                        '                        <td id="obsMetal' + result.visuel.Numero + '">' + result.visuel.ObsMetal + '</td>' +
                                        '                        <td><button id="visuel' + result.visuel.Numero + 'Edit" class="visuelEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                        '                            <button id="visuel' + result.visuel.Numero + 'Delete" class="visuelDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                        '                             </td>' +
                                        '                    </tr>');
                                    $('#visuelForm').trigger("reset");
                                    $('#Form1').trigger("reset");
                                    $('#Form2').trigger("reset");
                                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                    $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                                    $('#ObsMetal').val('');
                                    $('#ObsSoudure').val('');
                                    DefautsSoudure = [];
                                    DefautsMetal = [];

                                    addRapprodsListeners();
                                },
                                error: function (result) {
                                    alert(result.responseJSON.message);
                                    console.log(result);
                                }
                            });

                    } else {

                        $.ajax({
                            url: "{{url('/visuels/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                machine: $('#machine').val(),
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: ntube,
                                bis: $('#bis:checked').length > 0,
                                longueur: $('#longueur').val(),
                                sond: $('#Sond:checked').length > 0,
                                E: $('#E').val(),
                                Y: $('#Y').val(),
                                Diam_D: $('#diam_d').val(),
                                Diam_F: $('#diam_f').val(),
                            },
                            success: function (result) {
                                console.log(result);
                                var bis = "";
                                var sond = "";
                                if (result.visuel.Bis) {
                                    bis = "checked"
                                }
                                if (result.visuel.Sond) {
                                    sond = "checked"
                                }
                                $('#visuel' + id).replaceWith('<tr id="visuel' + result.visuel.Numero + '">' +
                                    '                        <td id="tube' + result.visuel.Numero + '">' + result.visuel.Tube + '</td> ' +
                                    '                        <td id="bis' + result.visuel.Numero + '">' + '<input type="checkbox" ' + bis + ' onclick="return false;">' +
                                    '                        <td id="sond' + result.visuel.Numero + '">' + '<input type="checkbox" ' + sond + ' onclick="return false;">' +
                                    '                        <td id="longueur' + result.visuel.Numero + '">' + result.visuel.Longueur + '</td>' +
                                    '                        <td id="E' + result.visuel.Numero + '">' + result.visuel.E + '</td> ' +
                                    '                        <td id="Y' + result.visuel.Numero + '">' + result.visuel.Y + '</td> ' +
                                    '                        <td id="diam_d' + result.visuel.Numero + '">' + result.visuel.DiamD + '</td>' +
                                    '                        <td id="diam_f' + result.visuel.Numero + '">' + result.visuel.DiamF + '</td>' +
                                    '                        <td id="obsSoudure' + result.visuel.Numero + '">' + result.visuel.ObsSoudure + '</td>' +
                                    '                        <td id="obsMetal' + result.visuel.Numero + '">' + result.visuel.ObsMetal + '</td>' +
                                    '                        <td><button id="visuel' + result.visuel.Numero + 'Edit" class="visuelEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="visuel' + result.visuel.Numero + 'Delete" class="visuelDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');


                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#visuelForm').trigger("reset");
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                                $('#ObsMetal').val('');
                                $('#ObsSoudure').val('');
                                EnableForms();
                                addRapprodsListeners();
                                DefautsSoudure = [];
                                DefautsMetal = [];
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
            $('#annulerButton').click(function () {
                $('#visuelForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"    >');
                $('#ObsMetal').val('');
                $('#ObsSoudure').val('');
                $('#ntube').removeAttr("readonly");
                EnableForms();
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.visuelDelete').each(function (e) {
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
                            url: "{{url('/visuels/')}}/" + id,
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

                    $('#ntube').removeAttr("readonly");
                });
                $('.visuelEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#Numero').val(id);
                        $('#ntube').val($('#tube' + id).html()).attr('readonly', 'readonly');
                        ;
                        if ($('#bis' + id).find('input[checked]').length > 0) {

                            $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"     checked    >');
                        } else {
                            $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"         >');
                        }
                        $('#longueur').val($('#longueur' + id).html());
                        $('#E').val($('#E' + id).html());
                        $('#Y').val($('#Y' + id).html());
                        $('#diam_d').val($('#diam_f' + id).html());
                        $('#diam_f').val($('#diam_f' + id).html());
                        if ($('#sond' + id).find('input[checked]').length > 0) {

                            $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"     checked    >');
                        } else {
                            $('#Sond').replaceWith('<input class=" " type="checkbox" id="Sond" name="Sond"         >');
                        }
                        $('#ObsMetal').val($('#obsMetal' + id).html());
                        $('#ObsSoudure').val($('#obsSoudure' + id).html());
                        $('#Ajouter').html(' Modifier ');
                        $('#annulerButton').show();
                        DisableForms();

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
                            window.location.href = '{{route("rapports_visuels.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });

            function SetDefautsSoudure() {
                $('#ObsSoudure').val('');

                DefautsSoudure.forEach(function (item, index) {

                    if (typeof item[2] !== 'undefined') {
                        obs = item[2];
                        if ($('#nbr1').val() > 0) {
                            obs = $('#nbr1').val() + ' ' + obs;
                        }
                        if ($('#valeur1').val() > 0) {
                            obs = obs + '(' + $('#valeur1').val() + ')';
                        }
                        if (DefautsSoudure.length > index + 1) {
                            NextOp = DefautsSoudure[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#ObsSoudure').val($('#ObsSoudure').val() + '+' + obs);
                        } else {
                            $('#ObsSoudure').val($('#ObsSoudure').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsSoudure = $('#ObsSoudure').val();
                        if (ObsSoudure.charAt(0) === '+')
                            $('#ObsSoudure').val(ObsSoudure.substr(1));
                    }
                });


            }

            function SetDefautsMetal() {
                $('#ObsMetal').val('');
                DefautsMetal.forEach(function (item, index) {
                    if (typeof item[2] !== 'undefined') {
                        obs = item[2];
                        if ($('#nbr2').val() > 0) {
                            obs = $('#nbr2').val() + ' ' + obs;
                        }
                        if ($('#valeur2').val() > 0) {
                            obs = obs + '(' + $('#valeur2').val() + ')';
                        }
                        if (DefautsMetal.length > index + 1) {
                            NextOp = DefautsMetal[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#ObsMetal').val($('#ObsMetal').val() + '+' + obs);
                        } else {
                            $('#ObsMetal').val($('#ObsMetal').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsMetal = $('#ObsMetal').val();
                        if (ObsMetal.charAt(0) === '+')
                            $('#ObsMetal').val(ObsMetal.substr(1));
                    }
                });

            }

            function DisableForms() {
                $('#nbr1').prop('disabled', true);
                $('#nbr2').prop('disabled', true);
                $('#defaut1').prop('disabled', true);
                $('#defaut2').prop('disabled', true);
                $('#valeur1').prop('disabled', true);
                $('#valeur2').prop('disabled', true);
                $('#operation1').prop('disabled', true);
                $('#operation2').prop('disabled', true);
                $('#addObsMetal').prop('disabled', true);
                $('#addObsSoudure').prop('disabled', true);
                $('#removeObsMetal').prop('disabled', true);
                $('#removeObsSoudure').prop('disabled', true);
            }

            function EnableForms() {
                $('#nbr1').prop('disabled', false);
                $('#nbr2').prop('disabled', false);
                $('#defaut1').prop('disabled', false);
                $('#defaut2').prop('disabled', false);
                $('#valeur1').prop('disabled', false);
                $('#valeur2').prop('disabled', false);
                $('#operation1').prop('disabled', false);
                $('#operation2').prop('disabled', false);
                $('#addObsMetal').prop('disabled', false);
                $('#addObsSoudure').prop('disabled', false);
                $('#removeObsMetal').prop('disabled', false);
                $('#removeObsSoudure').prop('disabled', false);
            }
        });
        $('#imprimer').click(function (e) {
            e.preventDefault();

            window.open('{{route("printRap",["id"=>$rapport->Numero])}}', '_blank');
        });

    </script>
    <script>
        $(document).ready(function () {

            addArretsListeners();
            $('#annulerPanne').click(function () {
                $('#ajouterPanne').html(' Ajouter panne ');
                $('#annulerPanne').hide();
                $('#arretForm').trigger('reset');
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
                        $('#du').val(tr.find('#du' + id).html());
                        $('#au').val(tr.find('#au' + id).html());
                        $('#duree').val(tr.find('#duree' + id).html());
                        $('#ndi').val(tr.find('#ndi' + id).html());
                        $('#obs').val(tr.find('#obs' + id).html());
                        $('#relv').val(tr.find('#relv' + id).html());
                        $('#idArret').val(id);

                        if ($('#type' + id).html() === 'panne') {
                            $('#type_arret').find('option[value=panne]').attr('selected', 'selected');
                            $('#type_arret').find('option[value=arret]').removeAttr('selected');

                        } else {
                            $('#type_arret').find('option[value=panne]').removeAttr('selected');
                            $('#type_arret').find('option[value=arret]').attr('selected', 'selected');
                        }
                        $('#ajouterPanne').html(' Modifier panne ');
                        $('#annulerPanne').show();

                    });
                });
            }

            $('#ajouterPanne').click(function (e) {
                if ($('#arretForm')[0].checkValidity()) {
                    const id = $('#idArret').val();
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
                                relv: $('#relv').val(),
                            },
                            success: function (result) {


                                $('#ArretTable').append('<tr id="arret' + result.arret.id + '">' +
                                    '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                    '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                    '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                    '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                    '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                    '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                    '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                    '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt + '</td>' +
                                    '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td></tr>');

                                addArretsListeners();
                            },
                            error: function (result) {
                                console.log(result.responseJSON);
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
                                relv: $('#relv').val(),
                            },
                            success: function (result) {

                                $('#ArretTable').find('#arret' + result.arret.id).html(
                                    '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                    '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                    '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                    '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                    '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                    '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                    '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                    '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt + '</td>' +
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
            $("#au , #du").click(function (event) {


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
        });
    </script>

@endsection
