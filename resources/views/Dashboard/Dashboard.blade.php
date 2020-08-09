@extends('layouts.dashboardTemp')
@section('style')
    <title>Tableau De Bord Rapports Journalier</title>
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
        .border-left-info, .border-left-primary, .border-left-danger,.border-left-success, .border-left-warning {
            border-left-width: 10px!important;
        }
    </style>
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-Dashboard" role="tabpanel"
                 aria-labelledby="nav-Dashboard-tab">

                <section>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-Dashboard-tab" data-toggle="tab"
                               href="#nav-Dashboard" role="tab" aria-controls="nav-Dashboard"
                               aria-selected="true"><b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  " href="{{route('DashboardAdv.index')}}">
                                <b>Rapport Total</b></a>

                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-sm-8">
                            <div class="form-group ">
                                <label class="col-lg-12" style="padding-left: 0" for="Did">Detail Projet</label>
                                <select class="form-control col-12" id="Did" name="Did" onchange="getData()">
                                    @if(isset($details ))
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
                    </div>

                </section>
                <div class="row">
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                            Bobines Préparés
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTM3" class="TCVal"> @if(isset($M3Report) && sizeof($M3Report)>0){{$M3Report[0]->nbT}} @endif</span>
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PTM3" class="TCVal"> @if(isset($M3Report) && sizeof($M3Report)>0){{$M3Report[0]->PT}} @endif</span> T
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Chute:<span id="PCTM3" class="TCVal"> @if(isset($M3Report) && sizeof($M3Report)>0){{$M3Report[0]->PCT}} @endif</span> T
                                        </div>
                                    </div>
                                    {{--<div class="col-auto">--}}
                                        {{--<img src="{{asset('img/bob3.png')}}" width="60px" height="60px" alt="">--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-success shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">

                                            Tubes Produits
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ01" class="TCVal"> @if(isset($FABReport) && sizeof($FABReport)>0){{$FABReport[0]->nbT}} @endif</span>
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ01" class="TCVal"> @if(isset($FABReport) && sizeof($FABReport)>0){{$FABReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ01" class="TCVal"> @if(isset($FABReport) && sizeof($FABReport)>0){{$FABReport[0]->PT}} @endif</span> T
                                        </div>

                                    </div>
                                    {{--<div class="col-auto">--}}
                                        {{--<img src="{{asset('img/pipes-success.png')}}" width="60px" height="60px" alt="">--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">

                                            Contrôle Visuel
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ02" class="TCVal"> @if(isset($VISReport) && sizeof($VISReport)>0){{$VISReport[0]->nbT}} @endif</span>
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ02" class="TCVal"> @if(isset($VISReport) && sizeof($VISReport)>0){{$VISReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ02" class="TCVal"> @if(isset($VISReport) && sizeof($VISReport)>0){{$VISReport[0]->PT}} @endif</span> T
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-warning shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">

                                            Chutage
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ05" class="TCVal"> @if(isset($M17Report) && sizeof($M17Report)>0){{$M17Report[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ05" class="TCVal"> @if(isset($M17Report) && sizeof($M17Report)>0){{$M17Report[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ05" class="TCVal"> @if(isset($M17Report) && sizeof($M17Report)>0){{$M17Report[0]->PT}} @endif</span> T
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-danger shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-danger text-uppercase mb-1">
                                            Visuel Final
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ10" class="TCVal"> @if(isset($VFReport) && sizeof($VFReport)>0){{$VFReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ10" class="TCVal"> @if(isset($VFReport) && sizeof($VFReport)>0){{$VFReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ10" class="TCVal"> @if(isset($VFReport) && sizeof($VFReport)>0){{$VFReport[0]->PT}} @endif</span> T
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">
                                            Tubes Réceptionnés
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ11" class="TCVal"> @if(isset($RecReport) && sizeof($RecReport)>0){{$RecReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ11" class="TCVal"> @if(isset($RecReport) && sizeof($RecReport)>0){{$RecReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ11" class="TCVal"> @if(isset($RecReport) && sizeof($RecReport)>0){{$RecReport[0]->PT}} @endif</span> T
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-success shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                            Tubes Expédis
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ14" class="TCVal"> @if(isset($ExpReport) && sizeof($ExpReport)>0){{$ExpReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ14" class="TCVal"> @if(isset($ExpReport) && sizeof($ExpReport)>0){{$ExpReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ14" class="TCVal"> @if(isset($ExpReport) && sizeof($ExpReport)>0){{$ExpReport[0]->PT}} @endif</span> T
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                            Revêtement Extérieur
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ13" class="TCVal"> @if(isset($RevExtReport) && sizeof($RevExtReport)>0){{$RevExtReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ13" class="TCVal"> @if(isset($RevExtReport) && sizeof($RevExtReport)>0){{$RevExtReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ13" class="TCVal"> @if(isset($RevExtReport) && sizeof($RevExtReport)>0){{$RevExtReport[0]->PT}} @endif</span> T
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-success shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                            Revêtement Intérieur
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ12" class="TCVal"> @if(isset($RevIntReport) && sizeof($RevIntReport)>0){{$RevIntReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Longueur:<span id="LZ12" class="TCVal"> @if(isset($RevIntReport) && sizeof($RevIntReport)>0){{$RevIntReport[0]->LT}} @endif</span> M
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PZ12" class="TCVal"> @if(isset($RevIntReport) && sizeof($RevIntReport)>0){{$RevIntReport[0]->PT}} @endif</span> T
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-warning shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">

                                            Bobines Réceptionnées
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTRecBob" class="TCVal"> @if(isset($RecBobReport) && sizeof($RecBobReport)>0){{$RecBobReport[0]->nbT}} @endif</span>
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; Poids:<span id="PTRecBob" class="TCVal"> @if(isset($RecBobReport) && sizeof($RecBobReport)>0){{$RecBobReport[0]->PT/1000}} @endif</span> T
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-danger shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-danger text-uppercase mb-1">

                                            US Automatique
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTUS" class="TCVal"> @if(isset($USReport) && sizeof($USReport)>0){{$USReport[0]->nbT}} @endif</span> Tubes
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp; NB RB:<span id="NBRBUS" class="TCVal"> @if(isset($USReport) && sizeof($USReport)>0){{$USReport[0]->nbRB}} @endif</span>  Tubes
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                             Radiographie Numérique
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ03" class="TCVal"> @if(isset($RX1Report) && sizeof($RX1Report)>0){{$RX1Report[0]->nbT}}  @endif</span>Tubes
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-danger shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-danger text-uppercase mb-1">

                                            Soudure Manuelle
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ04" class="TCVal"> @if(isset($RepReport) && sizeof($RepReport)>0){{$RepReport[0]->nbT}}  @endif</span>Tubes
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">

                                            Test Hydrostatique
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ06" class="TCVal"> @if(isset($M24Report) && sizeof($M24Report)>0){{$M24Report[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-warning shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                                            Chanfreinage
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ07" class="TCVal"> @if(isset($M25Report) && sizeof($M25Report)>0){{$M25Report[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-danger shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-danger text-uppercase mb-1">
                                            UT Automatique
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ08" class="TCVal"> @if(isset($NDTReport) && sizeof($NDTReport)>0){{$NDTReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">
                                        Contrôle Radioscopique
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTZ09" class="TCVal"> @if(isset($RX2Report) && sizeof($RX2Report)>0){{$RX2Report[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  col-xl-3 col-lg-4 col-sm-6  py-1" >
                        <div class="card border-left-success shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                           Tubes Réfusés
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                            &nbsp;  NB :<span id="NBTDEC" class="TCVal"> @if(isset($VFRReport) && sizeof($VFRReport)>0){{$VFRReport[0]->nbT}}  @endif</span>Tubes
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

        function getData() {
            $('.TCVal').html('');
            // parent = $('#myPieChart').parent();
            // parent.html('');
            // parent.append('<canvas id="myPieChart"></canvas>');
            // labels = [];
            // data = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/Dashboard')}}/" + $('#Did').val(),
                method: 'get',
                data: {
                    poste: $('#poste').val(),
                    date: $('#date').val(),

                },
                success: function (result) {
                    console.log(result);

                    if (result.RecBobReport.length > 0) {
                        $('#NBTRecBob').html(result.RecBobReport[0].nbT);
                        $('#PTRecBob').html(result.RecBobReport[0].PT/1000);
                    }
                    if (result.M3Report.length > 0) {

                        $('#NBTM3').html(result.M3Report[0].nbT);
                        $('#PTM3').html(result.M3Report[0].PT);
                        $('#PCTM3').html(result.M3Report[0].PCT);
                    }
                    if (result.FABReport.length > 0) {

                        $('#NBTZ01').html(result.FABReport[0].nbT);
                        $('#LZ01').html(result.FABReport[0].LT);
                        $('#PZ01').html(result.FABReport[0].PT);
                    }
                    if (result.VISReport.length > 0) {

                        $('#NBTZ02').html(result.VISReport[0].nbT);
                        $('#LZ02').html(result.VISReport[0].LT);
                        $('#PZ02').html(result.VISReport[0].PT);
                    }
                    if (result.M17Report.length > 0) {

                        $('#NBTZ05').html(result.M17Report[0].nbT);
                        $('#LZ05').html(result.M17Report[0].LT);
                        $('#PZ05').html(result.M17Report[0].PT);
                    }
                    if (result.VFReport.length > 0) {
                        $('#NBTZ10').html(result.VFReport[0].nbT);
                        $('#LZ10').html(result.VFReport[0].LT);
                        $('#PZ10').html(result.VFReport[0].PT);
                    }
                    if (result.RecReport.length > 0) {
                        $('#NBTZ11').html(result.RecReport[0].nbT);
                        $('#LZ11').html(result.RecReport[0].LT);
                        $('#PZ11').html(result.RecReport[0].PT);
                    }
                    if (result.ExpReport.length > 0) {
                        $('#NBTZ14').html(result.ExpReport[0].nbT);
                        $('#LZ14').html(result.ExpReport[0].LT);
                        $('#PZ14').html(result.ExpReport[0].PT);
                    }
                    if (result.RevExtReport.length > 0) {
                        $('#NBTZ13').html(result.RevExtReport[0].nbT);
                        $('#LZ13').html(result.RevExtReport[0].LT);
                        $('#PZ13').html(result.RevExtReport[0].PT);
                    }
                    if (result.RevIntReport.length > 0) {
                        $('#NBTZ12').html(result.RevIntReport[0].nbT);
                        $('#LZ12').html(result.RevIntReport[0].LT);
                        $('#PZ12').html(result.RevIntReport[0].PT);
                    }
                    if (result.USReport.length > 0) {
                        $('#NBTUS').html(result.USReport[0].nbT);
                        $('#NBRBUS').html(result.USReport[0].nbRB);
                    }
                    if (result.RX1Report.length > 0) {
                        $('#NBTZ03').html(result.RX1Report[0].nbT);
                    }
                    if (result.RepReport.length > 0) {
                        $('#NBTZ04').html(result.RepReport[0].nbT);
                    }
                    if (result.M24Report.length > 0) {
                        $('#NBTZ06').html(result.M24Report[0].nbT);
                    }
                    if (result.M25Report.length > 0) {
                        $('#NBTZ07').html(result.M25Report[0].nbT);
                    }
                    if (result.NDTReport.length > 0) {
                        $('#NBTZ08').html(result.NDTReport[0].nbT);
                    }
                    if (result.RX2Report.length > 0) {
                        $('#NBTZ09').html(result.RX2Report[0].nbT);
                    }
                    if (result.VFRReport.length > 0) {
                        $('#NBTDEC').html(result.VFRReport[0].nbT);
                    }


                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });

        }
    </script>
@endsection