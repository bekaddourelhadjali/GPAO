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

    </style>
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-FABReport" role="tabpanel"
                 aria-labelledby="nav-FABReport-tab ">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('FabDailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link active " id="nav-FABReport-tab" data-toggle="tab"
                               href="#nav-FABReport" role="tab" aria-controls="nav-FABReport" aria-selected="true"><b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  "  href="{{route('FabRepAdv.index')}}"><b>Filtres Avancés</b></a>

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
                        <div class="card border-left-success shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">

                                            Longueur t <span class="MonthRep">
                                                    ({{$monthW}})</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-danger">
                                            <span id="MonthLT">{{$MonthLT}}</span>
                                            Mètres
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="MonthPT">{{$MonthPT}}</span>
                                            Tonnes
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ruler-horizontal fa-2x text-success"></i>
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

                    <div class="col-xl-3 col-md-6 py-1">
                        <div class="card border-left-warning shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                                            Longueur T <span class="YearRep">({{date('Y')}})</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-danger">
                                            <span id="YearLT">{{$YearLT}}</span>
                                            Mètres
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="YearPT">{{$YearPT}}</span>
                                            Tonnes
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ruler-horizontal fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <table class="table table-borderless table-striped" id="FABReportTable" width="120%" cellspacing="0">
                                     <thead style="cursor: pointer">
                                    <tr class="text-white">
                                        <th>DateSaisie</th>
                                        <th>Epaisseur</th>
                                        <th>Diametre</th>
                                        <th>Poste</th>
                                        <th>Machine</th>
                                        <th>Coulee</th>
                                        <th>Bobine</th>
                                        <th>NBT</th>
                                        <th>PoidsTotal</th>
                                        <th>LongueurTotal</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr  style="display: table-row;" >
                                                <td>{{$item->DateSaisie}}</td>
                                                <td>{{$item->Epaisseur}}</td>
                                                <td>{{$item->Diametre}}</td>
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Machine}}</td>
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{$item->Bobine}}</td>
                                                <td>{{$item->NBT}}</td>
                                                <td>{{$item->PoidsTotal}}</td>
                                                <td>{{$item->LongueurTotal}}</td>
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
            </div>
        </div>
    </div>





@endsection


@section('script')

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

    <script>

        $(document).ready(function () {

            $('#FABReportTable').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]});
            calculateColumn(7); calculateColumn(8); calculateColumn(9);
        $('#FABReportTable_filter input[type=search]').keyup(function () {
            calculateColumn(7); calculateColumn(8); calculateColumn(9);
        });
        });

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/FabReport')}}/" + $('#Did').val(),
                method: 'get',
                data: {
                },
                success: function (result) {
                    $('#FABReportTable').DataTable().clear().draw();
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#FABReportTable').DataTable().row.add([
                                item.DateSaisie,
                                item.Epaisseur,
                                item.Diametre,
                                "Poste "+item.Poste,
                                item.Machine,
                                item.Coulee,
                                item.Bobine,
                                item.NBT,
                                item.PoidsTotal,
                                item.LongueurTotal,]
                            );

                        });
                        $('#FABReportTable').DataTable().draw(false);
                        $('#FABReportTable tbody tr').attr('style','display: table-row;');
                    }
                    $('#MonthNBT').html(result.MonthNBT);
                    $('#MonthLT').html(Number(Math.round(result.MonthLT+'e3')+'e-3'));
                    $('#MonthPT').html(Number(Math.round(result.MonthPT+'e3')+'e-3'));
                    $('#YearNBT').html(result.YearNBT);
                    $('#YearLT').html(Number(Math.round(result.YearLT+'e3')+'e-3'));
                    $('#YearPT').html(Number(Math.round(result.YearPT+'e3')+'e-3'));
                    
                    calculateColumn(7); calculateColumn(8); calculateColumn(9);
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });
        }
    </script>
@endsection