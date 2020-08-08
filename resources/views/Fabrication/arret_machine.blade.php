@extends('layouts.app')

@section('style')
    <title>Fonctionnement Des Machines</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .table {
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

        input[type="time"] {
            padding-right: 2px;
            padding-left: 2px;
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
            width: 20%;
            vertical-align: middle !important;
            text-align: center;
        }

        .input-title {
            text-align: center;
            word-break: keep-all;
            font-size: 16px;
            font-weight: bold;
        }

        .input-text {
            padding: 0;
        }

        .col-head {
            padding: 5px;
        }

        .table {
            color: #000;
        }

        .table {
            table-layout: auto;
            width: 100%;
        }

        .table td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .operateurDelete {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .form-control {
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="container">

        <section>
            <div class="tab-pane fade show active" id="arrets" role="tabpanel" aria-labelledby="arrets-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="rapports-tab" href="{{route('rapprod.show', ['id'=>$rapport->Numero])}}"
                           aria-selected="false">Rapport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active  text-dark " id="arrets-tab" data-toggle="tab" href="#arrets"
                           role="tab"
                           aria-controls="arrets" aria-selected="true">Arrets Machine</a>
                    </li>
                    @if($rapport->Machine=="E")
                        <li class="nav-item">
                            <a class="nav-link" id="rapports-tab"
                               href="{{route('MasEPrep.show', ['id'=>$rapport->Numero])}}"
                               aria-selected="false">Préparation des Bobines</a>
                        </li>
                    @endif
                </ul>
                <br>

                <input name="id" type="hidden" id="id" value="">
                <input type="hidden" name="Pid" id="Pid" value="{{$rapport->Pid}}">
                <input type="hidden" name="Did" id="Did" value="{{$rapport->Did}}">
                <input type="hidden" name="NumRap" id="NumRap" value="{{$rapport->Numero}}">
                <input type="hidden" name="Machine" id="Machine" value="{{$rapport->Machine}}">
                <form class="row" autocomplete="off" id="DetailsForm">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  col-head">
                        <div class="row">
                            <div class="col-12 input-title text-primary ">TETE DE SOUDAGE INTERIEURE</div>
                            <label class="col-3 text-center"><b>Tete 1 :</b></label>
                            <div class="col-4 input-group"><input class="form-control" type="number" step="0.01"
                                                                  value="{{$rapport->TSI1V}}"
                                                                  id="TSI1V" name="TSI1V"
                                                                  aria-describedby="basic-addon1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">V</span>
                                </div>
                            </div>
                            <div class="col-4 input-group"><input class="form-control" type="number" step="0.01"
                                                                  value="{{$rapport->TSI1A}}"
                                                                  id="TSI1A" name="TSI1A"
                                                                  aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">A</span>
                                </div>
                            </div>
                            <label class="col-3 text-center" style="margin-top:5px"><b>Tete 2 :</b></label>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSI2V}}"
                                                                                         id="TSI2V" name="TSI2V"
                                                                                         aria-describedby="basic-addon3"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">V</span>
                                </div>
                            </div>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSI2A}}"
                                                                                         id="TSI2A" name="TSI2A"
                                                                                         aria-describedby="basic-addon4"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon4">A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-head">
                        <div class="row">
                            <div class="col-12 input-title text-primary ">TETE DE SOUDAGE EXTERIEURE</div>
                            <label class="col-3 text-center" style="margin-top:5px"><b>Tete 1 :</b></label>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSE1V}}"
                                                                                         id="TSE1V" name="TSE1V"
                                                                                         aria-describedby="basic-addon3"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">V</span>
                                </div>
                            </div>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSE1A}}"
                                                                                         id="TSE1A" name="TSE1A"
                                                                                         aria-describedby="basic-addon4"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon4">A</span>
                                </div>
                            </div>
                            <label class="col-3 text-center" style="margin-top:5px"><b>Tete 2 :</b></label>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSE2V}}"
                                                                                         id="TSE2V" name="TSE2V"
                                                                                         aria-describedby="basic-addon3"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">V</span>
                                </div>
                            </div>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="number" step="0.01"
                                                                                         value="{{$rapport->TSE2A}}"
                                                                                         id="TSE2A" name="TSE2A"
                                                                                         aria-describedby="basic-addon4"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon4">A</span>
                                </div>
                            </div>
                            @if($rapport->Machine=="E")
                                <label class="col-3 text-center" style="margin-top:5px"><b>Tete 3 :</b></label>
                                <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                             type="number" step="0.01"
                                                                                             value="{{$rapport->TSE3V}}"
                                                                                             id="TSE3V" name="TSE3V"
                                                                                             aria-describedby="basic-addon3"
                                                                                             required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon3">V</span>
                                    </div>
                                </div>
                                <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                             type="number" step="0.01"
                                                                                             value="{{$rapport->TSE3A}}"
                                                                                             id="TSE3A" name="TSE3A"
                                                                                             aria-describedby="basic-addon4"
                                                                                             required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon4">A</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-head">
                        <div class="col-12 input-title text-primary ">V.SOUDAGE</div>
                        <div class="col-12 input-group" style="margin-top:5px"><input class="form-control"
                                                                                      type="number" step="0.01"
                                                                                      value="{{$rapport->VSoudage}}"
                                                                                      id="v_soudage" name="v_soudage"
                                                                                      aria-describedby="basic-addon4"
                                                                                      required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon4">Cm/mn</span>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-head">
                        <div class="col-12 input-title text-primary ">LARGEUR CISAIge</div>
                        <div class="col-12 input-group" style="margin-top:5px"><input class="form-control"
                                                                                      type="number"
                                                                                      value="{{$rapport->LargCisAlge}}"
                                                                                      id="LargeurC" name="LargeurC"
                                                                                      aria-describedby="basic-addon4"
                                                                                      required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon4">mm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12  col-head">
                        <div class="row">
                            <label class="offset-3 col-4 text-center text-primary"><b>FIL :</b></label>
                            <label class="col-4 text-center text-primary"><b>FLUX :</b></label>
                            <label class="col-3 text-center"><b>Interieur :</b></label>
                            <div class="col-4 input-group"><input class="form-control" type="text"
                                                                  value="{{$rapport->TSIFil}}"
                                                                  id="TSIFil" name="TSIFil"
                                                                  aria-describedby="basic-addon1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">mm</span>
                                </div>
                            </div>
                            <div class="col-4 input-group"><input class="form-control" type="text"
                                                                  value="{{$rapport->TSIFlux}}"
                                                                  id="TSIFlux" name="TSIFlux"
                                                                  aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">kg</span>
                                </div>
                            </div>
                            <label class="col-3 text-center" style="margin-top:5px"><b>Exterieur :</b></label>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="text"
                                                                                         value="{{$rapport->TSEFil}}"
                                                                                         id="TSEFil" name="TSEFil"
                                                                                         aria-describedby="basic-addon3"
                                                                                         required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">mm</span>
                                </div>
                            </div>
                            <div class="col-4 input-group" style="margin-top:5px"><input class="form-control"
                                                                                         type="text"
                                                                                         value="{{$rapport->TSEFlux}}"
                                                                                         id="TSEFlux" name="TSEFlux"
                                                                                         aria-describedby="basic-addon4"
                                >
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon4">kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-head">
                        <div class="row">
                            <label class="col-4 input-title text-primary "
                                   style="margin-bottom:0px; vertical-align: middle">Relevé Compteur</label>

                            <div class="col-4 input-group" style="margin-top:5px" style="display: inline-block">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">Debut</span>
                                </div>
                                <input class="form-control"
                                       type="time"
                                       value="{{$rapport->RelComptD}}"
                                       id="RelComptD" name="RelComptD"
                                       aria-describedby="basic-addon4"
                                       required>

                            </div>
                            <div class="col-4 input-group" style="margin-top:5px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon4">&nbsp;&nbsp;Fin&nbsp;&nbsp;</span>
                                </div>
                                <input class="form-control"
                                       type="time"
                                       value="{{$rapport->RelComptF}}"
                                       id="RelComptF" name="RelComptF"
                                       aria-describedby="basic-addon4"
                                       required>

                            </div>
                        </div>
                    </div>
                    <button type="submit" style="display: none;">Submit</button>
                </form>
            </div>
        </section>
        <section>
            <form id="arretForm" autocomplete="off">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                        <div class="form-group row">
                            <label class="col-12" for="type_arret">Type D'arrêt</label>
                            <select class="form-control col-10" id="type_arret" name="type_arret" required  >
                                <option value="" disabled selected></option>
                                <option value="P1">P1</option>
                                <option value="P3">P3</option>
                                <option value="P4">P4</option>
                                <option value="RB">RB</option>
                                <option value="FAB">FAB</option>
                                <option value="Arret">Arret</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8 col-6">
                        <div class="form-group row">
                            <label class="col-12" for="cause">Cause</label>
                            <input class="form-control col-12" id="cause" name="cause" required>
                            <datalist id="panneP1List">
                                <option value="PE">PE</option>
                                <option value="PH">PH</option>
                                <option value="PM">PM</option>
                                <option value="PO">PO</option>
                                <option value="Autre">Autre</option>
                            </datalist>
                            <datalist id="pannesList">
                                <option value="Pause NDT">Pause NDT</option>
                                <option value="RX1">RX1</option>
                                <option value="Manque Bobine/flux">Manque Bobine/flux</option>
                                <option value="Air comp/Man,D'eau">Air comp/Man,D'eau</option>
                                <option value="NJ">NJ</option>
                                <option value="CO2">CO2</option>
                                <option value="Fin com">Fin com</option>
                                <option value="R.pos/Manu">R.pos/Manu</option>
                                <option value="Manque Oxyc">Manque Oxyc</option>
                                <option value="Manque Elec">Manque Elec</option>
                                <option value="Apsent">Apsent</option>
                                <option value="Manque Charge">Manque Charge</option>
                                <option value="RSA">RSA</option>
                                <option value="AVAL">AVAL</option>
                                <option value="Chandiam">Chandiam</option>
                                <option value="Chang Joint">Chang Joint</option>
                                <option value="Netoyage Zone">Netoyage Zone</option>
                                <option value="Equipe Rég">Equipe Rég</option>
                                <option value="Préparation Machine">Préparation Machine</option>
                                <option value="CH .EP">CH .EP</option>
                            </datalist>
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
                            <input class="col-10 form-control" type="number" id="duree" name="duree" min="1" value="" required>
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
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 offset-lg-1">
                    <div class="form-group row">
                        @csrf()
                        <input type="hidden" id="operateur_Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="operateur_Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="operateur_NumRap" name="NumRap" value="{{$rapport->Numero}}">
                        <label class="col-12" for="operateurs">Operateurs</label>
                        <div class="input-group mb-3 col-12">
                            <input type="text" class="form-control" placeholder="Nom d'operateur" id="operateur_Nom"
                                   name="Nom" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" id="OperateurSubmit" type="submit">Entrer</button>
                            </div>
                        </div>
                        <table id="operatuersTable" class="table">
                            @if(isset($operateurs))
                                @foreach($operateurs as $operateur)
                                    <tr id="operateur{{$operateur->id}}">
                                        <td>* {{$operateur->Nom}}</td>
                                        <td>
                                            <button id="operateur{{$operateur->id}}Delete"
                                                    class="operateurDelete text-danger"><i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 offset-lg-1">
                    <div class="form-group row">
                        <label class="col-12" for="observation">Observation</label>
                        <textarea class="col-10 form-control" id="observation" name="observation"
                                  rows="8">{{$rapport->ObsRap}}</textarea>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="offset-xl-6 offset-md-2 col-xl-3  col-md-5 col-sm-6" style="margin-top:10px">
                    <form method="post" action="{{route('rapports.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary" style="width:100%">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter Le
                                Rapport</b>
                        </button>
                    </form>
                </div>
                <div class=" col-xl-3 col-md-5 col-sm-6" style="margin-top:10px">
                    <button id="cloturer" class="btn btn-success" style="width:100%">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer Le Rapport</b>
                    </button>
                </div>
            </div>

        </section>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#annulerButton').hide();
            addOperatorsListeners();
            addArretsListeners();
            $('#OperateurSubmit').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/operateur')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        Nom: $('#operateur_Nom').val(),
                        Pid: $('#operateur_Pid').val(),
                        Did: $('#operateur_Did').val(),
                        NumRap: $('#operateur_NumRap').val()
                    },
                    success: function (result) {
                        $('#operatuersTable').append('<tr id="operateur' + result.operateur.id + '"><td>* ' + result.operateur.Nom +
                            '</td><td><button id="operateur' + result.operateur.id + 'Delete" class="operateurDelete text-danger" ><i class="fa fa-trash"></i></button></td></tr>');
                        addOperatorsListeners();
                    },
                    error: function (result) {
                        alert(result.responseJSON.message);
                    }
                });
            });

            function addOperatorsListeners() {
                $('.operateurDelete').each(function (e) {
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
                            url: "{{ url('/delete_operateur')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                id: id
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
            }

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
                                $('#annulerButton').hide();
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
            $('#annulerButton').click(function () {
                $('#ajouterPanne').html(' Ajouter panne ');
                $('#annulerButton').hide();
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
                        $('#type_arret').val(tr.find('#type' + id).html());
                        $('#du').val(tr.find('#du' + id).html());
                        $('#au').val(tr.find('#au' + id).html());
                        $('#duree').val(tr.find('#duree' + id).html());
                        $('#ndi').val(tr.find('#ndi' + id).html());
                        $('#obs').val(tr.find('#obs' + id).html());
                        $('#relv').val(tr.find('#relv' + id).html());
                        $('#id').val(id);

                        if ($('#type' + id).html() === 'panne') {
                            $('#type_arret').find('option[value=panne]').attr('selected', 'selected');
                            $('#type_arret').find('option[value=arret]').removeAttr('selected');

                        } else {
                            $('#type_arret').find('option[value=panne]').removeAttr('selected');
                            $('#type_arret').find('option[value=arret]').attr('selected', 'selected');
                        }
                        $('#ajouterPanne').html(' Modifier panne ');
                        $('#annulerButton').show();

                    });
                });
            }

            $('#cloturer').click(function (e) {

                if ($('#DetailsForm')[0].checkValidity()) {
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
                            _token: '{{csrf_token()}}',
                            ObsRap: $('#observation').val(),
                            TSI1V: $('#TSI1V').val(),
                            TSI1A: $('#TSI1A').val(),
                            TSI2V: $('#TSI2V').val(),
                            TSI2A: $('#TSI2A').val(),
                            TSE1V: $('#TSE1V').val(),
                            TSE1A: $('#TSE1A').val(),
                            TSE2V: $('#TSE2V').val(),
                            TSE2A: $('#TSE2A').val(),
                            TSE3V: $('#TSE3V').val(),
                            TSE3A: $('#TSE3A').val(),
                            TSIFlux: $('#TSIFlux').val(),
                            TSIFil: $('#TSIFil').val(),
                            TSEFlux: $('#TSEFlux').val(),
                            TSEFil: $('#TSEFil').val(),
                            RelComptF: $('#RelComptF').val(),
                            RelComptD: $('#RelComptD').val(),
                            v_soudage: $('#v_soudage').val(),
                            largeur: $('#LargeurC').val(),

                        },
                        success: function (result) {
                            if (result.rapportState.Etat === 'C') {
                                alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                                window.location.href = '{{route("rapports.index")}}';

                            }


                        },
                        error: function (result) {

                            alert(result.responseJSON.message);

                        }
                    });
                } else {

                    $('#DetailsForm').find(':submit').click();
                }
            });
            $('#type_arret').change(function () {
               if($(this).val()==="P1"){
                   $('#cause').attr('list','panneP1List');
                   $('#ndi').prop('required',true);
               }
               else if($(this).val()==="Arret"||$(this).val()==="Autres"){
                   $('#ndi').prop('required',false);
                   $('#cause').attr('list','pannesList');
               }else if($(this).val()==="P3"||$(this).val()==="P4"){
                   $('#ndi').prop('required',true);
                   $('#cause').removeAttr('list');
               }else{
                   $('#ndi').prop('required',false);
                   $('#cause').removeAttr('list');
               }
            });
        });

    </script>

@endsection
