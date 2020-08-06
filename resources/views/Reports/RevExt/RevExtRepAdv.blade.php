@extends('layouts.dashboardTemp')
@section('style')
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }

        .table-container {
            width: 100%;
            overflow: auto;
            max-height: 400px;
        }
        .table{

            min-width: 800px;
        }
        #Filter_TR th{
             background-color: orangered;
            color:white;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-RevExtRepAdv" role="tabpanel"
                 aria-labelledby="nav-RevExtRepAdv-tab">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('RevExtDailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  "  href="{{route('RevExtReport.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link active " id="nav-RevExtRepAdv-tab" data-toggle="tab"
                               href="#nav-RevExtRepAdv" role="tab" aria-controls="nav-RevExtRepAdv" aria-selected="true">
                                <b>Filtres Avancés</b></a>

                        </div>
                    </nav>
                    <br>
                <br>
                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-8">
                            <div class="form-group ">
                                <label for=""> <b class="col-12 m-0 font-weight-bold " style="color:#FF4500">Filtrer Par</b></label>
                                <select class="form-control col-12" id="Filtre" name="Filtre" onchange="getData()" >
                                    <option value="Projet" selected>Projets</option>
                                    <option value="Diametre">Diametres</option>
                                    <option value="Epaisseur">Epaisseurs</option>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar" >
                            <canvas id="myBarChart"></canvas>
                        </div>
                        <hr>
                    </div>
                </div>
                    <div class="table-container">
                        <table class="col-12 table table-bordered  table-striped" id="RevExtReportTable" style="min-width: 800px">
                            <tbody id="Reports">
                            <tr id="Filter_TR">
                                @if(isset($RevExtReport))
                                    @foreach($RevExtReport as $item)
                                    <th >{{$item->Filter}}</th>
                                @endforeach
                                @endif
                            </tr>
                            <tr id="NBT_TR">
                                @if(isset($RevExtReport))
                                    @foreach($RevExtReport as $item)
                                    <td><span class="text-danger"><b>{{$item->NBT}}</b></span> Tubes</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr id="LT_TR">
                                @if(isset($RevExtReport))
                                    @foreach($RevExtReport as $item)
                                        <td><span class="text-danger"><b>{{$item->LT}}</b></span> Mètres</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr id="PT_TR">
                                @if(isset($RevExtReport))
                                    @foreach($RevExtReport as $item)
                                    <td><span class="text-danger"><b>{{$item->PT}}</b></span> Tonnes</td>
                                    @endforeach
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>





@endsection


@section('script')

    <script src="{{asset('js/chart.min.js')}}"></script>
    <script src="{{asset('js/chart-bar-demo.js')}}"></script>
    <script>
        $(document).ready(function () {

            chartId='myBarChart';
            labels=@json(array_column($RevExtReport,'Filter'));
            data=@json(array_column($RevExtReport,'LT'));
            var max = Math.max.apply(Math, data);
            DrawChart(chartId,labels,data,$('#Filtre').val(),'Mètres',max);

        });

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/RevExtRepAdv')}}/" + $('#Filtre').val(),
                method: 'get',
                data: {
                },
                success: function (result) {
                    parent=$('#myBarChart').parent();
                    parent.html('');
                    parent.append('<canvas id="myBarChart"></canvas>');
                    labels=[];
                    data=[];
                    $('#Reports').html('');
                    if (result.reports.length > 0) {
                        $('#Reports').append(
                            '<tr id="Filter_TR"></tr>'+
                            '<tr id="NBT_TR"></tr>'+
                            '<tr id="PT_TR"></tr>'  +
                            '<tr id="LT_TR"></tr>'   ) ;

                        result.reports.forEach(function (item) {
                            $('#Filter_TR').append( ' <th  >' + item.Filter + '</th> ');
                            $('#NBT_TR').append( '<td><span class="text-danger"><b>' + item.NBT + '</b></span> Tubes</td> ');
                            $('#PT_TR').append( '<td><span class="text-danger"><b>' + item.PT + '</b></span> Tonnes</td>');
                            $('#LT_TR').append( '<td><span class="text-danger"><b>' + item.LT + '</b></span> Mètres</td>');


                            labels.push(item.Filter);
                            data.push(item.LT);
                        });
                         chartId = 'myBarChart';
                        var max = Math.max.apply(Math, data);
                        DrawChart(chartId, labels, data, $('#Filter').val(), 'Mètres', max);
                    }
                },
                error: function (result) {
                    console.log(result);
                    alert(result.responseJSON.message);
                }
            });
        }


    </script>
@endsection