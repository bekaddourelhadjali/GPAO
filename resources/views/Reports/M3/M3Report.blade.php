@extends('layouts.dashboardTemp')
@section('style')
    <title>Rapports De Préparation des Bobines</title>
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
            <div class="tab-pane fade show active" id="nav-M3Report" role="tabpanel"
                 aria-labelledby="nav-M3Report-tab ">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('M3DailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link active " id="nav-M3Report-tab" data-toggle="tab"
                               href="#nav-M3Report" role="tab" aria-controls="nav-M3Report" aria-selected="true"><b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  "  href="{{route('M3RepAdv.index')}}"><b>Filtres Avancés</b></a>

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
                                        <img src="{{asset('img/bob3.png')}}" width="60px" height="40px" alt="">

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

                                            poids t <span class="MonthRep">
                                                    ({{$monthW}})</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="MonthPT">{{$MonthPT}}</span>
                                            Tonnes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-danger">
                                            <span id="MonthCT">{{$MonthCT}}</span>
                                            Tonnes
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-balance-scale fa-2x text-success"></i>
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
                                        <img src="{{asset('img/bob3prim.png')}}" width="60px" height="40px" alt="">
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
                                            poids t <span class="YearRep">({{date('Y')}})</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="YearPT">{{$YearPT}}</span>
                                            Tonnes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-danger">
                                            <span id="YearCT">{{$YearCT}}</span>
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
                            <div class="table-container">
                                <table class="table table-borderless table-striped" id="M3ReportTable" width="120%" cellspacing="0">
                                     <thead style="cursor: pointer">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>DateSaisie</th>
                                        <th>Projet</th>
                                        <th>Epaisseur</th>
                                        <th>Diametre</th>
                                        <th>Arrivage</th>
                                        <th>LARG_BANDE</th>
                                        <th>Coulee</th>
                                        <th>MasE</th>
                                        <th>NBT</th>
                                        <th>PoidsTotal</th>
                                        <th>ChuteTotal</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr  style="display: table-row;" >
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->DateSaisie}}</td>
                                                <td>{{$item->Nom}}</td>
                                                <td>{{$item->Epaisseur}}</td>
                                                <td>{{$item->Diametre}}</td>
                                                <td>{{$item->Arrivage}}</td>
                                                <td>{{$item->LargeurBande}}</td>
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{str_replace("Prep",'',$item->Etat)}}</td>
                                                <td>{{$item->NBT}}</td>
                                                <td>{{$item->PoidsTotal}}</td>
                                                <td>{{$item->ChuteTotal}}</td>
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
                                    <td></td>
                                    <td> </td>
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

            $('#M3ReportTable').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]});
            calculateColumn(9); calculateColumn(10); calculateColumn(11);
        $('#M3ReportTable_filter input[type=search]').keyup(function () {
            calculateColumn(9); calculateColumn(10); calculateColumn(11);
        });
        });

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/M3Report')}}/" + $('#Did').val(),
                method: 'get',
                data: {
                    Rive: $('#Rive').val(),
                    RiveE: $('#RiveE').val(),
                },
                success: function (result) {
                    $('#M3ReportTable').DataTable().clear().draw();
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#M3ReportTable').DataTable().row.add([
                                'Poste '+item.Poste,
                                item.DateSaisie,
                                item.Nom,
                                item.Epaisseur,
                                item.Diametre,
                                item.Arrivage,
                                item.LargeurBande,
                                item.Coulee,
                                item.Etat.replace('Prep', ''),
                                item.NBT,
                                item.PoidsTotal,
                                item.ChuteTotal,]
                            );

                        });
                        $('#M3ReportTable').DataTable().draw(false);
                        $('#M3ReportTable tbody tr').attr('style','display: table-row;');
                    }
                    $('#MonthNBT').html(result.MonthNBT);
                    $('#MonthCT').html(Number(Math.round(result.MonthCT+'e3')+'e-3'));
                    $('#MonthPT').html(Number(Math.round(result.MonthPT+'e3')+'e-3'));
                    $('#YearNBT').html(result.YearNBT);
                    $('#YearCT').html(Number(Math.round(result.YearCT+'e3')+'e-3'));
                    $('#YearPT').html(Number(Math.round(result.YearPT+'e3')+'e-3'));
                    calculateColumn(9); calculateColumn(10); calculateColumn(11);
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });
        }
    </script>
@endsection