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
            <div class="tab-pane fade show active" id="nav-RecBobReport" role="tabpanel"
                 aria-labelledby="nav-RecBobReport-tab">

                <section>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-RecBobReport-tab" data-toggle="tab"
                               href="#nav-RecBobReport" role="tab" aria-controls="nav-RecBobReport"
                               aria-selected="true"><b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  " href="{{route('M3Report.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  " href="{{route('M3RepAdv.index')}}"><b>Filtres Avancés</b></a>

                        </div>
                    </nav>
                    <br>
                    <div class="row">
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
                <div class="row">
                    <div class="col-md-4 py-1">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                            NB total des Bobines
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           &nbsp; <span id="NBT"> @if(isset($nbT)){{$nbT}} @endif</span>
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

                    <div class="col-md-4 py-1">
                        <div class="card border-left-success shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">

                                            poids total des Bobines
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="PT">@if(isset($pT)){{($pT)}} @endif</span>
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
                    <div class="col-md-4 py-1">
                        <div class="card border-left-warning shadow h-100 ">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                                            poids total des Chutes
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="PCT">@if(isset($pCT)){{($pCT)}} @endif</span>
                                            Tonnes
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cut fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="RecBobReportTableContainer">
                                <table class="table table-borderless table-striped" id="RecBobReportTable" width="120%"
                                       cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white">
                                        <th>Poste</th>
                                        <th>Coulee</th>
                                        <th>Bobine</th>
                                        <th>Poids</th>
                                        <th>Epaisseur</th>
                                        <th>Diametre</th>
                                        <th>Arrivage</th>
                                        <th>LARG_BANDE</th>
                                        <th>ChuteTotal</th>
                                        <th>LargeMoy</th>
                                        <th>EpaisMoy</th>
                                        <th>Chutes</th>
                                        <th>Test</th>
                                        <th>Agent</th>
                                        <th>Observation</th>
                                        <th>Machine_E</th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($reports))

                                        @foreach($reports as $item)
                                            <tr id="report{{$item->Id}}" rapportEtat="{{$item->rapEtat}}"
                                                rapportId="{{$item->NumeroRap}}">
                                                <td>Poste {{$item->Poste}}</td>
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{$item->Bobine}}</td>
                                                <td>{{$item->Poids}}</td>
                                                <td>{{$item->Epaisseur}}</td>
                                                <td>{{$item->Diametre}}</td>
                                                <td>{{$item->Arrivage}}</td>
                                                <td>{{$item->LargeurBande}}</td>
                                                <td>{{$item->ChuteTotal}}</td>
                                                <td>{{$item->LargeMoy}}</td>
                                                <td>{{$item->EpMoy}}</td>
                                                <td>{{$item->Chutes }}</td>
                                                <td>{{(int)$item->Test1 }}</td>
                                                <td>{{$item->User }}</td>
                                                <td>{{$item->Observation }}</td>
                                                <td>{{str_replace("Prep",'',$item->Etat)}}</td>
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
            </div>
        </div>
    </div>





@endsection


@section('script')

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        var table = $('#RecBobReportTable').DataTable({
            "bDestroy": true,"lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]],
            "bRetrieve": true
        });
        $(document).ready(function () {

            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

            addActions();

            $('.reportEdit').click(function () {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                const reportId= $(this).attr("id").replace(/[^0-9]/g, '');
                if($('#RecBobReportTable tbody tr#report'+reportId+' td:last-child').html()==='MasE')

                var win = window.open("{{url('/MasEPrep/')}}/" + id, '_blank');
                else
                    var   win= window.open("{{url('/M3/')}}/" + id, '_blank');
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
            $("#Reports TR").each(function () {
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
                    var height = ((($(this).height()) - $('#tr-actions').height()) / 2) + $('#RecBobReportTable_wrapper .row').height() + 5;
                    var width = (($('#RecBobReportTableContainer').width() - $('#tr-actions').width()) / 2);
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
                url: "{{url('/M3DailyRep')}}/" + $('#date').val(),
                method: 'get',
                data: {
                    poste: $('#poste').val(),
                    Rive: $('#Rive').val(),
                    RiveE: $('#RiveE').val(),

                },
                success: function (result) {

                    table.clear().draw();
                    $('#NBT').html('');
                    $('#PT').html('');
                    $('#PCT').html('');
                    if (result.reports.length > 0){
                        result.reports.forEach(function (item) {
                            $('#RecBobReportTable').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]}).row.add([
                                'Poste '+item.Poste,
                                item.Coulee,
                                item.Bobine,
                                item.Poids,
                                item.Epaisseur,
                                item.Diametre,
                                item.Arrivage,
                                item.LargeurBande,
                                item.ChuteTotal,
                                item.LargeMoy,
                                item.EpMoy,
                                item.Chutes,
                                +item.Test1,
                                item.User,
                                item.Observation,
                                item.Etat.replace('Prep', '')]
                            ).draw(false);
                            $('#RecBobReportTable tbody tr:last-child')
                                .attr('id','report'+item.Id).attr('rapportEtat',item.rapEtat).attr('rapportId',item.NumeroRap);
                        });
                        $('#NBT').html(result.nbT);
                        $('#PT').html(result.pT);
                        $('#PCT').html(result.pCT);

                        addActions();
                    }

                },
                error: function (result) {
                    alert(result.responseJSON.message);
                }
            });

        }
    </script>
@endsection