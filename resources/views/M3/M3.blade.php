@extends('layouts.app')

@section('style')
    <style>

        button {
            margin: 10px 0;
        }

        span.valeur {
            color: red;
        }

        div.col-xl-3 {
            text-align: center;
        }

        .small-td {
            padding-left: 25px;

        }

        .small-td input {
            width: 18px;
            height: 18px;
            margin-top: -10px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        td {
            vertical-align: middle !important;
            text-align: center;

        }

        .table {
            color: #000;
            table-layout: fixed;
            width: 100%;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .large-td {
            width: 40%;
            vertical-align: super;
        }

        .btn {
            width: 100%;
        }

        .Mss {
            table-layout: auto;
            width: 100%;
        }

        .Mss td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .form-control {
            padding: 5px;
        }

        .inputs {
            margin-top: 10px;
            text-align: center;
        }

        .inputs label {
            font-weight: bold;
        }

        .form-control {
            text-align: center;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid">
        <section>
            <div class="row ">
                <div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">
                    <div class="row ">
                        <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                        <div class="col-10">
                            <h1>Project : {{$rapport->Project->Nom}}</h1>
                            <h5>Client: {{$rapport->Project->client->name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-xl-4 col-lg-4">
                    <div class="col-12">Information projet:</div>
                    <div class="col-12"><span class="valeur">   <span
                                    class="valeur"> Epais: {{$rapport->details->Epaisseur}}
                                mm -Diam : {{$rapport->details->Diametre}}mm</span></span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-3 col-lg-3">
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                    <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-2 col-lg-2">
                    <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span></div>
                    <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
                </div>
                <div class="col-sm-12 col-md-8 col-xl-3 col-lg-3">
                    <div class="row">Agent: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}</span></div>
                    <div class="row">Machine: &nbsp; <span class="valeur">{{$rapport->Machine}}</span></div>
                </div>

            </div>
        </section>
        <section>
            <form id="M3Form" autocomplete="off">
                <div class="row">
                    <input name="Numero" type="hidden" id="Numero" value="">
                    <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                    <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                    <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6  inputs">
                        <label class="form-label" for="bobine">Bobine</label>
                        <input class="form-control" list="bobines" id="bobine" type="number" name="bobine" required>
                        <datalist id="bobines">
                            @if(isset($bobines))
                                @foreach($bobines as $bobine)
                                    <option value="{{$bobine->Bobine}}">{{$bobine->Bobine}}</option>
                                @endforeach
                            @endif
                        </datalist>
                        <datalist id="bobines2">
                        </datalist>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs">
                        <label class="form-label" for="coulee">Coulee</label>
                        <input class="form-control" list="coulees" id="coulee" type="number" name="coulee" required>
                        <datalist id="coulees">
                            @if(isset($coulees))
                                @foreach($coulees as $coulee)
                                    <option value="{{$coulee->Coulee}}">{{$coulee->Coulee}}</option>
                                @endforeach
                            @endif
                        </datalist>
                        <datalist id="coulees2">
                        </datalist>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                   for="Poids">Poids (kg)</label>
                        <input class="form-control" type="text" id="Poids" name="Poids" maxlength="10" minlength="5"
                               min="10000"
                               disabled required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="LargeurD">Large
                            Debut (mm)</label>
                        <input class="form-control" type="number" value="" id="LargeurD" name="LargeurD" required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="LargeurF">Large
                            Fin (mm)</label>
                        <input class="form-control" type="number" value="" id="LargeurF" name="LargeurF" required></div>

                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurD">Epais
                            Debut (mm)</label>
                        <input class="form-control" type="number" step="0.01" value="" id="EpaisseurD" name="EpaisseurD"
                               required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurC">Epais
                            Centre (mm)</label>
                        <input class="form-control" type="number" step="0.01" value="" id="EpaisseurC" name="EpaisseurC"
                               required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="EpaisseurF">Epais
                            Fin (mm)</label>
                        <input class="form-control" type="number" step="0.01" value="" id="EpaisseurF" name="EpaisseurF"
                               required>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="ChutesT">Chutes
                            Tete (mm)</label>
                        <input class="form-control" type="number" step="0.01" value="" id="ChutesT" name="ChutesT"
                               required></div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label" for="ChutesQ">Chutes
                            Queue (mm)</label>
                        <input class="form-control" type="number" step="0.01" value="" id="ChutesQ" name="ChutesQ"
                               required></div>

                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="DDB" name="DDB"
                        >&nbsp;
                        <label class="form-check-label" for="DDB">DDB</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="DDB_R" name="DDB_R"
                        >&nbsp;
                        <label class="form-check-label" for="DDB_R">DDB/R</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="FT" name="FT"
                        >&nbsp;
                        <label class="form-check-label" for="FT">FT</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="GB_MB" name="GB_MB">&nbsp;
                        <label class="form-check-label" for="GB_MB">GB/MB</label>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-3  col-sm-6 inputs form-check"
                         style="margin-top:20px; font-size: 20px">
                        <input type="checkbox" class="form-check-input" id="Test1" name="Test1"
                        >&nbsp;
                        <label class="form-check-label" for="Test1">Test (1)</label>
                    </div>

                    <div class=" col-lg-6 col-md-12 col-sm-6 inputs row "
                         style="margin-top:20px; font-size: 18px">
                        <label class="col-xl-3 col-lg-4 col-sm-12" for="observation">Observation</label>
                        <input class="col-xl-9 col-lg-8 col-sm-12 form-control" type="text" id="observation"
                               name="observation">
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#BobineBackdrop" id="NvBobine"><b>
                                Nouvelle Bobine</b>
                        </button>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6  col-6">
                        <button type="button" id="NonRecBob" class="btn btn-warning">Bobine Non Réceptionné</button>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6  ">
                        <button type="reset" id="annulerButton" class="btn btn-secondary"> Annuler</button>
                    </div>


                    <div class="col-lg-3 col-md-4 col-sm-6   ">
                        <button type="submit" id="ajouter" class="btn btn-success">Ajouter</button>
                    </div>


                </div>


            </form>
            <br>
            <div class="table-container">
                <table id="MsTable" class="table table-striped table-hover table-borderless Mss " style="max-width:120%">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th rowspan="2">Coulee</th>
                        <th rowspan="2">Bobine</th>
                        <th rowspan="2">Poids</th>
                        <th colspan="2"> Largeur</th>
                        <th colspan="3"> Epaisseur</th>
                        <th colspan="5"> Defaut Metal</th>
                        <th colspan="2"> Chutes</th>
                        <th rowspan="2">Observation</th>

                    </tr>
                    <tr>
                        <th>Deb</th>
                        <th>Fin</th>
                        <th>Debut</th>
                        <th>Centre</th>
                        <th>Fin</th>
                        <th>DDB</th>
                        <th>DDB/R</th>
                        <th>FT</th>
                        <th>GB/MB</th>
                        <th>Test1</th>
                        <th>Tete</th>
                        <th>Queue</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($M3s))
                        @foreach($M3s as $item)
                            <tr id="Ms{{$item->Id}}">
                                <td id="Coulee{{$item->Id}}">{{$item->Bobine->Coulee}}</td>
                                <td id="Bobine{{$item->Id}}">{{$item->Bobine->Bobine}}</td>
                                <td id="Poids{{$item->Id}}">{{$item->Bobine->Poids}}</td>
                                <td id="LargeurD{{$item->Id}}">{{$item->LargeurD}}</td>
                                <td id="LargeurF{{$item->Id}}">{{$item->LargeurF}}</td>
                                <td id="EpaisseurD{{$item->Id}}">{{$item->EpaisseurD}}</td>
                                <td id="EpaisseurC{{$item->Id}}">{{$item->EpaisseurC}}</td>
                                <td id="EpaisseurF{{$item->Id}}">{{$item->EpaisseurF}}</td>
                                <td id="DDB{{$item->Id}}"><input type="checkbox" @if($item->DDB) checked
                                                                 @endif onclick="return false;"></td>
                                <td id="DDB_R{{$item->Id}}"><input type="checkbox" @if($item->DDB_R) checked
                                                                   @endif onclick="return false;"></td>
                                <td id="FT{{$item->Id}}"><input type="checkbox" @if($item->FT) checked
                                                                @endif onclick="return false;"></td>
                                <td id="GB_MB{{$item->Id}}"><input type="checkbox" @if($item->GB_MB) checked
                                                                   @endif onclick="return false;"></td>
                                <td id="Test_{{$item->Id}}"><input type="checkbox" @if($item->Test1) checked
                                                                   @endif onclick="return false;"></td>
                                <td id="ChutesT{{$item->Id}}">{{$item->ChutesT}}</td>
                                <td id="ChutesQ{{$item->Id}}">{{$item->ChutesQ}}</td>
                                <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                <td>
                                    <button id="Ms{{$item->Id}}Edit" class="MsEdit text-primary"><i
                                                class="fa fa-edit"></i></button>
                                    <button id="Ms{{$item->Id}}Delete" class="MsDelete text-danger"><i
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
            <div class="row">
                <div class="col-lg-6 col-sm-12 inputs row " style="margin-top:10px; font-size: 18px">
                    <label class="col-xl-4 col-lg-4 col-sm-12" for="obsRap">Observation</label>
                    <textarea class="col-xl-8 col-lg-8 col-sm-12 form-control" type="text" id="obsRap"
                              name="obsRap">
                    </textarea>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-4">
                    <form method="post" action="{{route('rapports_M3.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-4">
                    <button id="cloturer" class="btn btn-success">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer</b>
                    </button>
                </div>
            </div>
        </section>
    </div>
    <!-- Nouvelle Bobine Modal -->
    <div class="modal fade" id="BobineBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="BobineModal">
            <form id="BobineForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ajout Bobine</h5>
                    <button onclick="$('#AnnulerBobine').trigger('click')" type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="BId" name="BId" value="">
                    <input name="BNumRap" type="hidden" id="BNumRap" value="{{$rapport->Numero}}">
                    <input name="Pid" type="hidden" id="BPid" value="{{$rapport->Pid}}">
                    <input name="Did" type="hidden" id="BDid" value="{{$rapport->Did}}">
                    <div class="form-group row">
                        <label class="col-4" for="BArrivage">Arrivage</label>
                        <input class="col-6 form-control" name="BArrivage" id="BArrivage" type="number" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Bcoulee">Coulee</label>
                        <input class="col-6 form-control" name="Bcoulee" id="Bcoulee" type="number" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Bbobine">Bobine</label>
                        <input class="col-6 form-control" name="Bbobine" id="Bbobine" type="number" required>
                    </div>
                    <div class="input-group form-group row">
                        <label class="col-4" for="Bpoids">Poids Net</label>
                        <input name="Bpoids" id="Bpoids" type="number" class="col-5 form-control" min="1"
                               aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">KG</span>
                        </div>
                    </div>
                    <div class="input-group form-group row">
                        <label class="col-4" for="Bpoids_b">Poids Brut</label>
                        <input name="Bpoids_b" id="Bpoids_b" type="number" class="col-5 form-control" min="1"
                               aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">KG</span>
                        </div>
                    </div>
                    <div class="input-group form-group row">
                        <label class="col-4" for="BEpaisseur">Epaisseur</label>
                        <input name="BEpaisseur" id="BEpaisseur" type="number" class="col-5 form-control" min="1"
                               step="0.01"
                               aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">MM</span>
                        </div>
                    </div>
                    <div class="input-group form-group row">
                        <label class="col-4" for="BLargeurBande">Largeur Bande</label>
                        <input name="BLargeurBande" id="BLargeurBande" type="number" class="col-5 form-control"
                               min="500" max="2500"
                               aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">MM</span>
                        </div>
                    </div>
                    <br>

                    <div class="modal-footer">
                        <button id="AnnulerBobine" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler
                        </button>
                        <button id="AjouterBobine" type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('script')

    <script>

        $(document).ready(function () {
            var bobinesEtat = 'REC';
            $('#annulerButton').hide();
            addMssListeners();

            $('#ajouter').click(function (e) {
                if ($('#M3Form')[0].checkValidity()) {
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData = new FormData(document.getElementById('M3Form'));
                    e.preventDefault();
                    if ($('#ajouter').html() !== 'Modifier') {

                        $.ajax({
                            url: "{{ route('M3.store')}}",
                            method: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                var item = result.m3;
                                $('#MsTable').append('<tr id="Ms' + item.Id + '">\n' +
                                    '                                <td id="Coulee' + item.Id + '">' + item.CouleeT + '</td>\n' +
                                    '                                <td id="Bobine' + item.Id + '">' + item.BobineT + '</td>\n' +
                                    '                                <td id="Poids' + item.Id + '">' + item.PoidsT + '</td>\n' +
                                    '                                <td id="LargeurD' + item.Id + '">' + item.LargeurD + '</td>\n' +
                                    '                                <td id="LargeurF' + item.Id + '">' + item.LargeurF + '</td>\n' +
                                    '                                <td id="EpaisseurD' + item.Id + '">' + item.EpaisseurD + '</td>\n' +
                                    '                                <td id="EpaisseurC' + item.Id + '">' + item.EpaisseurC + '</td>\n' +
                                    '                                <td id="EpaisseurF' + item.Id + '">' + item.EpaisseurF + '</td>\n' +
                                    '                                <td id="DDB' + item.Id + '">' + '<input type="checkbox" ' + item.DDB_t + ' onclick="return false;"></td>' +
                                    '                                <td id="DDB_R' + item.Id + '">' + '<input type="checkbox" ' + item.DDB_R_t + ' onclick="return false;"></td>' +
                                    '                                <td id="FT' + item.Id + '">' + '<input type="checkbox" ' + item.FT_t + ' onclick="return false;"></td>' +
                                    '                                <td id="GB_MB' + item.Id + '">' + '<input type="checkbox" ' + item.GB_MB_t + ' onclick="return false;"></td>' +
                                    '                                <td id="Test_' + item.Id + '">' + '<input type="checkbox" ' + item.Test1_t + ' onclick="return false;"></td>' +
                                    '                                <td id="ChutesT' + item.Id + '">' + item.ChutesT + '</td>\n' +
                                    '                                <td id="ChutesQ' + item.Id + '">' + item.ChutesQ + '</td>\n' +
                                    '                                <td id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="Ms' + item.Id + 'Edit" class="MsEdit text-primary"><i\n' +
                                    '                                                class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="Ms' + item.Id + 'Delete" class="MsDelete text-danger"><i\n' +
                                    '                                                class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#bobines').html('');
                                $('#coulees').html('');
                                $('#bobine').attr('list','bobines');
                                $('#coulee').attr('list','coulees');
                                result.coulees.forEach(function (item, index) {
                                    $('#coulees').append('<option value="' + item.Coulee + '">' + item.Coulee + '</option>');
                                });
                                result.bobines.forEach(function (item, index) {
                                    $('#bobines').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                                });
                                $('#M3Form').trigger('reset');
                                addMssListeners();
                                $('#bobine').prop("disabled", false);
                                $('#coulee').prop("disabled", false);
                                $('#FT').prop('checked', false);
                                $('#DDB').prop('checked', false);
                                $('#DDB_R').prop('checked', false);
                                $('#Test1').prop('checked', false);
                                $('#GB_MB').prop('checked', false);
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.s('tube_pid_did_machine_numtube_unique')) {
                                        alert('Le tube n°=' + $('#machine').val() + ntube + ' existe dejà');
                                    } else {
                                        alert(result.responseJSON.message);
                                        console.log(result);
                                    }
                                } else {
                                    alert(result.responseJSON.error);

                                }
                            }
                        });
                    } else {
                        formData.append('_method', 'put');
                        $.ajax({
                            url: "{{ url('/M3/')}}/" + id,
                            method: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                console.log(result);
                                var item = result.m3;
                                $('#Ms' + id).replaceWith('<tr id="Ms' + item.Id + '">\n' +
                                    '                                <td id="Coulee' + item.Id + '">' + item.CouleeT + '</td>\n' +
                                    '                                <td id="Bobine' + item.Id + '">' + item.BobineT + '</td>\n' +
                                    '                                <td id="Poids' + item.Id + '">' + item.PoidsT + '</td>\n' +
                                    '                                <td id="LargeurD' + item.Id + '">' + item.LargeurD + '</td>\n' +
                                    '                                <td id="LargeurF' + item.Id + '">' + item.LargeurF + '</td>\n' +
                                    '                                <td id="EpaisseurD' + item.Id + '">' + item.EpaisseurD + '</td>\n' +
                                    '                                <td id="EpaisseurC' + item.Id + '">' + item.EpaisseurC + '</td>\n' +
                                    '                                <td id="EpaisseurF' + item.Id + '">' + item.EpaisseurF + '</td>\n' +
                                    '                                <td id="DDB' + item.Id + '">' + '<input type="checkbox" ' + item.DDB_t + ' onclick="return false;">' +
                                    '                                <td id="DDB_R' + item.Id + '">' + '<input type="checkbox" ' + item.DDB_R_t + ' onclick="return false;">' +
                                    '                                <td id="FT' + item.Id + '">' + '<input type="checkbox" ' + item.FT_t + ' onclick="return false;">' +
                                    '                                <td id="GB_MB' + item.Id + '">' + '<input type="checkbox" ' + item.GB_MB_t + ' onclick="return false;">' +
                                    '                                <td id="Test_' + item.Id + '">' + '<input type="checkbox" ' + item.Test1_t + ' onclick="return false;">' +
                                    '                                <td id="ChutesT' + item.Id + '">' + item.ChutesT + '</td>\n' +
                                    '                                <td id="ChutesQ' + item.Id + '">' + item.ChutesQ + '</td>\n' +
                                    '                                <td id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="Ms' + item.Id + 'Edit" class="MsEdit text-primary"><i\n' +
                                    '                                                class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="Ms' + item.Id + 'Delete" class="MsDelete text-danger"><i\n' +
                                    '                                                class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#M3Form').trigger('reset');
                                $('#FT').prop('checked', false);
                                $('#DDB').prop('checked', false);
                                $('#DDB_R').prop('checked', false);
                                $('#Test1').prop('checked', false);
                                $('#GB_MB').prop('checked', false);
                                $('#ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#bobine').prop("disabled", false);
                                $('#coulee').prop("disabled", false);
                                addMssListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });


                    }
                } else {
                    alert(' Remplir tous les champs qui sont Obligatoires ');
                }
            });
            $('#annulerButton').click(function () {
                $('#M3Form').trigger('reset');
                $('#ajouter').html(' Ajouter ');
                $('#FT').prop('checked', false);
                $('#DDB').prop('checked', false);
                $('#DDB_R').prop('checked', false);
                $('#Test1').prop('checked', false);
                $('#GB_MB').prop('checked', false);
                $('#bobine').prop("disabled", false);
                $('#coulee').prop("disabled", false);
                ;
                $('#annulerButton').hide();
            });

            function addMssListeners() {
                $('.MsDelete').each(function (e) {
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
                            url: "{{url('/M3/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                $('#bobines').html('');
                                $('#coulees').html('');
                                result.coulees.forEach(function (item, index) {
                                    $('#coulees').append('<option value="' + item.Coulee + '">' + item.Coulee + '</option>');
                                });
                                result.bobines.forEach(function (item, index) {
                                    $('#bobines').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                                });
                                $('#M3Form').trigger('reset');
                                $('#bobine').prop("disabled", false);
                                $('#coulee').prop("disabled", false);

                                $('#FT').prop('checked', false);
                                $('#DDB').prop('checked', false);
                                $('#DDB_R').prop('checked', false);
                                $('#Test1').prop('checked', false);
                                $('#GB_MB').prop('checked', false);
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.MsEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {

                        e.preventDefault();
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#bobine').val($('#Bobine' + id).html()).prop("disabled", true);
                        $('#coulee').val($('#Coulee' + id).html()).prop("disabled", true);
                        $('#Poids').val($('#Poids' + id).html());
                        $('#LargeurD').val($('#LargeurD' + id).html());
                        $('#LargeurF').val($('#LargeurF' + id).html());
                        $('#EpaisseurD').val($('#EpaisseurD' + id).html());
                        $('#EpaisseurC').val($('#EpaisseurC' + id).html());
                        $('#EpaisseurF').val($('#EpaisseurF' + id).html());
                        $('#ChutesT').val($('#ChutesT' + id).html());
                        $('#ChutesQ').val($('#ChutesQ' + id).html());
                        $('#observation').val($('#Observation' + id).html());
                        $('#DDB').prop('checked', ($('#DDB' + id).find('input[checked]').length > 0));
                        $('#DDB_R').prop('checked', ($('#DDB_R' + id).find('input[checked]').length > 0));
                        $('#FT').prop('checked', ($('#FT' + id).find('input[checked]').length > 0));
                        $('#GB_MB').prop('checked', ($('#GB_MB' + id).find('input[checked]').length > 0));
                        $('#Test1').prop('checked', ($('#Test_' + id).find('input[checked]').length > 0));
                        $('#Numero').val(id);
                        $('#ajouter').html('Modifier');
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
                        _token: '{{csrf_token()}}',
                        observation: $('#obsRap').val(),
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                            window.location.href = '{{route("rapports_M3.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);
                        console.log(result)

                    }
                });
            });


            $('#bobine').keydown(function () {
                if ($(this).val() === "") {
                    $(this).attr('list', "bobines");
                }
            });
            $('#coulee').keydown(function () {
                if ($(this).val() === "") {
                    $(this).attr('list', "coulees");
                }
            });
            $('#bobine').on('change', function () {
                if ($(this).val() !== "") {

                    const bobine = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{url('/couleeGet')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            bobine: bobine,
                            source: 'M3',
                            etat: bobinesEtat
                        },
                        success: function (result) {
                            console.log(result);
                            if (result.coulee != null) {

                                var coulee = result.coulee;
                                $('#coulee').val(coulee.Coulee);
                                $('#Poids').val(coulee.Poids);
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.error);
                            console.log(result);
                            if (result.responseJSON.error === "Bobine n'existe pas") {
                                $('#coulee').val('');
                                $('#Poids').val('');
                                $('#bobine').val('');
                            }
                        }
                    });
                }
            });
            $('#coulee').on('change', function () {
                const coulee = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/bobineGet')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        coulee: coulee,
                        source: 'M3',
                        etat: bobinesEtat
                    },
                    success: function (result) {
                        if (result.bobines.length !== 0) {
                            var bobines = result.bobines;

                            $('#bobines2').html("");
                            bobines.forEach(function (item, index) {
                                $('#bobines2').append('<option  value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                $('#bobine').attr('list', 'bobines2');
                            });
                        } else {
                            alert("Coulee n'existe pas");
                            $('#coulee').val('');
                            $('#Poids').val('');
                            $('#bobine').val('');
                        }
                    },
                    error: function (result) {
                        alert(result.responseJSON.error);
                        console.log(result);
                    }
                });
            });
            $('#AjouterBobine').click(function (e) {

                if ($('#BobineForm')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('bobine')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            bobine: $('#Bbobine').val(),
                            coulee: $('#Bcoulee').val(),
                            poids: $('#Bpoids').val(),
                            poids_b: $('#Bpoids_b').val(),
                            epaisseur: $('#BEpaisseur').val(),
                            arrivage: $('#BArrivage').val(),
                            largeur_bande: $('#BLargeurBande').val(),
                            Did: $('#BDid').val(),
                            Pid: $('#BPid').val(),
                            NumRap: $('#BNumRap').val(),
                            source: "M3"
                        },
                        success: function (result) {
                            var item = result.bobine;
                            $('#bobines').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                            $('#coulees').append('<option value="' + item.Coulee + '">' + item.Coulee + '</option>');
                            $('.modal').modal('hide');
                            $('.modal').on('hidden.bs.modal', function (e) {
                                $(this).removeData();

                            });
                            $("#BArrivage").val("");
                            $("#Bbobine").val("");
                            $("#Bcoulee").val("");
                            $("#Bpoids").val("");
                            $("#Bpoids_b").val("");
                            $("#BEpaisseur").val("");
                            $("#BLargeurBande").val("");
                        },
                        error: function (result) {
                            if (typeof result.responseJSON.message != 'undefined') {
                                if (result.responseJSON.message.s('bobine_coulee_bobine_unique')) {
                                    alert('La bobine ' + $('#Bbobine').val() + ' existe déjà');
                                } else {

                                    alert(result.responseJSON.message);
                                    console.log(result);

                                }
                            }
                        }
                    });

                } else {
                    alert('Remplir tous les champs qui sont obligatoires svp!');
                }
            });
            $('#NonRecBob').click(function () {
                $('#Poids').val('');
                $('#coulee').val('');
                $('#bobine').val('');
                bobinesEtat = 'NonREC';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var did = $('#Did').val();
                $.ajax({
                    url: "{{url('/M3/')}}/" + did + '/edit',
                    method: 'get',
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (result) {
                        if (result.bobines.length !== 0) {
                            var bobines = result.bobines;
                            $('#bobines2').html("");
                            bobines.forEach(function (item, index) {

                                $('#bobines2').append('<option  value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                $('#bobine').attr('list', 'bobines2');
                            });
                            var coulees = result.coulees;
                            $('#coulees2').html("");
                            coulees.forEach(function (item, index) {

                                $('#coulees2').append('<option  value="' + item.Coulee + '" >' + item.Coulee + '</option>');
                                $('#coulee').attr('list', 'coulees2');
                            });

                        } else {
                            alert("Pas de bobines Non réceptionnées dans ce Détail Projet");
                            bobinesEtat = 'REC';
                        }
                    },
                    error: function (result) {
                        alert(result.responseJSON.error);
                        console.log(result);
                    }
                });
            });
        });


    </script>
@endsection
