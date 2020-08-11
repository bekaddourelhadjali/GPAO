@extends('layouts.dashboardTemp')
@section('style')
    <title>Tests Des Bobines</title>
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
        }

        @media (min-width: 992px) {
            button.offset-lg-0 {
                margin-left: 0;
                margin-top: 0;
            }
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
                        <select class="form-control col-12 col-md-8" id="Did" name="Did">
                            @if(isset($details))
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}">{{$detail->Nom}} -- Epais: {{$detail->Epaisseur}}
                                        mm -Diam : {{$detail->Diametre}}mm
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-sm-6 col-12 " style="margin-top: 10px">
                    <h5 class="btn-danger btn" style="width:100%"><b>Coulées Non testés : <span
                                    id="NbBobine">@if(isset($coulees))
                                    @if(isset(array_count_values(array_column($coulees, 'BesoinTest'))["Oui"]))
                                        {{array_count_values(array_column($coulees, 'BesoinTest'))["Oui"]}}
                                    @else 0
                                    @endif
                                @endif</span> </b></h5>
                </div>
            </div>
            <hr>
            <div class="table-container">
                <table class="table table-hover  table-light  table-striped" id="TestBobs">
                    <thead>
                    <tr class="btn-primary">
                        <th>Epaisseur</th>
                        <th>Diametre</th>
                        <th>Coulée</th>
                        <th>Poids Total</th>
                        <th>Longueur Possible</th>
                        <th>Bobines A Testés</th>
                        <th>Besoin d'un Test</th>
                        <th>Bobines Testés</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="Coulees">
                    @if(isset($coulees))
                        @foreach($coulees as $item)
                            <tr id="Coulee{{$item->Coulee}}">
                                <td>{{$item->Epaisseur}} mm</td>
                                <td>{{$item->Diametre}} mm</td>
                                <td>{{$item->Coulee}}</td>
                                <td>{{$item->PoidsTotal}} KG</td>
                                <td>{{round($item->Lang,2)}} M</td>
                                <td id="testNB{{$item->Coulee}}">{{$item->nbTest}}/{{$item->TestDem}}</td>
                                <td id="BesoinTest{{$item->Coulee}}"> {{$item->BesoinTest}}  </td>
                                <td id="nbTestTotal{{$item->Coulee}}"> {{$item->nbTestTotal}}  </td>
                                <td>
                                    <button type="button" class="btn btn-warning CouleeTest"
                                            id="Coulee{{$item->Coulee}}Test"><b>
                                            Gérer </b>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>
        <button type="button" class="btn btn-secondary" data-toggle="modal"
                data-target="#BobineBackdrop" id="NvBobine" style="display:none"></button>
    </div>
    <!-- Test Coulées Modal -->
    <div class="modal fade" id="BobineBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="BobineModal">
            <form id="TestsForm" class="modal-content" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Gérer les tests
                        &nbsp;&nbsp;Coulée : <span id="coulee" class="text-primary"></span>
                    </h5>
                    <button onclick="$('#AnnulerTests').trigger('click')" type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf()
                        <div class="row">
                            <div class="col-6" id="Test1DIV">
                                <label class="col-12" for="Test1">Test 1</label>
                                <select name="Test1" id="Test1" class="form-control col-12" required>
                                </select>
                            </div>
                            <div class="col-6" id="Observation1DIV">
                                <label class="col-12" for="Observation1">Observation</label>
                                <input type="text"name="Observation1" id="Observation1" class="form-control col-12">
                            </div>
                        </div>
                        <div class="row" id="test1_1Row">
                            <div class="col-6" id="Test1_1DIV">
                                <label for="Test1_1">Test 1-1</label>
                                <select name="Test1_1" id="Test1_1" class="form-control" >
                                </select>
                            </div>
                            <div class="col-6" id="Observation1_1DIV">
                                <label class="col-12" for="Observation1_1">Observation</label>
                                <input type="text" name="Observation1_1" id="Observation1_1" class="form-control col-12" >
                            </div>
                        </div>
                        <div class="row" id="test2Row">
                            <div class="col-6" id="Test2DIV">
                                <label for="Test2">Test 2</label>
                                <select name="Test2" id="Test2" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-6" id="Observation2DIV">
                                <label class="col-12" for="Observation2">Observation</label>
                                <input type="text" name="Observation2" id="Observation2" class="form-control col-12">
                            </div>
                        </div>
                        <div class="row" id="test2_2Row">
                            <div class="col-6" id="Test2_2DIV">
                                <label for="Test2_2">Test 2-2</label>
                                <select name="Test2_2" id="Test2_2" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-6" id="Observation2_2DIV">
                                <label class="col-12" for="Observation2_2" >Observation</label>
                                <input type="text" name="Observation2_2" id="Observation2_2" class="form-control col-12" >
                            </div>
                        </div>

                        <br>
                        <div class="modal-footer">
                            <button id="AnnulerTests" type="reset" class="btn btn-secondary" data-dismiss="modal">
                                Annuler
                            </button>
                            <button id="ValiderTests" type="submit" class="btn btn-primary">Valider</button>
                        </div>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('script')

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#TestBobs').DataTable({ "lengthMenu": [[ -1,10, 25, 50], ["All",10, 25, 50]]});
            $('#Did').val('{{$RDid}}');
            $('#Did').change(function () {
                document.location.href = "{{route('ContRecBob.index')}}/" + $(this).val();
            });
            $('#ValiderTests').click(function (e) {
                if ($('#TestsForm')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData= new FormData(document.getElementById('TestsForm'));
                    formData.append('Did',$('#Did').val());
                    formData.append('coulee',$('#coulee').html());
                    $.ajax({
                        url: "{{route('ContRecBob.store')}}",
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            console.log(result);
                            $('#BesoinTest'+$('#coulee').html()).html(result.Coulee.BesoinTest);
                            $('#testNB'+$('#coulee').html()).html(result.Coulee.nbTest+'/'+result.Coulee.TestDem);
                            $('#nbTestTotal'+$('#coulee').html()).html(result.Coulee.nbTestTotal);
                            $('#BobineBackdrop').modal('toggle');
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                            console.log(result);
                        }
                    });
                } else {
                    alert('Remplire tous les champs qui sont obligatoires svp!');
                }
            });

            $('.CouleeTest').each(function () {
                $(this).off('click');
                $(this).click(function () {
                    const coulee = $(this).attr("id").replace(/[^0-9]/g, '');
                    const TestDem = $('#testNB' + coulee).html().split('/')[1];
                    const nbTest = $('#testNB' + coulee).html().split('/')[0];
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{route('ContRecBob.index')}}/" + coulee + "/edit",
                        method: 'get',
                        data: {
                            coulee: coulee,
                            Did: $('#Did').val()

                        },
                        success: function (result) {

                            console.log(result);
                            var bobines = result.bobines;
                            $('#Test1').html('');
                            $('#Test1_1').html('');
                            $('#Test2').html('');
                            $('#Test2_2').html('');

                            bobines.forEach(function (item, index) {
                                $('#Test2_2').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                                $('#Test1_1').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                                $('#Test2').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                                $('#Test1').append('<option value="' + item.Bobine + '">' + item.Bobine + '</option>');
                            });
                            $('#Test1').prepend('<option value="Aucune">Aucune</option>');
                            $('#Test1_1').prepend('<option value="Aucune">Aucune</option>');
                            $('#Test2').prepend('<option value="Aucune">Aucune</option>');
                            $('#Test2_2').prepend('<option value="Aucune">Aucune</option>');
                            if(nbTest==0&&TestDem==1){
                                $('#test1_1Row').hide();
                                $('#test2Row').hide();
                                $('#test2_2Row').hide();
                            }else if(nbTest==0&&TestDem==2) {
                                $('#test1_1Row').hide();
                                $('#test2Row').show();
                                $('#test2_2Row').hide();
                            }else if(nbTest==1&&TestDem==1){
                                $('#test1_1Row').show();
                                $('#test2Row').hide();
                                $('#test2_2Row').hide();
                            }else if(nbTest==1&&TestDem==2){
                                $('#test1_1Row').show();
                                $('#test2Row').show();
                                $('#test2_2Row').hide();
                            } if(nbTest==2&&TestDem==2) {
                                $('#test1_1Row').show();
                                $('#test2Row').show();
                                $('#test2_2Row').show();
                            }
                            if(result.test1==null){
                                $('#Test1').val("Aucune");
                            }else{
                                $('#Test1').val(result.test1);
                                $('#Observation1').val(result.Observation1);

                                $("#Test1_1 option[value='"+result.test1+"']").remove();
                                $("#Test2 option[value='"+result.test1+"']").remove();
                                $("#Test2_2 option[value='"+result.test1+"']").remove();
                            }
                            if(result.test1_1==null){
                                $('#Test1_1').val("Aucune");
                            }else{

                                $('#Test1_1').val(result.test1_1);
                                $('#Observation1_1').val(result.Observation1_1);
                                $("#Test1 option[value='"+result.test1_1+"']").remove();
                                $("#Test2 option[value='"+result.test1_1+"']").remove();
                                $("#Test2_2 option[value='"+result.test1_1+"']").remove();
                            }
                            if(result.test2==null){
                                $('#Test2').val("Aucune");
                            }else{
                                $('#Test2').val(result.test2);
                                $('#Observation2').val(result.Observation2);
                                $("#Test1_1 option[value='"+result.test2+"']").remove();
                                $("#Test1 option[value='"+result.test2+"']").remove();
                                $("#Test2_2 option[value='"+result.test2+"']").remove();
                            }
                            if(result.test2_2==null){
                                $('#Test2_2').val("Aucune");
                            }else{
                                $('#Test2_2').val(result.test2_2);
                                $('#Observation2_2').val(result.Observation2_2);
                                $("#Test1_1 option[value='"+result.test2_2+"']").remove();
                                $("#Test2 option[value='"+result.test2_2+"']").remove();
                                $("#Test1 option[value='"+result.test2_2+"']").remove();
                            }

                            $('#coulee').html(coulee);
                            $('#NvBobine').trigger('click');
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                            console.log(result);
                        }
                    });


                });
            });
        });
    </script>

@endsection