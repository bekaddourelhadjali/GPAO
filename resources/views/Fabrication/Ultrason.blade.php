@extends('layouts.app')

@section('style')
    <title>Rapport US Automatique</title>
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
                    <div class="row">Machine: &nbsp; <span class="valeur"> {{$rapport->Machine}}</span></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}
                       </span></div>
                    <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                </div>

            </div>
        </section>
        <div class="row">
            <div class=" col-12 offset-0">

                <section class="top-actions">
                    <h5>Info Tube</h5>
                    <form id="ultrasonsForm" autocomplete="off">
                        <input name="ID" type="hidden" id="ID" value="">
                        <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                        <div class="row">
                            <div class="col-lg-1 col-md-3 col-4">
                                <div class="form-group ">
                                    <label class="col-lg-12" style="padding-left: 0">Tube</label>
                                    <input class="form-control col-12 text-center" style="color:#00f" id="ntube"
                                           name="ntube"
                                           required list="tubes">
                                    <datalist id="tubes">
                                        <option disabled selected></option>
                                        @if(isset($tubes))
                                            @foreach($tubes as $tube)
                                                    <option value="{{$tube->Ntube}}" coulee="{{$tube->Coulee}}" bobine="{{$tube->Bobine}}" >{{$tube->Ntube}}</option>

                                            @endforeach
                                        @endif
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-4">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Coulee" style="padding-left: 0">Coulee</label>
                                    <input class="form-control col-12" type="number" id="Coulee" name="Coulee"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3   col-4">
                                <div class="form-group text-center">
                                    <label class="col-12" for="Bobine" style="padding-left: 0">Bobine</label>
                                    <input class="form-control col-12" type="number" id="Bobine" name="Bobine"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-3   col-4">
                                <div class="form-group text-center">
                                    <label class="col-12" for="S" style="padding-left: 0">S(SNUS)</label>
                                    <input class="form-control col-12" type="text" id="S" name="S"
                                            required>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-3   col-4">
                                <div class="form-group text-center">
                                    <label class="col-12" for="MB" style="padding-left: 0">MB(BAPS)</label>
                                    <input class="form-control col-12" type="text" id="MB" name="MB"
                                           required>
                                </div>
                            </div>
                            <div class=" col-lg-1 col-md-2 col-4 inputs form-check"
                                           style="margin-top:40px; font-size: 20px">
                                <input class="form-check-input" style="width:20px; height: 20px;" type="checkbox"
                                       id="RB" name="RB">
                                <label style="    margin-left: 10px;" class="form-check-label" for="RB">RB</label>
                            </div>

                            <div class="form-group col-lg-4  col-md-7   col-12 ">
                                <label for="observation" class="col-12">Observation</label>
                                <input type="text" class="form-control" name="observation" id="observation">
                            </div>
                            <div class="offset-lg-8 offset-md-0 col-md-2 col-6"><label class="col-12"></label>
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
                                <th>NTube</th>
                                <th>Coulee</th>
                                <th>Bobine</th>
                                <th>S(SNUS)</th>
                                <th>MB(BAPS)</th>
                                <th>RB</th>
                                <th>Observation</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="ultrasons">
                            @if(isset($ultrasons))
                                @foreach($ultrasons as $item)
                                    <tr id="ultrason{{$item->Id}}">
                                        <td id="Ntube{{$item->Id}}">{{$item->Ntube}}</td>
                                        <td id="Coulee{{$item->Id}}">{{$item->Coulee}}</td>
                                        <td id="Bobine{{$item->Id}}">{{$item->Bobine}}</td>
                                        <td id="S{{$item->Id}}">{{$item->S}}</td>
                                        <td id="MB{{$item->Id}}">{{$item->MB}}</td>

                                        <td >@if($item->RB) <input id="RB{{$item->Id}}" type="checkbox" checked
                                                                                         onclick="return false;">
                                            @elseif(!$item->RB)<input id="RB{{$item->Id}}" type="checkbox" onclick="return false;"> @endif
                                        </td> 
                                        <td id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                                        <td>
                                            <button id="ultrasons{{$item->Id}}Edit" class="ultrasonsEdit text-primary"><i
                                                        class="fa fa-edit"></i></button>
                                            <button id="ultrasons{{$item->Id}}Delete" class="ultrasonsDelete text-danger"><i
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

                <div class=" col-lg-3 col-md-4 col-sm-6">
                    <button type="button" class="btn btn-outline-danger col-12" data-toggle="modal"
                            data-target="#staticBackdrop">
                        <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets
                            Machine</b>
                    </button>
                </div>
                <div class="  col-lg-3 col-md-4 offset-lg-3  offset-0  col-sm-6">
                    <form method="post" action="{{route('rapports_Ultrason.destroy',["id"=>$rapport->Numero])}}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle"
                                                                        style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le Rapport</b>
                        </button>
                    </form>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-6">
                    <button id="cloturer" class="btn btn-success col-12">
                        <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp; Clôturer le Rapport</b>
                    </button>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->

    @include('layouts.ArretsLayout')

@endsection
@section('script')

    <script>

        $(document).ready(function () {

            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#Ajouter').click(function (e) {
                e.preventDefault();
                if ($('#ultrasonsForm')[0].checkValidity()&& $('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    const id = $('#ID').val();
                    var formData = new FormData(document.getElementById('ultrasonsForm'));
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#Ajouter').html() !== ' Modifier ') {
                        $.ajax({
                            url: "{{ route('Ultrason.store')}}",
                            method: 'post',
                            data:formData ,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                var item = result.ultrason;
                                $('#ultrasons').append('<tr id="ultrason' + item.Id + '">\n' +
                                    '                                <td id="Ntube' + item.Id + '">' + item.Ntube + '</td>\n' +
                                    '                                <td     id="Coulee' + item.Id + '">' + item.Coulee + '</td>\n' +
                                    '                                <td     id="Bobine' + item.Id + '">' + item.Bobine + '</td>\n' +
                                    '                                <td     id="S' + item.Id + '">' + item.S + '</td>\n' +
                                    '                                <td     id="MB' + item.Id + '">' + item.MB + '</td>\n' +
                                    '                               <td > <input id="RB' + item.Id + '" type="checkbox" ' + item.RB_t + '  onclick="return false;"></td>' +
                                    '                                <td  id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ultrasons' + item.Id + 'Edit" class="ultrasonsEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ultrasons' + item.Id + 'Delete" class="ultrasonsDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#ultrasonsForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#tubes option[value=' +  item.Ntube+ ']').remove();
                                $('#annulerButton').hide();
                                addRapprodsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });

                    } else {
                        formData.append('_method','put');
                        $.ajax({
                            url: "{{url('/Ultrason/')}}/" + id,
                            method: 'post',
                            data:formData ,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                var item = result.ultrason;
                                $('#ultrason' + id).replaceWith('<tr id="ultrason' + item.Id + '">\n' +
                                    '                                <td id="Ntube' + item.Id + '">' + item.Ntube + '</td>\n' +
                                    '                                <td     id="Coulee' + item.Id + '">' + item.Coulee + '</td>\n' +
                                    '                                <td     id="Bobine' + item.Id + '">' + item.Bobine + '</td>\n' +
                                    '                                <td     id="S' + item.Id + '">' + item.S + '</td>\n' +
                                    '                                <td     id="MB' + item.Id + '">' + item.MB + '</td>\n' +
                                    '                               <td > <input id="RB' + item.Id + '" type="checkbox" ' + item.RB_t + '  onclick="return false;"></td>' +
                                    '                                <td   id="Observation' + item.Id + '">' + $('#observation').val() + '</td>\n' +
                                    '                                <td>\n' +
                                    '                                    <button id="ultrasons' + item.Id + 'Edit" class="ultrasonsEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                    <button id="ultrasons' + item.Id + 'Delete" class="ultrasonsDelete text-danger" ><i class="fa fa-trash"></i></button>\n' +
                                    '                                </td>\n' +
                                    '                            </tr>');
                                $('#ultrasonsForm').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
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
                    if ($('#tubes option[value=' + $('#ntube').val() + ']').val() === undefined) {
                        alert("Sélectionner le tube qui existe dans la liste svp!");
                        $('#ntube').val('');
                    } else
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#ultrasonsForm').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#ntube').prop('disabled', false);
            });

            function addRapprodsListeners() {

                $('#ntube').removeAttr("readonly");
                $('.ultrasonsDelete').each(function (e) {

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
                            url: "{{url('/Ultrason/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,
                            },
                            success: function (result) {
                                ntube=$("#Ntube"+id).html();
                                Coulee=$("#Coulee"+id).html();
                                Bobine=$("#Bobine"+id).html();
                                tr.remove();
                                $('#ultrasonsForm').trigger("reset");
                                $('#tubes').prepend('<option value="'+ntube+'" coulee="'+Coulee+'" bobine="'+Bobine+'">'+ntube+'</option>');
                                $(' option[value=' + $('#ntube').val() + ']').remove();
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
                $('.ultrasonsEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#ID').val(id);
                        $('#ntube').val($("#Ntube"+id).html());
                        $('#Coulee').val($("#Coulee"+id).html());
                        $('#Bobine').val($("#Bobine"+id).html());
                        $('#S').val($("#S" + id).html());
                        $('#MB').val($("#MB" + id).html());
                        $('#RB').prop('checked',$("#RB" + id).prop('checked'));
                        $('#observation').val($("#Observation" + id).html());
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
                            window.location.href = '{{route("rapports_Ultrason.index")}}';

                        }


                    },
                    error: function (result) {

                        alert(result.responseJSON.message);

                    }
                });
            });
            $('#ntube').change(function () {

                if ($('#tubes option[value=' + $('#ntube').val() + ']').val() !== undefined) {
                    $('#Coulee').val($('#tubes option[value=' + $('#ntube').val() + ']').attr('coulee'));
                    $('#Bobine').val($('#tubes option[value=' + $('#ntube').val() + ']').attr('Bobine'));
                } else {
                    $('#ntube').val('');
                    $('#Coulee').val('');
                    $('#Bobine').val('');

                }
            });
        });


    </script>
    @include('layouts.ArretScript')
@endsection
