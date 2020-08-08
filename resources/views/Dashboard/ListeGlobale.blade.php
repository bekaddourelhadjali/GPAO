@extends('layouts.dashboardTemp')
@section('style')

    <title>Liste Globale Des Tubes</title>
    <style>
        @media (min-width: 576px) {
            #RecBobModal {
                max-width: 1000px;
            }
        }

        @media (min-width: 576px) {
            button.offset-sm-4 {
                margin-left: 33.33333%;
                margin-top: 15px;
            }
            .Zone {
                 width: 14.28%!important;
             }

        }

        @media (min-width: 992px) {
            button.offset-lg-0 {
                margin-left: 0;
                margin-top: 0;
            }
        }

        .Zone {
            padding: 5px;
            width: 20%;
        }
        .imgZone {
            margin-top: 5px;
            width: 30px;
            height: 30px;
        }

        #ListeGlobaleTable, #ListeGlobaleTable th, #ListeGlobaleTable td {
            border-color: #aaa;
        }

        .Selected {
            background-color: #90e0ef;
        }
        .dataTables_empty{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        @php
                @endphp
        <section>
            <div class="row">
                <div class="col-lg-7 col-12 col-lg-" style="margin-top: 10px">
                    <div class="form-group  row">
                        <label class="col-12 col-md-4" for="Did" style="text-align: center; font-size: 20px"><b>Détails
                                Du Projet</b></label>
                        <select class="form-control col-12 col-md-8" id="Did" name="Did"
                                onchange="window.location.href='{{route('ListeGlobale.index')}}/'+this.value">
                            @if(isset($details))
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}"
                                            @if($RDid==$detail->Did) selected @endif>{{$detail->Nom}} --
                                        Epais: {{$detail->Epaisseur}}
                                        mm -Diam : {{$detail->Diametre}}mm
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-sm-6 col-12 " style="margin-top: 10px">
                    <h5 class="btn-success btn" style="width:100%"><b>Nombre total : <span
                                    id="NbBobine">@if(isset($tubes))
                                    {{sizeof($tubes)}}
                                @endif</span> </b></h5>
                </div>
            </div>

                <div class="row zones" >
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white"
                                               id="Z01">Production</span></div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone  " alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z02">Visuel</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z03">RX1</span>
                        </div>
                        <div class="row d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                            class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white"
                                               id="Z04">Réparation</span></div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z05">Chutage</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z06">M24</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z07">M25</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z08">NDT</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z09">RX2</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white"
                                               id="Z10">VisuelFinal</span></div>
                        <div class="row d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                            class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white"
                                               id="Z11">Reception</span></div>
                        <div class="row d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                            class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z12">RevInt</span>
                        </div>
                        <div class="row d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                            class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white" id="Z13">RevExt</span>
                        </div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                    <div class=" Zone">
                        <div class="row"><span class="text-center col-12 bg-primary text-white"
                                               id="Z14">Expedition</span></div>
                        <div class="row  d-flex justify-content-center"><img src="{{asset("img/on.png")}}"
                                                                             class="imgZone text-center" alt="On"></div>
                    </div>
                </div>
            <hr>
            <div class="table-container">
                <table class="table table-light table-bordered  " id="ListeGlobaleTable">
                    <thead>
                    <tr class="btn-primary">
                        <th>DateFabrication</th>
                        <th>Tube</th>
                        <th>Bis</th>
                        <th>Coulee</th>
                        <th>Bobine</th>
                        <th>Machine</th>
                        <th>LongFab</th>
                        <th>LongVis</th>
                        <th>NumReception</th>
                        <th>LongueurRec</th>
                        <th>LongueurExp</th>
                        <th>PoidsExp</th>
                        <th>NumExpedition</th>
                        <th>DateReception</th>
                        <th>DateExpedition</th>
                    </tr>
                    </thead>
                    <tbody id="Tubes">
                    @if(isset($tubes))
                        @foreach($tubes as $tube)
                            <tr Z01="{{(int)$tube->Z01}}" Z02="{{(int)$tube->Z02}}" Z03="{{(int)$tube->Z03}}" Z04="{{(int)$tube->Z04}}"
                                Z05="{{(int)$tube->Z05}}" Z06="{{(int)$tube->Z06}}" Z07="{{(int)$tube->Z07}}"
                                Z08="{{(int)$tube->Z08}}" Z09="{{(int)$tube->Z09}}" Z10="{{(int)$tube->Z10}}"
                                Z11="{{(int)$tube->Z11}}" Z12="{{(int)$tube->Z12}}" Z13="{{(int)$tube->Z13}}" Z14="{{(int)$tube->Z14}}"
                                style="display: table-row;">
                                <td>{{$tube->DateFab}}</td>
                                <td>{{$tube->Tube}}</td>
                                <td>{{$tube->Bis}}</td>
                                <td>{{$tube->Coulee}}</td>
                                <td>{{$tube->Bobine}}</td>
                                <td>{{$tube->Machine}}</td>
                                <td>{{$tube->LongFab/1000}} m</td>
                                <td>{{$tube->LongVis/1000}} m</td>
                                <td>{{$tube->NumReception}}</td>
                                <td>{{$tube->LongueurRec/1000}} m</td>
                                <td>{{$tube->LongueurExp/1000}} m</td>
                                <td>{{$tube->PoidsExp/1000}} T</td>
                                <td>{{$tube->NumExpedition}}</td>
                                <td>{{$tube->DateRec}}</td>
                                <td>{{$tube->DateExpedition}}</td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </section>

    </div>

@endsection

@section('script')

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.zones').hide();

            var table = $('#ListeGlobaleTable').DataTable(
                {
                    "lengthMenu": [5, 10, 20],
                    "dom": '<"top">rt<"bottom"flp><"clear">'

                }
            );
            $('.bottom').addClass('row').find('> div').addClass("col-4");
            AddActions();

            $('#ListeGlobaleTable_wrapper').click(function () {
                AddActions();
            });

            function AddActions() {


                $('#Tubes tr ').click(function () {

                    $(this).off('click');
                    $(this).click(function () {
                        $('#Tubes tr ').removeClass('Selected');
                        $(this).toggleClass('Selected');
                        for (let i = 1; i < 15; i++) {
                            if (i < 10) {
                                if ($(this).attr('Z0' + i) == "1") {
                                    $('#Z0' + i + '').parent().next().find(".imgZone").attr("src", "{{asset('img/on.png')}}");
                                } else {
                                    $('#Z0' + i + '').parent().next().find(".imgZone").attr("src", "{{asset('img/off.png')}}");
                                }
                            } else {

                                if ($(this).attr('Z' + i) == "1") {0
                                    $('#Z' + i + '').parent().next().find(".imgZone").attr("src", "{{asset('img/on.png')}}");
                                } else {
                                    $('#Z' + i + '').parent().next().find(".imgZone").attr("src", "{{asset('img/off.png')}}");
                                }
                            }

                        }
                        $('.zones').show();
                    });
                });
            }
        });

    </script>

@endsection