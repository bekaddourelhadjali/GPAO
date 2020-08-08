@extends('layouts.dashboardTemp')
@section('style')
    <title>Rapports De Réception Des Bobines</title>
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

                <section >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-RecBobReport-tab" data-toggle="tab"
                               href="#nav-RecBobReport" role="tab" aria-controls="nav-RecBobReport" aria-selected="true"><b>Rapport Journalier</b></a>
                            <a class="nav-item nav-link  "  href="{{route('RecBobReport.index')}}">
                                <b>Filtrage par détails de projet</b></a>
                            <a class="nav-item nav-link  "  href="{{route('RecBobRepAdv.index')}}"><b>Filtres Avancés</b></a>

                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <div class=" col-lg-3 col-md-4 col-6">
                            <div class="form-group ">
                                <label class="col-lg-12" for="date">La Date: </label>
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="date" max="{{date('Y-m-d')}}"
                                       onchange="getData()">
                            </div>
                        </div>
                        <div class="col-md-4 py-1">
                            <div class="card border-left-info shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-info text-uppercase mb-1">

                                                NB total des Bobines
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="NBT"> @if(isset($nbT)){{$nbT}} @endif</span>
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
                    </div>
                </section>
                <br>
                <div class="row">

                </div>
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container" id="RecBobReportTableContainer">
                                <table class="table table-borderless table-striped" id="RecBobReportTable" width="120%" cellspacing="0">

                                    <thead style="cursor: pointer" id="TheadID">
                                    <tr class="text-white" >
                                        <th >Coulee </th>
                                        <th >Bobine</th>
                                        <th >Poids</th>
                                        <th >EPAISSEUR </th>
                                        <th >ARRIVAGE </th>
                                        <th >LARG_BANDE </th>
                                        <th >FOURNISSEUR </th>
                                        <th >NbReception </th>
                                        <th >PROVENANCE </th>
                                        <th >NbBon </th>
                                        <th >Agent </th>
                                    </tr>
                                    </thead>
                                    <tbody id="Reports">

                                    @if(isset($RecBobReport))

                                        @foreach($RecBobReport as $item)
                                            <tr id="report{{$item->Id}}" rapportEtat="{{$item->rapport->Etat}}" rapportId="{{$item->NumeroRap}}">
                                                <td>{{$item->Coulee}}</td>
                                                <td>{{$item->Bobine}}</td>
                                                <td>{{$item->Poids}}</td>
                                                <td>{{$item->Epaisseur}}</td>
                                                <td>{{$item->Arrivage}}</td>
                                                <td>{{$item->LargeurBande}}</td>
                                                <td>{{$item->Fournisseur}}</td>
                                                <td>{{$item->NbReception}}</td>
                                                <td>{{$item->Source}}</td>
                                                <td>{{$item->NbBon }}</td>
                                                <td>{{$item->User }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>@if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

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

        $(document).ready(function () {
            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == "Chef Production")

            addActions();

            $('.reportEdit').click(function () {
                const id = $(this).attr("rapportId").replace(/[^0-9]/g, '');
                var win = window.open("{{url('/RecBob/')}}/"+id, '_blank');
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
            $('#RecBobReportTable').DataTable({
                "bDestroy": true,
                "bRetrieve": true
            });
            reportID=0;
            $("#Reports TR").each(function () {
                $(this).off('mouseenter');
                $(this).mouseenter(function () {
                    rapportID=$(this).attr('rapportId');

                    $(this).css({
                        'color': '#858796',
                        'background-color': 'rgba(0,0,0,.075)'
                    });

                    var o = $(this);
                    var offset = o.offset();
                    const id = $(this).attr("id").replace(/[^0-9]/g, '');
                    reportID=id;
                    $('#tr-actions .reportDelete').each(function () {
                        $(this).attr('id', 'report' + id + 'Delete');
                        $('#tr-actions #report'+id+'Delete').attr('rapportId',rapportID);
                    });


                    $('#tr-actions .reportEdit').each(function () {
                        $(this).attr('id', 'report' + id + 'Edit');
                    });
                    var height = ((($(this).height()) - $('#tr-actions').height()) / 2)+$('#RecBobReportTable_wrapper .row').height()+5;
                    var width = (($('#RecBobReportTableContainer').width() - $('#tr-actions').width()) / 2 );
                    if($(this).attr('rapportEtat')=='C'){
                        $('#tr-actions #report'+id+'Delete').html("Déclôturer").addClass("btn-danger").removeClass("btn-success");

                    }else{
                        $('#tr-actions #report'+id+'Delete').html("Clôturer").addClass("btn-success").removeClass("btn-danger");
                    }
                    $('#tr-actions #report'+id+'Edit').attr('rapportId',$(this).attr("rapportId"));
                    $('#tr-actions').css({
                        'top': (offset.top - $('.table').offset().top) + height,
                        'left': width,
                    }).show();

                })
                    .mouseleave(function () {
                        $('#report' + reportID).css({
                            'color': '#000',
                            'background-color': '#fff'
                        });
                        $('#tr-actions').hide();
                    });
            });

        }

        $('.reportDelete').each(function(){
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
                Etat='N';
                if($(this).html()==='Clôturer') Etat='C'
                $.ajax({
                    url: "{{url('/RapportState')}}/" + id,
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        Etat:Etat
                    },
                    success: function (result) {
                        if (result.rapportState.Etat === 'C') {
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');

                        }
                        else{
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Décloturé avec succès');

                        }

                        $('#Reports tr[rapportId='+id+'] ').attr("rapportEtat",result.rapportState.Etat);



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
            $('#report' + reportID ).css({
                'color': '#858796',
                'background-color': 'rgba(0,0,0,.075)'
            });
        });
        $('#tr-actions').mouseleave(function () {
            $(this).hide();
            $('#report' +  reportID).css({
                'color': '#000',
                'background-color': '#fff'
            });
        });
        @endif
        function getData() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/RecBobDailyRep')}}/" + $('#date').val(),
                method: 'get',
                data: {},
                success: function (result) {
                    $('#Reports').html('');
                    $('#NBT').html('');
                    $('#PT').html('');
                    if (result.reports.length > 0) {
                        result.reports.forEach(function (item) {
                            $('#Reports').append(' <tr style="display: table-row;" id="report'+item.Id+'" rapportEtat="'+item.Etat+'" rapportId="'+item.NumeroRap+'">\n' +
                                '                                                <td>' + item.Coulee+'</td>'+
                                '                                                <td>' + item.Bobine+'</td>'+
                                '                                                <td>' + item.Poids+'</td>'+
                                '                                                <td>' + item.Epaisseur+'</td>'+
                                '                                                <td>' + item.Arrivage+'</td>'+
                                '                                                <td>' + item.LargeurBande+'</td>'+
                                '                                                <td>' + item.Fournisseur+'</td>'+
                                '                                                <td>' + item.NbReception+'</td>'+
                                '                                                <td>' + item.Source+'</td>'+
                                '                                                <td>' + item.NbBon +'</td>'+
                                '                                                <td>' + item.User +'</td>'+
                                '                                                </tr>');
                        });
                $('#NBT').html(result.nbT);
                $('#PT').html(result.pT);
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