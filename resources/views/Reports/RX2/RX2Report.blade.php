@extends('layouts.dashboardTemp')
@section('style')
    <title>Rapports De Contrôle Radioscopique </title>
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

    </style>
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-RX2Report" role="tabpanel"
                 aria-labelledby="nav-RX2Report-tab ">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('RX2DailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link active " id="nav-RX2Report-tab" data-toggle="tab"
                               href="#nav-RX2Report" role="tab" aria-controls="nav-RX2Report" aria-selected="true"><b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  "  href="{{route('RX2RepAdv.index')}}"><b>Filtres Avancés</b></a>

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
                    </div>
                </section>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-md-6 py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                            NB t <span class="MonthRep">
                                                    ({{$monthW}})  </span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="MonthNBT">{{$MonthNBT}}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('img/pipes.png')}}" width="60px" height="60px" alt="">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6 py-1">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                            NB T <span class="YearRep"> ({{date('Y')}}) </span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="YearNBT"> {{$YearNBT}}  </span>
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
                <div class="row" id="OperationsReport">
                    @if(isset($OperationsReport))
                        @foreach($OperationsReport as $item)
                            <div class=" col-lg-3 col-md-4 col-6 py-1">
                                <div class="card border-bottom-danger shadow text-center h-100 ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                                    opr: <span class="Operation text-danger ">{{$item->Opr}}</span>&nbsp
                                                    nb: <span  class="NBT text-danger">{{$item->NBT}}</span>&nbsp
                                                    <span  class="VT text-danger">({{$item->VT}})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <table class="table table-borderless table-striped" id="RX2ReportTable"  cellspacing="0">
                                     <thead style="cursor: pointer">
                                    <tr class="text-white">
                                        <th>DateSaisie</th>
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>CodeSoudeur</th>
                                        <th>NBT</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr  style="display: table-row;" >
                                                <td>{{$item->DateSaisie}}</td>
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Machine}}</td> 
                                                <td>{{$item->CodeSoude}}</td>
                                                <td>{{$item->NBT}}</td>
                                            </tr>

                                        @endforeach
                                    @endif

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </section>
                <section>
                    <h2 class="text-primary ">Rapport des Defauts</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="table-container">
                                <table class="table table-borderless table-striped" id="DefautsTable"
                                       cellspacing="0">
                                    <thead class="text-white">
                                    <th>Defaut</th>
                                    <th>NB_Total</th>
                                    </thead>
                                    <tbody>
                                    @if(isset($DefautsReport))
                                        @foreach($DefautsReport as $item)
                                            <tr>
                                                <td>{{$item->Defaut}}</td>
                                                <td>{{$item->NBT}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-bar" >
                                <canvas id="myBarChart"></canvas>
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
    <script src="{{asset('js/chart-bar-demo.js')}}"></script>
    <script>

        $(document).ready(function () {

            chartId='myBarChart';
            labels=@json(array_column($DefautsReport,'Defaut'));
            data=@json(array_column($DefautsReport,'NBT'));
            var max = Math.max.apply(Math, data);
            DrawChart(chartId,labels,data,'Defaut','',max,'bar',"#0275ff","#0275a8");
            $('#RX2ReportTable').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]});
             calculateColumn(4);
        $('#RX2ReportTable_filter input[type=search]').keyup(function () {
            calculateColumn(4);
        });
        });

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/RX2Report')}}/" + $('#Did').val(),
                method: 'get',
                data: {
                },
                success: function (result) {
                    parent = $('#myBarChart').parent();
                    parent.html('');
                    parent.append('<canvas id="myBarChart"></canvas>');
                    labels = [];
                    data = [];
                    $('#OperationsReport').html('');
                    $('#DefautsTable tbody').html('');
                    $('#RX2ReportTable').DataTable().clear().draw();
                    $('#MonthNBT').html(result.MonthNBT);
                    $('#YearNBT').html(result.YearNBT);

                    if(result.OperationsReport.length>0){
                        result.OperationsReport.forEach(function (item) {
                            $('#OperationsReport').append(' <div class=" col-lg-3 col-md-4 col-6 py-1">\n' +
                                '                                <div class="card border-bottom-danger shadow text-center h-100 ">\n' +
                                '                                    <div class="card-body">\n' +
                                '                                        <div class="row no-gutters align-items-center">\n' +
                                '                                            <div class="col mr-2">\n' +
                                '                                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">\n' +
                                '                                                    opr: <span class="Operation text-danger ">'+item.Opr+'</span>&nbsp\n' +
                                '                                                    nb: <span  class="NBT text-danger">'+item.NBT+'</span>&nbsp\n' +
                                '                                                     <span  class="VT text-danger">('+(item.VT === null ? '' : Number(item.VT))+')</span>\n' +
                                '                                                </div>\n' +
                                '                                            </div>\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>');
                        });
                    }
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#RX2ReportTable').DataTable().row.add([
                                item.DateSaisie,
                                "Poste "+item.Poste,
                                item.Machine,
                                item.CodeSoude,
                                item.NBT, ]
                            );

                        });
                        $('#RX2ReportTable').DataTable().draw(false);
                        $('#RX2ReportTable tbody tr').attr('style','display: table-row;');
                    }
                    if (result.DefautsReport.length > 0) {
                        labels=[];
                        data=[];
                        result.DefautsReport.forEach(function (item) {
                            $('#DefautsTable tbody').append('<tr>' +
                                '<td>'+item.Defaut+'</td>' +
                                '<td>'+item.NBT+'</td>' +
                                '</tr> ');
                            labels.push(item.Defaut);
                            data.push(item.NBT);
                        });
                        max=Math.max.apply(Math, data);
                        chartId = 'myBarChart';
                        DrawChart(chartId,labels,data,'Defaut','',max,'bar',"#0275ff","#0275a8");
                    }
                     calculateColumn(4);
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });
        }
    </script>
@endsection