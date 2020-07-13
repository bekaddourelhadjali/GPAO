@extends('layouts.dashboardTemp')
@section('style')
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }
        .table-container{
            width: 100%;
            overflow: auto;
            max-height: 400px;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <section>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <input class="form-control" type="date" value="{{date('Y-m-d')}}">
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-12">
                    @if(isset($rapports))
                        @foreach($rapports as $rapport)
                    <div class=" col-lg-3  col-md-4 col-sm-6" >
                        <div class="card">
                            <div class="card-body " id="location{{$rapport->id}}">
                                <h5 class="card-title text-center "><b>Agent : <span id="location{{$rapport->id}}Agent">{{$rapport->Agent}}</span></b></h5>
                                <hr>
                                <p class="card-text"><b><i class="fa fa-desktop text-warning"></i>&nbsp;&nbsp;Date Rapport : <span id="location{{$rapport->id}}AdresseIp">{{$location->AdresseIp}}</span> </b></p>
                                <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;N°Rapport : <span id="location{{$rapport->id}}Zone">{{$location->Zone}}</span>  </b></p>
                                <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;Bobines Réceptionés : <span class=" btn btn-info" style="margin-top:5px">5441984651</span><span class=" btn btn-info" style="margin-top:5px">5441984651</span>  </b></p>
                                <div class="text-center">
                                    <button type="button" id="Edit{{$rapport->id}}Location" class="EditLocation btn btn-primary" style="width:35px; height:35px; padding:0;" data-dismiss="modal"><i class="fa fa-edit"></i></button>
                                    <button type="button" id="Supprimer{{$rapport->id}}Location" style="width:35px; height:35px; padding:0;" class="SupprimerLocation btn btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        @endif
                </div>

            </div>
        </section>
    </div>





@endsection


@section('script')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection