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

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .table td {
            padding: 0 3px;
            vertical-align: middle !important;
            text-align: center;

        }

        .inputs td {
            width: 33%;
        }

        .table {
            color: #000;
            table-layout: fixed;
            width: 100%;
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

        .rapprods {
            table-layout: auto;
            width: 100%;
        }

        .rapprods td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        table button, table i.fa {
            font-size: 20px;
            border: none;
            background-color: rgba(0, 0, 0, 0);
        }

        .form-control {
            padding: 5px;
            text-align: center;
        }

        .inputs {
            margin-top: 10px;
            text-align: center;
        }

        .inputs label {
            font-weight: bold;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container">
        <section>
            <div class="tab-pane fade show active" id="rapport" role="tabpanel" aria-labelledby="home-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active  text-dark " id="rapport-tab" data-toggle="tab" href="#rapport"
                           role="tab"
                           aria-controls="rapport" aria-selected="true">Rapport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rapport-tab"
                           href="{{route('arret_machine.show', ['id'=>$rapport->Numero])}}"
                           aria-selected="false">Arrets Machine</a>
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
                        <div class="row">Machine: &nbsp; <span class="valeur" id="machine">{{$rapport->Machine}}</span>
                        </div>
                    </div>

                </div>
                <div class="tab-content" id="myTabContent">
                    <hr>
                    <form id="rapprodForm" autocomplete="off">
                        <div class="row">
                            <input name="Numero" type="hidden" id="Numero" value=" ">
                            <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                            <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                            <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs">
                                <label class="form-label" for="coulee">Coulee</label>
                                <input class="form-control" list="coulees" id="coulee" type="number" name="coulee"
                                       required>
                                <datalist id="coulees">
                                    @if(isset($coulees))
                                        @foreach($coulees as $coulee)
                                            <option value="{{$coulee->Coulee}}">{{$coulee->Coulee}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6  inputs">
                                <label class="form-label" for="bobine">Bobine</label>
                                <input class="form-control" list="bobines" id="bobine" type="number" name="bobine"
                                       required>
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

                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-6 inputs"><label class="form-label"
                                                                                           for="ntube">N°Tube</label>
                                <input class="form-control" type="number" min="0001" max="9999" value="" maxlength="4"
                                       minlength="4" id="ntube" oninput="validity.valid||(value='');" name="ntube"
                                       required>
                            </div>
                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-6 inputs"><label for="longueur">
                                    Langueur </label>
                                <input class="form-control" type="number" min="7000" max="20000"
                                       id="longueur" required name="longueur">
                            </div>
                            <div class="col-xl-1 col-lg-2 col-md-2  col-sm-6 inputs form-check"
                                 style="margin-top:40px; font-size: 20px">
                                <input class="form-check-input" style="width:20px; height: 20px;" type="checkbox"
                                       id="Macro" name="Macro">
                                <label style="    margin-left: 10px;" class="form-check-label" for="Macro">Macro</label>
                            </div>
                            <div class="col-xl-1 col-lg-2 col-md-2  col-sm-6 inputs form-check"
                                 style="margin-top:40px; font-size: 20px">
                                <input class="form-check-input" style="width:20px; height: 20px;" type="checkbox"
                                       id="RB" name="RB">
                                <label style="    margin-left: 10px;" class="form-check-label" for="RB">RB</label>
                            </div>

                            <div class="col-xl-4 col-lg-5 col-md-6  col-12 inputs"><label class="form-label"
                                                                                          for="agent">OBSERVATIONS</label>
                                <table style="    width: 100%;">
                                    <tr>
                                        <td>
                                            <div class="form-check" style="margin-bottom: .5rem;">
                                                <input class="form-check-input" type="checkbox" id="sur_mas"
                                                       name="sur_mas">
                                                <label class="form-check-label" for="sur_mas">Sur Mas</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="test_1"
                                                       name="test_1">
                                                <label for="test_1">Test (1)</label>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="test_3"
                                                       name="test_3">
                                                <label for="test_3">Test (3)</label>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-xl-2 col-sm-6 offset-xl-7  ">
                                <button type="reset" id="annulerButton" class="btn btn-secondary"> Annuler</button>
                            </div>


                            <div class="col-xl-3 col-sm-6   ">
                                <button type="submit" id="ajouterRapprod" class="btn btn-success">Ajouter tube</button>
                            </div>


                        </div>


                    </form>
                    <br>
                    <div class="table-container">
                        <table id="rapprodsTable" class="table table-striped table-hover table-borderless rapprods ">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Coulee</th>
                                <th>Bobine</th>
                                <th>Tube</th>
                                <th>Langueur</th>
                                <th>Macro</th>
                                <th>RB</th>
                                <th>Observation</th>

                            </tr>
                            </thead>
                            <tbody id="rapprods">
                            @if(isset($rapprods))
                                @foreach($rapprods as $rapprod)
                                    <tr id="rapprod{{$rapprod->Numero}}">
                                        <td id="coulee{{$rapprod->Numero}}">{{$rapprod->Coulee}}</td>
                                        <td id="bobine{{$rapprod->Numero}}">{{$rapprod->Bobine}}</td>
                                        <td id="tube{{$rapprod->Numero}}">{{$rapprod->Ntube}}</td>
                                        <td id="longueur{{$rapprod->Numero}}">{{$rapprod->Longueur}}</td>
                                        <td><input id="macro{{$rapprod->Numero}}" type="checkbox"
                                                   @if($rapprod->Macro) checked @endif
                                                   onclick="return false;"></td>
                                        <td><input id="rb{{$rapprod->Numero}}" type="checkbox" @if($rapprod->RB) checked
                                                   @endif
                                                   onclick="return false;"></td>
                                        <td id="observation{{$rapprod->Numero}}">{{$rapprod->Observation}}</td>
                                        <td>
                                            <button id="rapprod{{$rapprod->Numero}}Edit"
                                                    class="rapprodEdit text-primary"><i
                                                        class="fa fa-edit"></i></button>
                                            <button id="rapprod{{$rapprod->Numero}}Delete"
                                                    class="rapprodDelete text-danger"><i
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
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="offset-xl-9 offset-md-7 col-xl-3  col-md-5 col-sm-6" style="margin-top:10px">
                    <form method="post" action="{{route('rapports.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary" style="width:100%">
                            <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter Le
                                Rapport</b>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section>
            <div class="row ">
                <div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">
                    <div class="row ">
                        <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                        <div class="col-10">
                            <h1>Project : {{$projet->Nom}}</h1>
                            <h5>Client: {{$projet->client->name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--<section>--}}
        {{--<div class="row">--}}
        {{--<div class=" col-lg-3 col-md-4 col-sm-4"><a--}}
        {{--href="{{route('arret_machine.show', ['id'=>$rapport->Numero])}}" role="button">--}}
        {{--<button class="btn btn-outline-danger "><b><i class="fa fa-exclamation-triangle"--}}
        {{--style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets--}}
        {{--Machine</b></button>--}}
        {{--</a>--}}
        {{--</div>--}}

        {{--<div class=" col-lg-3 col-md-6 col-sm-12">--}}
        {{--<button type="button" id="imprimer" class="btn btn-outline-primary col-12">--}}
        {{--<b><i class="fa fa-print" style="font-size: 20px;"></i> &nbsp;&nbsp;Imprimer</b>--}}
        {{--</button>--}}
        {{--</div>--}}
        {{--<div class=" col-lg-3  col-md-4 col-sm-4">--}}
        {{--<form method="post" action="{{route('rapports.destroy',["id"=>$rapport->Numero])}}">--}}
        {{--@csrf--}}
        {{--<input type="hidden" name="_method" value="delete">--}}
        {{--<button class="btn btn-secondary">--}}
        {{--<b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter</b>--}}
        {{--</button>--}}
        {{--</form>--}}
        {{--</div>--}}
        {{--<div class=" col-lg-3 col-md-4 col-sm-4">--}}
        {{--<button id="cloturer" class="btn btn-success">--}}
        {{--<b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer</b>--}}
        {{--</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</section>--}}
    </div>


@endsection
@section('script')

    <script>

        $(document).ready(function () {
            addRapprodsListeners();
            $('#ntube').focusout(function () {
                var ntube = $('#ntube').val();
                if (ntube.length === 3) {
                    ntube = '0' + ntube;
                } else if (ntube.length === 2) {
                    ntube = '00' + ntube;
                } else if (ntube.length === 1) {
                    ntube = '000' + ntube;
                }
                $('#ntube').val(ntube);
            });
            $('#annulerButton').hide();

            $('#ajouterRapprod').click(function (e) {
                if ($('#rapprodForm')[0].checkValidity()) {
                    ntube = $('#ntube').val();
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    if ($('#ajouterRapprod').html() !== ' Modifier tube ') {

                        $.ajax({
                            url: "{{ route('rapprod.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Pid: $('#Pid').val(),
                                Did: $('#Did').val(),
                                machine: $('#machine').html(),
                                NumeroRap: $('#NumRap').val(),
                                bobine: $('#bobine').val(),
                                coulee: $('#coulee').val(),
                                ntube: ntube,
                                longueur: $('#longueur').val(),
                                rb: $('#RB:checked').length > 0,
                                macro: $('#Macro:checked').length > 0,
                                sur_mas: $('#sur_mas:checked').length > 0,
                                test_1: $('#test_1:checked').length > 0,
                                test_3: $('#test_3:checked').length > 0
                            },
                            success: function (result) {

                                $('#rapprods').append('<tr id="rapprod' + result.rapprod.Numero + '">' +
                                    '                        <td id="coulee' + result.rapprod.Numero + '">' + result.rapprod.Coulee + '</td> ' +
                                    '                        <td id="bobine' + result.rapprod.Numero + '">' + result.rapprod.Bobine + '</td> ' +
                                    '                        <td id="tube' + result.rapprod.Numero + '">' + result.rapprod.Ntube + '</td>' +
                                    '                        <td id="longueur' + result.rapprod.Numero + '">' + result.rapprod.Longueur + '</td>' +
                                    '                        <td >' + '<input id="macro' + result.rapprod.Numero + '" type="checkbox" ' + result.rapprod.Macro_t + ' onclick="return false;">' +
                                    '                        <td >' + '<input id="rb' + result.rapprod.Numero + '" type="checkbox" ' + result.rapprod.RB_t + ' onclick="return false;">' +
                                    '                        <td id="observation' + result.rapprod.Numero + '">' + result.rapprod.Observation + '</td>' +
                                    '                        <td><button id="rapprod' + result.rapprod.Numero + 'Edit" class="rapprodEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="rapprod' + result.rapprod.Numero + 'Delete" class="rapprodDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');
                                addRapprodsListeners();
                                $('#bobine').val(result.rapprod.Bobine);
                                $('#coulee').val(result.rapprod.Coulee);
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('tube_pid_did_machine_numtube_unique')) {
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

                        $.ajax({
                            url: "{{ url('/rapprod/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                longueur: $('#longueur').val(),
                                rb: $('#RB:checked').length > 0,
                                macro: $('#Macro:checked').length > 0,
                                sur_mas: $('#sur_mas:checked').length > 0,
                                test_1: $('#test_1:checked').length > 0,
                                test_3: $('#test_3:checked').length > 0
                            },
                            success: function (result) {

                                $('#rapprod' + result.rapprod.Numero).replaceWith('<tr id="rapprod' + result.rapprod.Numero + '">' +
                                    '                        <td id="coulee' + result.rapprod.Numero + '">' + result.rapprod.Coulee + '</td> ' +
                                    '                        <td id="bobine' + result.rapprod.Numero + '">' + result.rapprod.Bobine + '</td> ' +
                                    '                        <td id="tube' + result.rapprod.Numero + '">' + result.rapprod.Ntube + '</td>' +
                                    '                        <td id="longueur' + result.rapprod.Numero + '">' + result.rapprod.Longueur + '</td>' +
                                    '                        <td >' + '<input id="macro' + result.rapprod.Numero + '" type="checkbox" ' + result.rapprod.Macro_t + ' onclick="return false;">' +
                                    '                        <td >' + '<input id="rb' + result.rapprod.Numero + '" type="checkbox" ' + result.rapprod.RB_t + ' onclick="return false;">' +
                                    '                        <td id="observation' + result.rapprod.Numero + '">' + result.rapprod.Observation + '</td>' +
                                    '                        <td><button id="rapprod' + result.rapprod.Numero + 'Edit" class="rapprodEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                    '                            <button id="rapprod' + result.rapprod.Numero + 'Delete" class="rapprodDelete text-danger" ><i class="fa fa-trash"></i></button>' +
                                    '                             </td>' +
                                    '                    </tr>');
                                $('#ajouterRapprod').html(' Ajouter Tube ');
                                $('#annulerButton').hide();
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });


                    }
                } else {

                }
            });
            $('#annulerButton').click(function () {

                refreshData();
                getLatestTube($('#machine').html());
            });

            function addRapprodsListeners() {
                refreshData();
                getLatestTube($('#machine').html());
                $('.rapprodDelete').each(function (e) {
                    refreshData();
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
                            url: "{{url('/rapprod/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                refreshData();
                                getLatestTube($('#machine').html());
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.rapprodEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {

                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#ntube').prop('disabled', true);
                        $('#bobine').prop('disabled', true);
                        $('#coulee').prop('disabled', true);
                        $('#ntube').val($('#tube' + id).html());
                        $('#coulee').val($('#coulee' + id).html());
                        $('#bobine').val($('#bobine' + id).html());
                        $('#longueur').val($('#longueur' + id).html());
                        $('#Macro').prop("checked", $('#macro' + id + ':checked').length > 0);
                        $('#RB').prop("checked", $('#rb' + id + ':checked').length > 0);
                        $('#sur_mas').prop("checked", $('#observation' + id).html().includes('Sur Mas'));
                        $('#test_1').prop("checked", $('#observation' + id).html().includes('Test (1)'));
                        $('#test_3').prop("checked", $('#observation' + id).html().includes('Test (3)'));
                        $('#Numero').val(id);
                        $('#ajouterRapprod').html(' Modifier tube ');
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
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                            window.location.href = '{{route("rapports.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);
                        console.log(result)

                    }
                });
            });

            function getLatestTube(machine) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/dernierTube/')}}/" + machine + "/?Did=" + $('#Did').val(),
                    method: 'get',
                    data: {},
                    success: function (result) {
                        if (typeof result.dernierTubetab !== 'undefined') {

                            ntube = parseInt(result.dernierTubetab.Tube.replace(/[^0-9]/g, '')) + 1;
                            ntube = ntube + '';
                            if (ntube.length === 3) {
                                ntube = '0' + ntube;
                            } else if (ntube.length === 2) {
                                ntube = '00' + ntube;
                            } else if (ntube.length === 1) {
                                ntube = '000' + ntube;
                            }
                        } else {
                            ntube = '0001';
                        }
                        $('#ntube').val(ntube);
                    },
                    error: function (result) {
                        console.log(result);
                        if (result.responseJSON.message.includes("Tube N'existe Pas")) {
                            $('#ntube').val('0001');
                        } else {
                            alert(result.responseJSON.message);
                            console.log(result)
                        }
                    }
                });

            }

            function refreshData() {
                $('#ntube').prop('disabled', false);
                $('#bobine').prop('disabled', false);
                $('#coulee').prop('disabled', false);
                $('#rapprodForm').trigger('reset');
                $('#ajouterRapprod').html(' Ajouter tube ');
                $('#annulerButton').hide();

            }


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
                            machine: $('#machine').html(),
                            Did: $('#Did').val(),
                        },
                        success: function (result) {
                            console.log(result);
                            if (result.coulee != null) {

                                var coulee = result.coulee;
                                $('#coulee').val(coulee.Coulee);
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.error);
                            console.log(result);
                            if (result.responseJSON.error === "Bobine n'existe pas") {
                                $('#coulee').val('');
                                $('#bobine').val('');
                            }
                        }
                    });
                }
            });
            $('#coulee').on('change', function () {
                if ($(this).val() !== "") {
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
                            machine: $('#machine').html(),
                            Did: $('#Did').val(),
                        },
                        success: function (result) {
                            if (result.bobines.length !== 0) {
                                var bobines = result.bobines;
                                bobines.forEach(function (item, index) {
                                    $('#bobines2').html("");
                                    $('#bobines2').append('<option  value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                    $('#bobine').attr('list', 'bobines2');
                                });
                            } else {
                                alert("Coulee n'existe pas");
                                $('#coulee').val('');
                                $('#bobine').val('');
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.error);
                            console.log(result);
                        }
                    });
                }
            });

        });


    </script>
@endsection
