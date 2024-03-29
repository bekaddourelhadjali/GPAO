@extends('layouts.dashboardTemp')
@section('style')
    <title>Rapports De Production</title>
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }

        .table-container {
            width: 100%;
            overflow: auto;
        }

        #tr-actions {
            display: none;
            position: absolute;
            z-index: 10;
        }

        #tr-actions button, #tr-actions i.fa {
            font-size: 17px;
            border: none;
        }

    </style>
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-FABReport" role="tabpanel"
                 aria-labelledby="nav-FABReport-tab">

                <section>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-FABReport-tab" data-toggle="tab"
                               href="#nav-FABReport" role="tab" aria-controls="nav-FABReport"
                               aria-selected="true"><b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  " href="{{route('FabReport.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  " href="{{route('FabRepAdv.index')}}"><b>Filtres
                                    Avancés</b></a>

                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-sm-8">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0" for="Did">Detail Projet</label>
                                <select class="form-control col-12" id="Did" name="Did" onchange="getData()">
                                    @foreach($details as $detail)
                                        <option value="{{$detail->Did}}">{{$detail->Nom}} --
                                            Epais: {{$detail->Epaisseur}} mm
                                            -Diam : {{$detail->Diametre}}mm
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-4 col-6">
                            <div class="form-group ">
                                <label class="col-lg-12" for="date">La Date: </label>
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="date"
                                       max="{{date('Y-m-d')}}"
                                       onchange="getData()">
                            </div>
                        </div>
                        <div class=" col-lg-2 col-md-3 col-6">
                            <div class="form-group ">
                                <label class="col-lg-12" for="poste">Poste: </label>
                                <select class="form-control" id="poste" onchange="getData()">
                                    <option value="Tous" selected>Tous</option>
                                    <option value="1">Poste 1</option>
                                    <option value="2">Poste 2</option>
                                    <option value="3">Poste 3</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-lg-2 col-md-3 col-6">
                            <div class="form-group ">
                                <label class="col-lg-12" for="machine">Machine: </label>
                                <select class="form-control" id="machine" onchange="getData()">
                                    <option value="Tous" selected>Tous</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </section>
                <div class="row">
                    <div class="col-md-4 py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                            NB total des Tubes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; <span id="NBT"> @if(isset($nbT)){{$nbT}} @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('img/pipes.png')}}" width="60px" height="60px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 py-1">
                        <div class="card border-left-success shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">

                                            Longueur total des Tubes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="LT">@if(isset($LT)){{($LT)}} @endif</span>
                                            Mètres
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ruler-horizontal fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-1">
                        <div class="card border-left-warning shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                                            poids total des Tubes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="PT">@if(isset($PT)){{($PT)}} @endif</span>
                                            Tonnes
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-balance-scale fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="FABReportTableContainer">
                                <table class="table table-borderless table-striped" id="FABReportTable" width="120%"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>Coulee</th>
                                        <th>Bobine</th>
                                        <th>Tube</th>
                                        <th>Longueur</th>
                                        <th>Poids</th>
                                        <th>RB</th>
                                        <th>Macro</th>
                                        <th>Observation</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr id="report{{$item->Numero}}" rapportEtat="{{$item->Etat}}"
                                                rapportId="{{$item->NumeroRap}}">
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Machine}}</td>
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{$item->Bobine}}</td>
                                                <td>{{$item->Ntube}}</td>
                                                <td>{{$item->Longueur}}</td>
                                                <td>{{$item->Poids}}</td>
                                                <td>{{(int)$item->RB}}</td>
                                                <td>{{(int)$item->Macro}}</td>
                                                <td>{{$item->Observation}}</td>
                                                <td>{{$item->User}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")
                                    <div id="tr-actions">
                                        <button class="reportEdit btn btn-primary" style="width: 100px">Ouvrir</button>
                                        <button class="reportDelete btn " style="width: 100px"></button>

                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </section>
                <section>
                    <div class="row">
                        <div class="col-12 col-md-6" style="padding: 20px 0">
                            <h2 class=" text-center text-danger "><i class="fa fa-cog"></i>&nbsp; Rapport de
                                Fonctionnement</h2>
                        </div>
                        <div class=" col-12 col-md-6 text-left">
                            <canvas width="100px" height="100px" id="myPieChart"></canvas>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="FABReportTableContainer">
                                <table class="table table-borderless table-striped" id="FoncTable"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>TypeArret</th>
                                        <th>Cause</th>
                                        <th>Du</th>
                                        <th>Au</th>
                                        <th>Duree</th>
                                        <th>Obs</th>
                                        <th>NDI</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ArretReports">
                                    </tbody>
                                </table>
                                @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

                                    <div id="tr-actions">
                                        <button class="reportEdit btn btn-primary" style="width: 100px">Ouvrir</button>
                                        <button class="reportDelete btn " style="width: 100px"></button>

                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>





@endsection


@section('script')

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script src="{{asset('js/chart-pie-demo.js')}}"></script>
    <script>
        var table = $('#FABReportTable').DataTable({
            "bDestroy": true,"lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]],
            "bRetrieve": true,
            "deferRender": true
        });

        $('#FoncTable').DataTable({
            "bDestroy": true,"lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]],
            "bRetrieve": true,
            "deferRender": true
        });
        $(document).ready(function () {
            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

            if (typeof obj === 'AddActions') {AddActions(); }

            $('.reportEdit').click(function () {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                const reportId = $(this).attr("id").replace(/[^0-9]/g, '');
                var win = window.open("{{url('/rapprod/')}}/" + id, '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
            });
            @endif
        });

        @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

        function addActions() {

            reportID = 0;
            $("#Reports TR, #ArretReports TR").each(function () {
                $(this).off('mouseenter');
                $(this).mouseenter(function () {
                    rapportID = $(this).attr('rapportId');


                    var o = $(this);
                    var offset = o.offset();
                    const id = $(this).attr("id").replace(/[^0-9]/g, '');
                    reportID = id;
                    $('#tr-actions .reportDelete').each(function () {
                        $(this).attr('id', 'report' + id + 'Delete');
                        $('#tr-actions #report' + id + 'Delete').attr('rapportId', rapportID);
                    });


                    $('#tr-actions .reportEdit').each(function () {
                        $(this).attr('id', 'report' + id + 'Edit');
                    });
                    var height = ((($(this).height()) - $('#tr-actions').height()) / 2) + $('#FABReportTable_wrapper .row').height() + 5;
                    var width = (($('#FABReportTableContainer').width() - $('#tr-actions').width()) / 2);
                    if ($(this).attr('rapportEtat') == 'C') {
                        $('#tr-actions #report' + id + 'Delete').html("Déclôturer").addClass("btn-danger").removeClass("btn-success");

                    } else {
                        $('#tr-actions #report' + id + 'Delete').html("Clôturer").addClass("btn-success").removeClass("btn-danger");
                    }
                    $('#tr-actions #report' + id + 'Edit').attr('rapportId', $(this).attr("rapportId"));
                    $('#tr-actions').css({
                        'top': (offset.top - $('.table').offset().top) + height,
                        'left': width,
                    }).show();

                })
                    .mouseleave(function () {

                        $('#tr-actions').hide();
                    });
            });

        }

        $('.reportDelete').each(function () {
            $(this).off("click");
            $(this).click(function (e) {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                const reportId = $(this).attr("id").replace(/[^0-9]/g, '');
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Etat = 'N';
                if ($(this).html() === 'Clôturer') Etat = 'C'
                $.ajax({
                    url: "{{url('/RapportState')}}/" + id,
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        Etat: Etat
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');

                        }
                        else {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Décloturé avec succès');

                        }

                        $('#Reports tr[rapportId=' + id + '] ').attr("rapportEtat", result.rapportState.Etat);
                        $('#ArretReports tr[rapportId=' + id + '] ').attr("rapportEtat", result.rapportState.Etat);

                        if (typeof obj === 'AddActions') {AddActions(); }
                    },
                    error: function (result) {

                        alert(result.responseJSON.message);
                        console.log(result)

                    }
                });
            });
        });
        $('#tr-actions').mouseenter(function () {
            $(this).show();

        });
        $('#tr-actions').mouseleave(function () {
            $(this).hide();

        });

        @endif
        function getData() {
            parent = $('#myPieChart').parent();
            parent.html('');
            parent.append('<canvas id="myPieChart"></canvas>');
            labels = [];
            data = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/FabDailyRep')}}/" + $('#date').val(),
                method: 'get',
                data: {
                    poste: $('#poste').val(),
                    Did: $('#Did').val(),
                    Machine: $('#machine').val(),

                },
                success: function (result) {
                    console.log(result);
                    table.clear().draw();
                    $('#NBT').html('');
                    $('#PT').html('');
                    $('#LT').html('');
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#FABReportTable').DataTable({
                                "bDestroy": true,
                                "bRetrieve": true,
                                "deferRender": true,
                            }).row.add([
                                'Poste ' + item.Poste,
                                item.Machine,
                                item.Coulee,
                                item.Bobine,
                                item.Ntube,
                                item.Longueur,
                                item.Poids,
                                +item.RB,
                                +item.Macro,
                                item.Observation,
                                item.User]
                            ).draw(false);
                            $('#FABReportTable tbody tr:last-child')
                                .attr('id', 'report' + item.Numero).attr('rapportEtat', item.Etat).attr('rapportId', item.NumeroRap);
                        });


                        $('#NBT').html(result.nbT);
                        $('#PT').html(result.PT);
                        $('#LT').html(result.LT);

                        if (typeof obj === 'AddActions') {AddActions(); }
                    }
                    $('#FoncTable').DataTable().clear().draw();
                    if (result.ArretsReport.length > 0) {
                        result.ArretsReport.forEach(function (item) {
                            $('#FoncTable').DataTable().row.add([
                                'Poste ' + item.Poste,
                                item.Machine,
                                item.TypeArret,
                                item.Cause,
                                item.Du,
                                item.Au,
                                item.Durée,
                                item.Obs,
                                item.NDI,
                                item.User]
                            ).draw(false);
                            $('#FoncTable tbody tr:last-child')
                                .attr('id', 'report' + item.id).attr('rapportEtat', item.Etat).attr('rapportId', item.NumRap);
                        });
                        if ($('#machine').val() !== 'Tous') {
                            chartId = 'myPieChart';
                            labels = result.ChartLabels;
                            data = result.ChartData;
                            drawPieChart(chartId, data, labels);
                        }
                    }
                    if (typeof obj === 'AddActions') {AddActions(); }
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });

        }
    </script>
@endsection