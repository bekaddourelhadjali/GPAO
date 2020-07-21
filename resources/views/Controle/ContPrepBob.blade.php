@extends('layouts.dashboardTemp')
@section('style')
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
        @media (min-width: 992px){
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
                <div class="col-12 col-lg-8">
                <div class="form-group  row">
                    <label class="col-12 col-md-4" for="Did" style="text-align: center; font-size: 20px"><b>Détails Du Projet</b></label>
                    <select class="form-control col-12 col-md-8" id="Did" name="Did">
                        @if(isset($details))
                            @foreach($details as $detail)
                                <option value="{{$detail->Did}}" >{{$detail->Nom}} --  Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-sm-6 col-12 offset-xl-0 offset-sm-3" style="margin-top: 10px">
                    <h5 class="btn-danger btn" style="width:100%"><b>Coulées Non testés : <span
                                    id="NbBobine">@if(isset($coulees))
                                    @if(isset(array_count_values(array_column($coulees, 'BesoinTest'))["Oui"]))
                                        {{array_count_values(array_column($coulees, 'BesoinTest'))["Oui"]}}
                                    @else 0
                                    @endif
                                @endif</span> </b></h5>
                </div>
                <form class="col-xl-8 col-sm-12  form-inline" autocomplete="off" id="TestForm">

                    <div class="col-xl-4 col-lg-4 col-sm-6 col-6 inputs form-group">
                        <label class="col-sm-4 col-12 " for="coulee"><b>Coulee</b></label>
                        <select class="form-control col-sm-7 col-12" type="number" style="padding:5px 2px"   id="coulee" name="coulee" maxlength="10" required>
                            <option disabled selected> </option>
                            @if(isset($coulees))
                                @foreach($coulees as $coulee)
                                  @if($coulee->BesoinTest=="Oui")  <option  value="{{$coulee->Coulee}}">{{$coulee->Coulee}}</option>@endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-4  col-sm-6 col-6 inputs form-group">
                        <label class="col-sm-4 col-12 " for="bobine"><b>Bobine</b></label>

                        <input class="form-control col-sm-7 col-12" type="number" style="padding:5px 2px" list="bobines" id="bobine" name="bobine" maxlength="10" required>
                        <datalist id="bobines">
                        </datalist>
                        <datalist id="bobines2">
                        </datalist>
                    </div>
                    <button type="submit" id="Tester" class="btn btn-success offset-lg-0 offset-sm-4 col-sm-4 col-12"  >A Tester</button>
                </form>
            </div>
            <hr>
            <div class="table-container">
                <table class="table table-hover  table-light  table-striped" >
                    <thead >
                    <tr class="btn-primary"  >
                        <th>Epaisseur</th>
                        <th>Diametre</th>
                        <th>Coulée</th>
                        <th>Poids Total</th>
                        <th>Longueur Possible</th>
                        <th>Nb Bobines Testés</th>
                        <th>Besoin d'un Test</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="Coulees">
                    @if(isset($coulees))
                        @foreach($coulees as $item)
                            <tr id="Coulee{{$item->Coulee}}" >
                                <td>{{$item->Epaisseur}} mm</td>
                                <td>{{$item->Diametre}} mm</td>
                                <td>{{$item->Coulee}}</td>
                                <td>{{$item->PoidsTotal}} KG</td>
                                <td>{{round($item->Lang,2)}} M</td>
                                <td>{{$item->nbTest}}/{{$item->PoidsM}}</td>
                                <td > {{$item->BesoinTest}}  </td>
                                <td>@if($item->nbTest>0)  <button style="margin-top: 0" id="Test{{$item->Coulee}}Edit"
                                              class=" TestEdit btn btn-warning btn-icon-split"
                                              style="margin-top: 10px"   >
                                        <span class="icon text-white-50"><i class="fas fa-exchange-alt"></i> </span>
                                        <span class="text">Changer</span>
                                    </button>
                                    @endif</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#Did').val('{{$RDid}}');
            $('#Did').change(function(){
               document.location.href="{{route('ContRecBob.index')}}/"+$(this).val()+"/edit" ;
            });
            TestListeners();
            $('#coulee').keydown(function () {
                if ($(this).val() === "") {
                    $(this).attr('list', "coulees");
                }
            });
            $('#coulee').on('change', function () {
                const coulee = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/bobineGet')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        coulee: coulee,
                        test:false
                    },
                    success: function (result) {
                        if (result.bobines.length !== 0) {
                            var bobines = result.bobines;
                            $('#bobines2').html("");
                            $('#bobine').val('');
                            bobines.forEach(function (item, index) {
                                $('#bobines2').append('<option  value="' + item.Bobine + '" >' + item.Bobine + '</option>');
                                $('#bobine').attr('list', 'bobines2');
                            });
                        } else {
                            alert("Coulee n'existe pas");
                            $('#coulee').val('');
                            $('#bobine').val('');
                            $('#bobine').attr('list', 'bobines');
                        }
                    },
                    error: function (result) {
                        alert(result.responseJSON.error);
                        console.log(result);
                    }
                });
            });
            $('#Tester').click(function (e) {
                if($('#TestForm')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{route('ContRecBob.store')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            coulee: $('#coulee').val(),
                            bobine: $('#bobine').val(),
                            Did: $('#Did').val(),
                            test:true
                        },
                        success: function (result) {
                            if (result.coulees.length !== 0) {
                                var coulees = result.coulees;
                                $('#coulee').html("");
                                $('#coulee').append('<option disabled selected> </option>');
                                $('#Coulees').html("");  var i=0;
                                coulees.forEach(function (item, index) {

                                    if(item.BesoinTest==='Oui'){
                                        i++;
                                     $('#coulee').append('<option value="'+item.Coulee+'">'+item.Coulee+'</option>');
                                    }
                                    var btn='';
                                    if(item.nbTest>0){
                                        btn='<button style="margin-top: 0" id="Test'+item.Coulee+'Edit"\n' +
                                        '                                              class=" TestEdit btn btn-warning btn-icon-split"\n' +
                                        '                                              style="margin-top: 10px"   >\n' +
                                        '                                        <span class="icon text-white-50"><i class="fas fa-exchange-alt"></i> </span>\n' +
                                        '                                        <span class="text">Changer</span>\n' +
                                        '                                    </button>';}
                                    $('#Coulees').append('<tr id="Coulee'+item.Coulee+'">\n' +
                                        '                                <td>'+item.Epaisseur+'mm</td>\n' +
                                        '                                <td>'+item.Diametre+'mm</td>\n' +
                                        '                                <td>'+item.Coulee+'</td>\n' +
                                        '                                <td>'+item.PoidsTotal+' KG</td>\n' +
                                        '                                <td>'+parseFloat(item.Lang).toFixed(2)+' M</td>\n' +
                                        '                                <td>'+item.nbTest+'/'+item.PoidsM+'</td>\n' +
                                        '                                <td>'+item.BesoinTest+'</td>\n'+
                                      '                                <td>'+btn+'</td>\n' +
                                        '                            </tr>');


                                });
                                $('#NbBobine').html(i);
                                TestListeners();
                                $('#bobine').val('');
                                $('#bobine').attr('list', 'bobines');
                            } else {
                                $('#coulee').val('');
                                $('#bobine').val('');
                                $('#bobine').attr('list', 'bobines');
                            }
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                            console.log(result);
                        }
                    });
                }else{
                    alert('Sélectionner la coulée et la bobine svp!');
                }
            });
            function TestListeners(){
            $('.TestEdit').each(function () {
                $(this).click(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    const coulee=$(this).attr("id").replace(/[^0-9]/g, '');
                    $.ajax({
                        url: "{{url('/ContRecBob/')}}/"+coulee,
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'put',
                            Did: $('#Did').val(),
                        },
                        success:function(result){
                            if (result.coulees.length !== 0) {
                                var coulees = result.coulees;
                                $('#coulee').html("");
                                $('#coulee').append('<option disabled selected> </option>');
                                $('#Coulees').html("");  var i=0;
                                coulees.forEach(function (item, index) {

                                    if(item.BesoinTest==='Oui'){
                                        i++;
                                        $('#coulee').append('<option value="'+item.Coulee+'">'+item.Coulee+'</option>');
                                    }
                                    var btn='';
                                    if(item.nbTest>0){
                                        btn='<button style="margin-top: 0" id="Test'+item.Coulee+'Edit"\n' +
                                            '                                              class=" TestEdit btn btn-warning btn-icon-split"\n' +
                                            '                                              style="margin-top: 10px"   >\n' +
                                            '                                        <span class="icon text-white-50"><i class="fas fa-exchange-alt"></i> </span>\n' +
                                            '                                        <span class="text">Changer</span>\n' +
                                            '                                    </button>';}
                                    $('#Coulees').append('<tr id="Coulee'+item.Coulee+'">\n' +
                                        '                                <td>'+item.Epaisseur+'mm</td>\n' +
                                        '                                <td>'+item.Diametre+'mm</td>\n' +
                                        '                                <td>'+item.Coulee+'</td>\n' +
                                        '                                <td>'+item.PoidsTotal+' KG</td>\n' +
                                        '                                <td>'+parseFloat(item.Lang).toFixed(2)+' M</td>\n' +
                                        '                                <td>'+item.nbTest+'/'+item.PoidsM+'</td>\n' +
                                        '                                <td>'+item.BesoinTest+'</td>\n'+
                                        '                                <td>'+btn+'</td>\n' +
                                        '                            </tr>');


                                });
                                $('#NbBobine').html(i);
                                TestListeners();
                                $('#bobine').val('');
                                $('#bobine').attr('list', 'bobines');
                            } else {
                                $('#coulee').val('');
                                $('#bobine').val('');
                                $('#bobine').attr('list', 'bobines');
                            }
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