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
            width: 20%;
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
    <div class="container-fluid">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <section>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" id="profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="profile"
                               aria-selected="false">Rapport De Réception</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="home-tab"
                               href="{{route("ContBobine.show",$rapport->Numero)}}"
                               aria-selected="true">Bobines Non Réceptionnées</a>
                        </li>

                    </ul>
                    <br>
                    <form id="RecBobForm" autocomplete="off">

                        <div class="row">
                            @csrf()
                            <input name="Numero" type="hidden" id="Numero" value=" ">
                            <input name="Pid" type="hidden" id="Pid" value="{{$rapport->Pid}}">
                            <input name="Did" type="hidden" id="Did" value="{{$rapport->Did}}">
                            <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="Arrivage">Arrivage</label>
                                <input class="form-control" type="number" value="{{$maxArr}}" id="Arrivage"
                                       name="Arrivage" min="1" disabled></div>

                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6  inputs">
                                <label class="form-label" for="bobine">Bobine</label>

                                <input class="form-control" list="bobines" id="bobine" name="bobine" required>
                                <datalist id="bobines">
                                    @if(isset($bobines))


                                        @foreach($bobines as $bobine)
                                            <option
                                                    value="{{$bobine->Bobine}}">{{$bobine->Bobine}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                                <datalist id="bobines2">
                                </datalist>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs">
                                <label class="form-label" for="coulee">Coulee</label>
                                <input class="form-control" list="coulees" id="coulee" name="coulee" required>
                                <datalist id="coulees">
                                    @if(isset($coulees))

                                        @foreach($coulees as $coulee)
                                            <option
                                                    value="{{$coulee->Coulee}}">{{$coulee->Coulee}}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                                <datalist id="coulees2">
                                </datalist>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="Poids">Poids</label>
                                <input class="form-control" type="number" id="Poids" name="Poids" min="13000"
                                       max="45000"
                                       disabled></div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="Epaisseur">Epaisseur</label>
                                <input class="form-control" type="number" value="" id="Epaisseur" name="Epaisseur"
                                       disabled>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="Fournisseur">Fournisseur</label>
                                <select class="form-control" id="Fournisseur" name="Fournisseur">
                                    <option value="ARCELOR">ARCELOR</option>
                                    <option value="THYSSEN">THYSSEN</option>
                                    <option value="SEVERSTAL">SEVERSTAL</option>
                                </select>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="NbReception">N°Reception</label>
                                <input class="form-control" type="number" value="{{$maxRec}}" id="NbReception"
                                       name="NbReception" min="1"
                                       oninput="validity.valid||(value='');" required></div>

                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="DateRec">Date
                                    Reception </label>
                                @php
                                    $date=new DateTime();
                                    $date->sub(new DateInterval('P3D'));
                                    $minDate=$date->format('Y-m-d');
                                @endphp
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="DateRec"
                                       name="DateRec" required max="{{date("Y-m-d") }}" min="{{$minDate}}"
                                       required>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="Source">Provenance</label>
                                <select class="form-control" id="Source" name="Source" required>
                                    <option value="Ann">Annaba</option>
                                    <option value="Port">Port</option>
                                    <option value="Toug">Touggourt</option>
                                </select>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 inputs"><label class="form-label"
                                                                                           for="NbBon">N°Bon</label>
                                <input class="form-control" type="number" value="" oninput="validity.valid||(value='');"
                                       id="NbBon" name="NbBon" required min="1">
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6 offset-lg-7 offset-md-4 ">
                                <button type="reset" id="annulerButton" class="btn btn-secondary"> Annuler</button>
                            </div>


                            <div class="col-lg-3 col-md-4 col-sm-6   ">
                                <button type="submit" id="ajouter" class="btn btn-success">Ajouter</button>
                            </div>


                        </div>


                    </form>
                    <br>
                    <div class="table-container">
                        <table id="RecBobTable" class="table table-striped table-hover table-borderless rapprods ">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Arrivage</th>
                                <th>Coulee</th>
                                <th>Bobine</th>
                                <th>Poids</th>
                                <th>Epaisseur</th>
                                <th>Fournisseur</th>
                                <th>N°Reception</th>
                                <th>Date Reception</th>
                                <th>Provenance</th>
                                <th>N°Bon</th>

                            </tr>
                            </thead>
                            <tbody id="RecBobs">
                            @if(isset($RecBob))
                                @foreach($RecBob as $item)
                                    <tr id="RecBob{{$item->Id}}">
                                        <td id="Arrivage{{$item->Id}}">{{$item->Arrivage}}</td>
                                        <td id="Coulee{{$item->Id}}">{{$item->Coulee}}</td>
                                        <td id="Bobine{{$item->Id}}">{{$item->Bobine}}</td>
                                        <td id="Poids{{$item->Id}}">{{$item->Poids}}</td>
                                        <td id="Epaisseur{{$item->Id}}">{{$item->Epaisseur}}</td>
                                        <td id="Fournisseur{{$item->Id}}">{{$item->Fournisseur}}</td>
                                        <td id="NbReception{{$item->Id}}">{{$item->NbReception}}</td>
                                        <td id="DateRec{{$item->Id}}">{{$item->DateRec}}</td>
                                        <td id="Source{{$item->Id}}">{{$item->Source}}</td>
                                        <td id="NbBon{{$item->Id}}">{{$item->NbBon}}</td>
                                        <td>
                                            <button id="RecBob{{$item->Id}}Edit" class="RecBobEdit text-primary"><i
                                                        class="fa fa-edit"></i></button>
                                            <button id="RecBob{{$item->Id}}Delete" class="RecBobDelete text-danger"><i
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
                            <label class="col-xl-4 col-lg-4 col-sm-12" for="observation">Observation</label>
                            <textarea class="col-xl-8 col-lg-8 col-sm-12 form-control" type="text" id="observation"
                                      style="text-align: left" name="observation">
                    </textarea>
                        </div>
                        <div class=" col-lg-3 col-md-4 col-sm-4">
                            <form method="post" action="{{route('rapports_RecBob.destroy',["id"=>$rapport->Numero])}}">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-secondary">
                                    <b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter</b>
                                </button>
                            </form>
                        </div>
                        <div class=" col-lg-3 col-md-4 col-sm-4">
                            <button id="cloturer" class="btn btn-success">
                                <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;
                                    Clôturer</b>
                            </button>
                        </div>
                    </div>
                </section>

            </div>
        </div>

    </div>


@endsection
@section('script')

    <script>

        $(document).ready(function () {

            $('#annulerButton').hide();
            addRapprodsListeners();
            $('#ajouter').click(function (e) {
                if ($('#RecBobForm')[0].checkValidity()) {
                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData = new FormData(document.getElementById('RecBobForm'));
                    e.preventDefault();
                    if ($('#ajouter').html() !== 'Modifier') {

                        $.ajax({
                            url: "{{ route('RecBob.store')}}",
                            method: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                item = result.RecBob;
                                $('#RecBobTable').append(' <tr id="RecBob' + item.Id + '">\n' +
                                    '                                <td id="Arrivage' + item.Id + '">' + item.Arrivage + '</td>\n' +
                                    '                                <td id="Coulee' + item.Id + '">' + item.Coulee + '</td>\n' +
                                    '                                <td id="Bobine' + item.Id + '">' + item.Bobine + '</td>\n' +
                                    '                                <td id="Poids' + item.Id + '">' + item.Poids + '</td>\n' +
                                    '                                <td id="Epaisseur' + item.Id + '">' + item.Epaisseur + '</td>\n' +
                                    '                                <td id="Fournisseur' + item.Id + '">' + item.Fournisseur + '</td>\n' +
                                    '                                <td id="NbReception' + item.Id + '">' + item.NbReception + '</td>\n' +
                                    '                                <td id="DateRec' + item.Id + '">' + item.DateRec + '</td>\n' +
                                    '                                <td id="Source' + item.Id + '">' + item.Source + '</td>\n' +
                                    '                                <td id="NbBon' + item.Id + '">' + item.NbBon + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="RecBob' + item.Id + 'Edit" class="RecBobEdit text-primary"><i\n' +
                                    '                                                class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="RecBob' + item.Id + 'Delete" class="RecBobDelete text-danger"><i\n' +
                                    '                                                class="fa fa-trash"></i></button>\n' +
                                    '                                </td> \n' +
                                    '                            </tr>');
                                $('#RecBobForm').trigger("reset");
                                $('#NbReception').val(parseInt(item.NbReception) + 1);
                                $('#bobines').find('option[value=' + item.Bobine + ']').remove();
                                $('#coulees').find('option[value=' + item.Coulee + ']').remove();
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                if(result.responseJSON.message.s('bobine_nbreception_pid_unique')){
                                    alert('Numero De Réception déjà donné a une autre bobine');
                                }else{

                                    alert(result.responseJSON.message);
                                }
                                console.log(result);
                            }
                        });
                    } else {
                        formData.append('_method', 'put');
                        $.ajax({
                            url: "{{ url('/RecBob/')}}/" + id,
                            method: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                item = result.RecBob;
                                $('#RecBob' + item.Id).replaceWith(' <tr id="RecBob' + item.Id + '">\n' +
                                    '                                <td id="Arrivage' + item.Id + '">' + item.Arrivage + '</td>\n' +
                                    '                                <td id="Coulee' + item.Id + '">' + item.Coulee + '</td>\n' +
                                    '                                <td id="Bobine' + item.Id + '">' + item.Bobine + '</td>\n' +
                                    '                                <td id="Poids' + item.Id + '">' + item.Poids + '</td>\n' +
                                    '                                <td id="Epaisseur' + item.Id + '">' + item.Epaisseur + '</td>\n' +
                                    '                                <td id="Fournisseur' + item.Id + '">' + item.Fournisseur + '</td>\n' +
                                    '                                <td id="NbReception' + item.Id + '">' + item.NbReception + '</td>\n' +
                                    '                                <td id="DateRec' + item.Id + '">' + item.DateRec + '</td>\n' +
                                    '                                <td id="Source' + item.Id + '">' + item.Source + '</td>\n' +
                                    '                                <td id="NbBon' + item.Id + '">' + item.NbBon + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="RecBob' + item.Id + 'Edit" class="RecBobEdit text-primary"><i\n' +
                                    '                                                class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="RecBob' + item.Id + 'Delete" class="RecBobDelete text-danger"><i\n' +
                                    '                                                class="fa fa-trash"></i></button>\n' +
                                    '                                </td> \n' +
                                    '                            </tr>');
                                $('#RecBobForm').trigger("reset");
                                $("#ajouter").html("Ajouter");
                                $("#annulerButton").hide();
                                $("#bobine").prop('disabled', false);
                                $("#coulee").prop('disabled', false);
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });


                    }
                } else {
                    alert('Remplir tous les champs qui sont obligatoires svp!');
                }
            });


            function addRapprodsListeners() {
                $('.RecBobDelete').each(function (e) {
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
                            url: "{{url('/RecBob/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                $('#bobines').append($('<option>').attr('value', $('#Bobine' + id).html()).text($('#Bobine' + id).html()));
                                $('#coulees').append($('<option>').attr('value', $('#Coulee' + id).html()).text($('#Coulee' + id).html()));
                                tr.remove();
                                $('#RecBobForm').trigger("reset");
                                $("#ajouter").html("Ajouter");
                                $("#annulerButton").hide();
                                $("#bobine").prop('disabled', false);
                                $("#coulee").prop('disabled', false);
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.RecBobEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $("#Arrivage").val($("#Arrivage" + id).html());
                        $("#bobine").val($("#Bobine" + id).html());
                        $("#coulee").val($("#Coulee" + id).html());
                        $("#Poids").val($("#Poids" + id).html());
                        $("#Epaisseur").val($("#Epaisseur" + id).html());
                        $("#Fournisseur").val($("#Fournisseur" + id).html());
                        $("#NbReception").val($("#NbReception" + id).html());
                        $("#DateRec").val($("#DateRec" + id).html());
                        $("#Source").val($("#Source" + id).html());
                        $("#NbBon").val($("#NbBon" + id).html());
                        $('#Numero').val(id);
                        $("#ajouter").html("Modifier");
                        $("#annulerButton").show();
                        $("#bobine").prop('disabled', true);
                        $("#coulee").prop('disabled', true);
                    });

                });
            }

            $('#annulerButton').click(function () {
                $('#RecBobForm').trigger("reset");
                $("#ajouter").html("Ajouter");
                $("#annulerButton").hide();
                $("#bobine").prop('disabled', false);
                $("#coulee").prop('disabled', false);
            });
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
                        observation: $('#observation').val()
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                            window.location.href = '{{route("rapports_RecBob.index")}}';

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
                            etat: 'NonREC',
                        },
                        success: function (result) {
                            if (result.coulee != null) {
                                var coulee = result.coulee;
                                $('#coulee').val(coulee.Coulee);
                                $('#Poids').val(coulee.Poids);
                                $('#Epaisseur').val(coulee.Epaisseur);
                                $('#Arrivage').val(coulee.Arrivage);
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.error);
                            console.log(result);
                            if (result.responseJSON.error === "Bobine n'existe pas") {
                                $('#coulee').val('');
                                $('#Poids').val('');
                                $('#bobine').val('');
                                $('#Epaisseur').val('');
                                $('#Arrivage').val('');
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
                        etat: 'NonREC',
                    },
                    success: function (result) {
                        if (result.bobines.length !== 0) {
                            var bobines = result.bobines;
                            $('#bobines2').html("");
                            bobines.forEach(function (item, index) {
                                $('#bobines2').append('<option order="' + index + '" value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                $('#bobine').attr('list', 'bobines2');
                            });
                        } else {
                            alert("Coulee n'existe pas");
                            $('#coulee').val('');
                            $('#Poids').val('');
                            $('#bobine').val('');
                            $('#Epaisseur').val('');
                            $('#Arrivage').val('');
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
