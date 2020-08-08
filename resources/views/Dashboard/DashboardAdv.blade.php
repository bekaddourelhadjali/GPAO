@extends('layouts.dashboardTemp')
@section('style')
    <title>Tableau De Bord Rapports Total</title>
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
            <div class="tab-pane fade show active" id="nav-DashboardAdv" role="tabpanel"
                 aria-labelledby="nav-DashboardAdv-tab">

                <section>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  " href="{{route('Dashboard.index')}}">
                                <b>Rapport Journalier </b></a>
                            <a class="nav-item nav-link active " id="nav-DashboardAdv-tab" data-toggle="tab"
                               href="#nav-DashboardAdv" role="tab" aria-controls="nav-DashboardAdv"
                               aria-selected="true"><b>Rapport Total</b></a>


                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-sm-8">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0" for="Did">Detail Projet</label>
                                <select class="form-control col-12" id="Did" name="Did" onchange="getData()">
                                    @if(isset($details))
                                    @foreach($details as $detail)
                                        <option value="{{$detail->Did}}">{{$detail->Nom}} --
                                            Epais: {{$detail->Epaisseur}} mm
                                            -Diam : {{$detail->Diametre}}mm
                                        </option>
                                    @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>

                    </div>

                </section>
                <div class="row">
                    <div class=" col-lg-3 col-md-4 col-sm-6  py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                            NB   Tubes
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

                    <div class=" col-lg-3 col-md-4  col-sm-6 py-1">
                        <div class="card border-left-success shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">

                                           NB RB
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="nbRB">@if(isset($nbRB)){{($nbRB)}} @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-sort-numeric-up-alt fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="DashboardAdvTableContainer">
                                <table class="table table-borderless table-striped" id="DashboardAdvTable"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>Coulee</th>
                                        <th>Bobine</th>
                                        <th>Tube</th>
                                        <th>S</th>
                                        <th>MB</th>
                                        <th>RB</th>
                                        <th>Observation</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr id="report{{$item->Id}}"  rapportEtat="{{$item->Etat}}"
                                                rapportId="{{$item->NumeroRap}}">
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Machine}}</td>
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{$item->Bobine}}</td>
                                                <td>{{$item->Ntube}}</td>
                                                <td>{{$item->S}}</td>
                                                <td>{{$item->MB}}</td>
                                                <td>{{(int)$item->RB}}</td>
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
                        <div class="col-12 col-md-6" style="padding: 20px 0" >
                        <h2 class=" text-center text-danger " ><i class="fa fa-cog"></i>&nbsp; Rapport de Fonctionnement</h2>
                        </div>
                        <div class=" col-12 col-md-6 text-left">
                            <canvas width="100px" height="100px" id="myPieChart"></canvas>
                        </div>
                    </div>
                    <hr>
                        <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="DashboardAdvTableContainer">
                                <table class="table table-borderless table-striped" id="FoncTable"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID"  >
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
        var table = $('#DashboardAdvTable').DataTable({
            "bDestroy": true,
            "bRetrieve": true
        });

        $('#FoncTable').DataTable();
        $(document).ready(function () {
            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Controle")

            addActions();

            $('.reportEdit').click(function () {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                const reportId= $(this).attr("id").replace(/[^0-9]/g, '');
                var win = window.open("{{url('/Ultrason/')}}/" + id, '_blank');
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
                    var height = ((($(this).height()) - $('#tr-actions').height()) / 2) + $('#DashboardAdvTable_wrapper .row').height() + 5;
                    var width = (($('#DashboardAdvTableContainer').width() - $('#tr-actions').width()) / 2);
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

                    addActions();
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
            parent=$('#myPieChart').parent();
            parent.html('');
            parent.append('<canvas id="myPieChart"></canvas>');
            labels=[];
            data=[];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/USDailyRep')}}/" + $('#date').val(),
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
                    $('#nbRB').html('');
                    if (result.reports.length > 0){
                        result.reports.forEach(function (item) {
                            $('#DashboardAdvTable').DataTable().row.add([
                                'Poste '+item.Poste,
                                item.Machine,
                                item.Coulee,
                                item.Bobine,
                                item.Ntube,
                                item.S,
                                item.MB,
                                +item.RB,
                                item.Observation,
                                item.User]
                            ).draw(false);
                            $('#DashboardAdvTable tbody tr:last-child')
                                .attr('id','report'+item.Numero).attr('rapportEtat',item.Etat).attr('rapportId',item.NumeroRap);
                        });



                        $('#NBT').html(result.nbT);
                        $('#nbRB').html(result.nbRB);

                        addActions();
                    }
                    $('#FoncTable').DataTable().clear().draw();
                    if (result.ArretsReport.length > 0){
                        result.ArretsReport.forEach(function (item) {
                            $('#FoncTable').DataTable().row.add([
                                'Poste '+item.Poste,
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
                                .attr('id','report'+item.id).attr('rapportEtat',item.Etat).attr('rapportId',item.NumRap);
                        });
                        if($('#machine').val()!=='Tous'){
                            chartId='myPieChart';
                            labels=result.ChartLabels;
                            data=result.ChartData;
                            drawPieChart(chartId,data,labels );
                        }
                    }
                    addActions();
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });

        }
    </script>
@endsection