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
        }

    </style>
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-RecBobReport" role="tabpanel"
                 aria-labelledby="nav-RecBobReport-tab">

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  "  href="{{route('RecBobDailyRep.index')}}">
                                <b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link active " id="nav-RecBobReport-tab" data-toggle="tab"
                               href="#nav-RecBobReport" role="tab" aria-controls="nav-RecBobReport" aria-selected="true"><b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  "  href="{{route('RecBobRepAdv.index')}}"><b>Filtres Avancés</b></a>

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
                        <div class=" col-lg-3 col-sm-4 col-6">
                            <div class="form-group ">
                                <label class="col-lg-12" for="date">La Date: </label>
                                <input class="form-control" type="date" value="" id="date" max="{{date('Y-m-d')}}"
                                       onchange="filterTab('date','RecBobReportTable')">
                            </div>
                        </div>
                        <div class=" col-lg-4 col-sm-4 col-6">

                            <label class="col-lg-12" for="filterTxt">Rechercher: </label>
                            <div class="input-group-append ">
                                <input class="form-control" aria-describedby="basic-addon2" onkeyup="filterTab('filterTxt','RecBobReportTable')"
                                       type="text"
                                       id="filterTxt">
                                <div class="input-group-append">
                                    <button onclick="refreshData()" class="btn btn-danger"><i class="fa fa-times-circle"></i>
                                    </button>
                                </div>
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

                                            NB t <span class="MonthRep">@if(isset($MonthRep))
                                                    ({{$MonthRep->Month}})
                                                     @endif </span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="MonthNBT"> @if(isset($MonthRep)){{$MonthRep->NBT}} @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('img/bob3.png')}}" width="60px" height="40px" alt="">
                                        {{--<i class="fas fa-calendar fa-2x text-gray-300"></i>--}}
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

                                            poids t <span class="MonthRep">@if(isset($MonthRep))
                                                    ({{$MonthRep->Month}})</span> @endif
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="MonthPT">@if(isset($MonthRep)){{($MonthRep->PT)/1000}} @endif</span>
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
                                            NB T <span class="YearRep"> @if(isset($YearRep))({{ $YearRep->Year }})
                                                 @endif</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="YearNBT"> @if(isset($YearRep)){{$YearRep->NBT}}  @endif</span>
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
                                            poids t <span class="YearRep">@if(isset($YearRep))({{ $YearRep->Year }})
                                                 @endif</span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="YearPT">@if(isset($YearRep)){{($YearRep->PT)/1000}} @endif</span>
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
                                <table class="table table-borderless table-striped" id="RecBobReportTable" width="120%" cellspacing="0">
                                {{--<table class="col-12 table table-borderless  table-striped" id="RecBobReportTable">--}}
                                    <thead style="cursor: pointer">
                                    <tr class="text-white">
                                        <th >PROJET </th>
                                        <th >DATE_REC </th>
                                        <th >DIAMETRE </th>
                                        <th >EPAISSEUR </th>
                                        <th >ARRIVAGE </th>
                                        <th >LARG_BANDE </th>
                                        <th >FOURNISSEUR </th>
                                        <th >PROVENANCE </th>
                                        <th >NB </th>
                                        <th >POIDS </th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">


                                    @if(isset($RecBobReport))
                                        @foreach($RecBobReport as $item)
                                            <tr style="display: table-row;">
                                                <td>{{$item->Nom}}</td>
                                                <td>{{$item->DateRec}}</td>
                                                <td>{{$item->Diametre}}</td>
                                                <td>{{$item->Epaisseur}}</td>
                                                <td>{{$item->Arrivage}}</td>
                                                <td>{{$item->LargeurBande}}</td>
                                                <td>{{$item->Fournisseur}}</td>
                                                <td>{{$item->Source}}</td>
                                                <td>{{$item->NbTotal }}</td>
                                                <td>{{$item->PoidsTotal }}</td>
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
            $('#RecBobReportTable').DataTable({
            "bDestroy": true,
            "bRetrieve": true
        });
            $('#RecBobReportTable_filter').remove();
            calculateColumn(8); calculateColumn(9);
            // $('th').each(function () {
            //     var nbclick = 0;
            //     $(this).click(function () {
            //         $('th').find('i.fa').removeClass('fa-angle-up').removeClass('fa-angle-down');
            //         nbclick++;
            //         if (nbclick % 2 === 0) {
            //             $(this).find('i.fa').addClass('fa-angle-down');
            //             $(this).find('i.fa').removeClass('fa-angle-up');
            //         } else {
            //
            //             $(this).find('i.fa').addClass('fa-angle-up');
            //             $(this).find('i.fa').removeClass('fa-angle-down');
            //         }
            //
            //     });
            // });


        });

        function filterTab(input, tab) {
            var value = $("#" + input).val().toLowerCase();
            $("#" + tab + " tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            $('#RecBobReportTable').DataTable({
                "bDestroy": true,
                "bRetrieve": true
            });
            calculateColumn(8); calculateColumn(9);

        }

        function getData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/RecBobReport')}}/" + $('#Did').val(),
                method: 'get',
                data: {},
                success: function (result) {
                    $('#Reports').html('');
                    $('#date').val('');
                    $('#filterTxt').val('');
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#Reports').append(' <tr style="display: table-row;">\n' +
                                '                                                <td>' + item.Nom + '</td>\n' +
                                '                                                <td>' + item.DateRec + '</td>\n' +
                                '                                                <td>' + item.Diametre + '</td>\n' +
                                '                                                <td>' + item.Epaisseur + '</td>\n' +
                                '                                                <td>' + item.Arrivage + '</td>\n' +
                                '                                                <td>' + item.LargeurBande + '</td>\n' +
                                '                                                <td>' + item.Fournisseur + '</td>\n' +
                                '                                                <td>' + item.Source + '</td>\n' +
                                '                                                <td>' + item.NbTotal + '</td>\n' +
                                '                                                <td>' + item.PoidsTotal + '</td>\n' +
                                '                                                </tr>');
                        });
                    }
                    if (result.MonthRep != null) {
                        $('.MonthRep').html('(' + result.MonthRep.Month + ')');
                        $('#MonthNBT').html(result.MonthRep.NBT);
                        $('#MonthPT').html(result.MonthRep.PT / 1000);
                    } else {
                        $('.MonthRep').html('');
                        $('#MonthNBT').html('0');
                        $('#MonthPT').html('0');
                    }
                    if (result.YearRep != null) {
                        $('.YearRep').html('(' + result.YearRep.Year + ')');
                        $('#YearNBT').html(result.YearRep.NBT);
                        $('#YearPT').html(result.YearRep.PT / 1000);
                    } else {
                        $('.YearRep').html('');
                        $('#YearNBT').html('0');
                        $('#YearPT').html('0');
                    }

                    $('#RecBobReportTable').DataTable({
                        "bDestroy": true,
                        "bRetrieve": true
                    });
                    calculateColumn(8); calculateColumn(9);
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });
        }

        function refreshData() {

            $('#date').val('');
            $('#filterTxt').val('');
            filterTab('date', 'RecBobReportTable');
            calculateColumn(8); calculateColumn(9);
        }

    </script>
@endsection