@extends('layouts.dashboardTemp')
@section('style')
    <title>Rapports UT Automatique</title>
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
            <div class="tab-pane fade show active" id="nav-NDTReport" role="tabpanel"
                 aria-labelledby="nav-NDTReport-tab">

                <section>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-NDTReport-tab" data-toggle="tab"
                               href="#nav-NDTReport" role="tab" aria-controls="nav-NDTReport"
                               aria-selected="true"><b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  " href="{{route('NDTReport.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  " href="{{route('NDTRepAdv.index')}}"><b>Filtres Avancés</b></a>

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
                </div>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="NDTReportTableContainer">
                                <table class="table table-bordered table-striped" id="NDTReportTable"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>Tube</th>
                                        <th>Bis</th>
                                        <th>SNUP</th>
                                        <th>OPR</th>
                                        <th>REP.D</th>
                                        <th>REP.G</th>
                                        <th>Observation</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr id="report{{$item->Id}}" rapportEtat="{{$item->Etat}}"
                                                rapportId="{{$item->NumeroRap}}">
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Machine}}</td>
                                                <td>{{$item->Tube}}</td>
                                                <td>{{(int)$item->Bis}}</td>
                                                <td>{{$item->Snup}}</td>
                                                <td>{{$item->OPR}}</td>
                                                <td>{{$item->Repd}}</td>
                                                <td>{{$item->Repg}}</td>
                                                <td>{{$item->Observation}}</td>
                                                <td>{{$item->User}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Controle")

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
                            <div class="table-container" id="NDTReportTableContainer">
                                <table class="table table-borderless table-striped" id="FoncTable"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
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
                                    @if(isset($ArretsReport))

                                        @foreach($ArretsReport as $item)
                                            <tr id="report{{$item->id}}" rapportEtat="{{$item->Etat}}"
                                                rapportId="{{$item->NumRap}}">
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->TypeArret}}</td>
                                                <td>{{$item->Cause}}</td>
                                                <td>{{$item->Du}}</td>
                                                <td>{{$item->Au}}</td>
                                                <td>{{$item->Durée}}</td>
                                                <td>{{$item->Obs}}</td>
                                                <td>{{$item->NDI}}</td>
                                                <td>{{$item->User}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div id="tr-actions">
                                    <button class="reportEdit btn btn-primary" style="width: 100px">Ouvrir</button>
                                    <button class="reportDelete btn " style="width: 100px"></button>

                                </div>
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
    <script src="{{asset('js/chart-bar-demo.js')}}"></script>
    <script>

        var table = $('#NDTReportTable').DataTable({
            "bDestroy": true,"lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]],
            "bRetrieve": true
        });

        $('#FoncTable').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]});
        $(document).ready(function () {


            chartId = 'myPieChart';
            labels =@json( $ChartLabels);
            data =@json( $ChartData) ;
            drawPieChart(chartId, data, labels);
            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Controle")

            if (typeof obj === 'AddActions') {AddActions(); }
            $('.reportEdit').click(function () {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                const reportId = $(this).attr("id").replace(/[^0-9]/g, '');
                var win = window.open("{{url('/Ndt/')}}/" + id, '_blank');
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
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Controle")

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
                    var height = ((($(this).height()) - $('#tr-actions').height()) / 2) + $('#NDTReportTable_wrapper .row').height() + 5;
                    var width = (($('#NDTReportTableContainer').width() - $('#tr-actions').width()) / 2);
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/NDTDailyRep')}}/" + $('#date').val(),
                method: 'get',
                data: {
                    poste: $('#poste').val(),
                    Did: $('#Did').val(),
                    Machine: $('#machine').val(),

                },
                success: function (result) {
                    table.clear().draw();
                    $('#NBT').html('');
                    parent = $('#myPieChart').parent();
                    parent.html('');
                    parent.append('<canvas id="myPieChart"></canvas>');
                    labels = [];
                    data = [];
                    $('#FoncTable').DataTable().clear().draw();
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#NDTReportTable').DataTable().row.add([
                                'Poste ' + item.Poste,
                                item.Machine,
                                item.Tube,
                                +item.Bis,
                                item.Snup,
                                item.OPR,
                                item.Repd,
                                item.Repg,
                                item.Observation,
                                item.User]
                            ).draw(false);
                            $('#NDTReportTable tbody tr:last-child')
                                .attr('id', 'report' + item.Id).attr('rapportEtat', item.Etat).attr('rapportId', item.NumeroRap);
                        });


                        $('#NBT').html(result.nbT);

                        if (typeof obj === 'AddActions') {AddActions(); }
                    }
                    if (result.ArretsReport.length > 0) {
                        result.ArretsReport.forEach(function (item) {
                            $('#FoncTable').DataTable().row.add([
                                'Poste ' + item.Poste,
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
                        chartId = 'myPieChart';
                        labels = result.ChartLabels;
                        data = result.ChartData;
                        drawPieChart(chartId, data, labels);
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