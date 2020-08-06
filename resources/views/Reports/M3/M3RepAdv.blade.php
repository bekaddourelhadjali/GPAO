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
            <div class="tab-pane fade show active" id="nav-M3RepAdv" role="tabpanel"
                 aria-labelledby="nav-M3RepAdv-tab">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('M3DailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  "  href="{{route('M3Report.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link active " id="nav-M3RepAdv-tab" data-toggle="tab"
                               href="#nav-M3RepAdv" role="tab" aria-controls="nav-M3RepAdv" aria-selected="true">
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
                                    <option value="Arrivage">Arrivages</option>
                                    <option value="Largeur Bande">Largeur de Bande</option>
                                </select>
                            </div>
                        </div>
                            <div class=" col-lg-2 col-md-4 col-6">
                                <div class="form-group ">
                                    <label class="col-lg-12" for="Rive">Rive (mm) : </label>
                                    <input class="form-control" type="number" min="1" max="100" value="50" id="Rive"
                                           name="Rive"
                                    >
                                </div>
                            </div>
                            <div class=" col-lg-2 col-md-4 col-6">
                                <div class="form-group ">
                                    <label class="col-lg-12" for="RiveE">Rive E (mm): </label>
                                    <input class="form-control" type="number" min="1" max="100" value="11" id="RiveE"
                                           name="RiveE"
                                    >
                                </div>
                            </div>
                            <div class=" col-2">
                                <label class="col-12">&nbsp;</label>
                                <button class=" btn btn-danger" onclick="getData()"><b><i class="fa fa-sync col-12"></i></b>
                                </button>

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
                        <table class="col-12 table table-bordered  table-striped" id="M3ReportTable" style="min-width: 800px">
                            <tbody id="Reports">
                            <tr id="Filter_TR">
                                @if(isset($M3Report))
                                    @foreach($M3Report as $item)
                                    <th >{{$item->Filter}}</th>
                                @endforeach
                                @endif
                            </tr>
                            <tr id="NBT_TR">
                                @if(isset($M3Report))
                                    @foreach($M3Report as $item)
                                    <td><span class="text-danger"><b>{{$item->NBT}}</b></span> Bobs</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr id="PT_TR">
                                @if(isset($M3Report))
                                    @foreach($M3Report as $item)
                                    <td><span class="text-danger"><b>{{$item->PT}}</b></span> Tonnes</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr id="CT_TR">
                                @if(isset($M3Report))
                                    @foreach($M3Report as $item)
                                        <td><span class="text-danger"><b>{{$item->CT}}</b></span> Tonnes</td>
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
            labels=@json(array_column($M3Report,'Filter'));
            data=@json(array_column($M3Report,'CT'));
            var max = Math.max.apply(Math, data);
            DrawChart(chartId,labels,data,$('#Filtre').val(),'Tonnes',max);

        });

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/M3RepAdv')}}/" + $('#Filtre').val(),
                method: 'get',
                data: {
                    Rive: $('#Rive').val(),
                    RiveE: $('#RiveE').val(),
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
                            '<tr id="CT_TR"></tr>'   ) ;

                        result.reports.forEach(function (item) {
                            $('#Filter_TR').append( ' <th  >' + item.Filter + '</th> ');
                            $('#NBT_TR').append( '<td><span class="text-danger"><b>' + item.NBT + '</b></span> Bobs</td> ');
                            $('#PT_TR').append( '<td><span class="text-danger"><b>' + item.PT + '</b></span> Tonnes</td>');
                            $('#CT_TR').append( '<td><span class="text-danger"><b>' + item.CT + '</b></span> Tonnes</td>');


                            labels.push(item.Filter);
                            data.push(item.CT);
                        });
                         chartId = 'myBarChart';
                        var max = Math.max.apply(Math, data);
                        DrawChart(chartId, labels, data, $('#Filter').val(), 'Tonnes', max);
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