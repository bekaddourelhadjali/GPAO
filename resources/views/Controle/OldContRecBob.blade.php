@extends('layouts.dashboardTemp')
@section('style')
<style>
    @media (min-width: 576px) {
        #RecBobModal {
            max-width: 1000px;
        }
    }

</style>
@endsection

@section('content')
<div class="container-fluid">
    <section>
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6 col-6" style="margin-top: 10px">
                <h5 class="btn-danger btn" style="width:100%"><b>Bobines Réceptionnées : <span
                            id="NbBobine">@if(isset($NbBobines)){{count ($NbBobines)}}@endif</span> </b></h5>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6" style="margin-top: 10px">
                <input class="form-control" id="dateRapport" type="date" value="{{date('Y-m-d')}}"
                       max="{{date('Y-m-d')}}">
            </div>
        </div>
    </section>
    <section>
        <div class="row" id="rapports">
            @if(isset($rapports))
            {{--{{$rapports}}--}}
            @foreach($rapports as $rapport)
            <div class=" col-xl-4 col-md-6 col-sm-12" style="margin-top:10px; ">
                <div class="card " style="background-color: #b4ecf3">
                    <div class="card-body " id="rapport{{$rapport->Numero}}">
                        <h5 class="card-title text-center "><b><i class="fa fa-user text-white"></i>&nbsp;&nbsp;Agent
                                : <span
                                    id="rapport{{$rapport->Numero}}Agent">{{$rapport->NomAgents}}</span></b>
                        </h5>
                        <hr>
                        <p class="card-text"><b><i class="fa fa-clock text-white"></i>&nbsp;&nbsp;Date
                                Rapport : <span
                                    id="rapport{{$rapport->Numero}}Date">{{$rapport->DateSaisie}}</span>
                            </b></p>
                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-white"></i>&nbsp;&nbsp;&nbsp;N°Rapport
                                : <span id="rapport{{$rapport->Numero}}Id">{{$rapport->Numero}}</span> </b>
                        </p>
                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-white"></i>&nbsp;&nbsp;&nbsp;Bobines
                                Réceptionés :
                                @foreach($rapport->RecBob as $bobine)
                                <span id="Bobine{{$bobine->Id}}" class=" btn btn-success"
                                      style="margin-top:5px">{{$bobine->Bobine}}</span>
                                @endforeach </b></p>
                        <div class="text-center">
                            <button data-toggle="modal"
                                    data-target="#RecBobBackdrop" id="View{{$rapport->Numero}}Rapport"
                                    class=" ViewRapport btn btn-primary btn-icon-split"
                                    style="margin-top: 10px">
                                <span class="icon text-white-50"><i class="fas fa-file"></i> </span>
                                <span class="text">Afficher</span>
                            </button>
                            @if($rapport->Etat!='N')
                            <button id="Decloturer{{$rapport->Numero}}Rapport"
                                    class=" DecloturerRapport btn btn-danger btn-icon-split"
                                    style="margin-top: 10px">
                                <span class="icon text-white-50"><i class="fas fa-times"></i> </span>
                                <span class="text">Déclôturer</span>
                            </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </section>
</div>

<!--Rapport RecBob Modal-->
<div class="modal fade" id="RecBobBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
     style="padding-right: 0"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  " role="document" id="RecBobModal">
        <div class="modal-content " style="overflow: auto;   ">
            <div class="modal-header  ">
                <div class="col-10 modal-title">
                    <div class="input-group mb-3">

                        <label class="col-6 col-sm-6 text-success "
                               style="margin-bottom:0; font-size: 25px; font-weight: bolder">Numéro de Rapport : <span id="NumRapModal"></span></label>

                    </div>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"

                                                              class="btn btn-danger"><b>X</b></button></span>
                </button>
            </div>
            <div class="modal-body  ">
                <h5 class="text-center">Bobines Réceptionnées</h5>
                <div class="table-container">
                    <table id="RecBobTable" class="table table-striped table-hover table-borderless rapprods ">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th>Arrivage</th>
                            <th>Coulee</th>
                            <th>Bobine</th>
                            <th>Poids</th>
                            <th>Epaisseur</th>
                            <th>Fournisseur</th>
                            <th>N°Reception</th>
                            <th>Date Reception</th>
                            <th>Source</th>
                            <th>N°Bon</th>

                        </tr>
                        </thead>
                        <tbody id="RecBobs">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection


@section('script')
<script>
    $(document).ready(function () {
        AddListeners();
        $('#dateRapport').change(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/ContRecBob/')}}/" + $('#dateRapport').val(),
                method: 'get',
                data: {
                    source: 'ajax'
                },
                success: function (result) {
                    $('#rapports').html('');
                    result.rapports.forEach(function (item, index) {
                        var card = '<div class=" col-xl-4 col-md-6 col-sm-12" style="margin-top:10px; ">\n' +
                            '                            <div class="card "  style="background-color: #b4ecf3">\n' +
                            '                                <div class="card-body " id="rapport' + item.Numero + '">\n' +
                            '                                    <h5 class="card-title text-center "><b><i class="fa fa-user text-white"></i>&nbsp;&nbsp;Agent : <span\n' +
                            '                                                    id="rapport' + item.Numero + 'Agent">' + item.NomAgents + '</span></b>\n' +
                            '                                    </h5>\n' +
                            '                                    <hr>\n' +
                            '                                    <p class="card-text"><b><i class="fa fa-clock text-white"></i>&nbsp;&nbsp;Date\n' +
                            '                                            Rapport : <span\n' +
                            '                                                    id="rapport' + item.Numero + 'Date">' + item.DateSaisie + '</span>\n' +
                            '                                        </b></p>\n' +
                            '                                    <p class="card-text"><b><i class="fa fa-map-marker-alt text-white"></i>&nbsp;&nbsp;&nbsp;N°Rapport\n' +
                            '                                            : <span id="rapport' + item.Numero + 'Id">' + item.Numero + '</span> </b>\n' +
                            '                                    </p>\n' +
                            '                                    <p class="card-text"><b><i class="fa fa-map-marker-alt text-white"></i>&nbsp;&nbsp;&nbsp;Bobines Réceptionés : &nbsp;&nbsp;';

                        var bobines = "";
                        item.rec_bob.forEach(function (bobine, index) {
                            bobines += '<span id="Bobine' + bobine.Id + '" class=" btn btn-success" style="margin-top:5px">' + bobine.Bobine + '</span>';
                        });
                        card += bobines;
                        card += '</b></p>\n' +
                            '                                    <div class="text-center">\n' +
                            '                                        <button id="View' + item.Numero + 'Rapport"  data-toggle="modal"\n' +
                            'data-target="#RecBobBackdrop" class=" ViewRapport btn btn-primary btn-icon-split" style="margin-top: 10px">\n' +
                            '                                            <span class="icon text-white-50"><i class="fas fa-file"></i> </span>\n' +
                            '                                            <span class="text">Afficher</span>\n' +
                            '                                        </button>\n';
                        if(item.Etat!=='N') card+='                                        <button id="Decloturer' + item.Numero + 'Rapport"  class=" DecloturerRapport btn btn-danger btn-icon-split" style="margin-top: 10px">\n' +
                            '                                            <span class="icon text-white-50"><i class="fas fa-times"></i> </span>\n' +
                            '                                            <span class="text">Déclôturer</span>\n' +
                            '                                        </button>\n';

                        card+= '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </div>';

                        $('#rapports').append(card);
                        $('#NbBobine').html(result.NbBobines[0].count);
                        AddListeners();
                    });
                },
                error: function (result) {
                    alert(result.responseJSON.message);
                    console.log(result)
                }
            });
        });
        function AddListeners(){
            $('.ViewRapport').each(function () {
                $('.ViewRapport').off('click');
                $('.ViewRapport').click(function(){
                    const NumRap= $(this).attr("id").replace(/[^0-9]/g, '');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('/ContRecBob/')}}/" + NumRap+"/edit",
                        method: 'get',
                        data: {
                        },
                        success: function (result) {
                            $('#RecBobs').html("");
                            result.RecBobs.forEach(function(item,index){
                                $('#RecBobs').append( '<tr>' +
                                    '<td>'+item.Arrivage+'</td>'+
                                    '<td>'+item.Coulee+'</td>'+
                                    '<td>'+item.Bobine+'</td>'+
                                    '<td>'+item.Poids+'</td>'+
                                    '<td>'+item.Epaisseur+'</td>'+
                                    '<td>'+item.Fournisseur+'</td>'+
                                    '<td>'+item.NbReception+'</td>'+
                                    '<td>'+item.DateRec+'</td>'+
                                    '<td>'+item.Source+'</td>'+
                                    '<td>'+item.NbBon+'</td>'+
                                    '</tr>');
                            });
                        },
                        error:function(result){
                            alert(result.responseJSON.message);
                            console.log(result);
                        }

                    });
                });
            });

            $('.DecloturerRapport').each(function () {
                $('.DecloturerRapport').off('click');
                $('.DecloturerRapport').click(function(){
                    const NumRap= $(this).attr("id").replace(/[^0-9]/g, '');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('/Decloturer/')}}/" + NumRap,
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                        },
                        success: function (result) {
                            $('#Decloturer'+NumRap+'Rapport').hide();
                        },
                        error:function(result){
                            alert(result.responseJSON.message);
                            console.log(result);
                        }

                    });
                });
            });
        }
    });
</script>
@endsection