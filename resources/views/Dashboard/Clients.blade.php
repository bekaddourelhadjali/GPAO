@extends('layouts.dashboardTemp')
@section('style')
    <style>
        section {
            padding-left: 10px;
            padding-right: 5px;
        }

        .actions {
            padding-right: 0;
        }

        .tab-pane h4 {
            padding: 10px 0;
        }

        .table {
            width: 120%;
        }

        .table-container {
            overflow: auto;
            position: relative;
        }

        #cont {
            position: relative;
        }

        /*.tr-actions{*/
        /*display : none;*/
        /*}*/
        /*tr:hover .tr-actions{*/
        /*display: table-cell;*/
        /*}*/
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
@endsection
@section('content')
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-item nav-link " href="{{route('projects.index')}}"><b>Projets</b></a>
                <a class="nav-item nav-link " href="{{route('details_project.index')}}"><b>Details Projets</b></a>
                <a class="nav-item nav-link @if(isset($target)&& $target=='clients') active @endif" id="nav-clients-tab"
                   data-toggle="tab" href="#nav-clients" role="tab" aria-controls="nav-clients" aria-selected="true"><b>Clients</b></a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade @if(isset($target)&& $target=='clients') show active @endif " id="nav-clients"
                 role="tabpanel" aria-labelledby="nav-clients-tab">
                <div class="row">
                    <div class="col-12">
                        <section>
                            <h4 class="text-center bg-gradient-info text-white"><b>Gestion Des Clients</b></h4>
                            <hr>
                            <form id="clientsForm" class="row text-center">
                                <input type="hidden" id="ClientId" name="id" value="">
                                <div class="form-group col-xl-2 col-lg-3 col-sm-4 ">
                                    <label for="name"> Nom </label>
                                    <input class="  form-control" name="name" id="name" type="text" required>
                                </div>
                                <div class="form-group col-xl-5 col-lg-6 col-sm-8 ">
                                    <label for="address"> Adresse </label>
                                    <input class=" form-control" name="address" id="address" type="text">
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-sm-3 ">
                                    <label for="city"> Ville </label>
                                    <input class=" form-control" name="city" id="city" type="text">
                                </div>
                                <div class="form-group col-xl-1 col-lg-2 col-sm-3 ">
                                    <label for="zipcode"> Zip Code </label>
                                    <input class=" form-control" name="zipcode" id="zipcode" type="text">
                                </div>
                                <div class="form-group  col-xl-2 col-lg-3 col-sm-3  ">
                                    <label for="state"> L'état </label>
                                    <input class=" form-control" name="state" id="state" type="text">
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-sm-3 ">
                                    <label for="country"> Pays </label>
                                    <input class=" form-control" name="country" id="country" type="text">
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-sm-3 ">
                                    <label for="phone"> Téléphone </label>
                                    <input class=" form-control" name="phone" id="phone" type="tel">
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-sm-3 ">
                                    <label for="fax"> FAX </label>
                                    <input class=" form-control" name="fax" id="fax" type="tel">
                                </div>
                                <div class="form-group col-xl-2 col-lg-3  col-sm-6">
                                    <label for="web_url"> Site web </label>
                                    <input class="  form-control" name="web_url" id="web_url"
                                            {{--type="url" pattern="^(?!((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?))"  --}}
                                    >
                                </div>
                                <div class="form-group col-xl-2 col-lg-3 col-sm-9">
                                    <label for="comment"> Commentaire </label>
                                    <input class="  form-control" name="comment" id="comment" type="text">
                                </div>
                                <div class="col-xl-2 col-lg-3 col-sm-3 form-group  actions ">
                                    <label class="col-12">&nbsp</label>
                                    <button type="button" id="AnnulerClient" class=" btn btn-danger"
                                            style="width:35px; height:35px; padding:0;"><i class="fa fa-times"></i>
                                    </button>
                                    <button type="button" id="AjouterClient" style="width:35px; height:35px; padding:0;"
                                            class=" btn btn-info"><i class="fa fa-plus"></i></button>
                                </div>
                            </form>
                            <hr>
                            <div id="cont">
                                <div class="table-container">
                                    <table class="table  table-hover  ">
                                        <thead class="bg-info text-white">
                                        <tr id="clientsTH">
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Ville</th>
                                            <th>Zip Code</th>
                                            <th>L'état</th>
                                            <th>Pays</th>
                                            <th>Téléphone</th>
                                            <th>FAX</th>
                                            <th>Site Web</th>
                                            <th>Commentaire</th>
                                        </tr>
                                        </thead>
                                        <tbody id="clients">
                                        @if(isset($clients))
                                            @foreach($clients as $client)
                                                <tr id="client{{$client->id}}" class="clientRow">
                                                    <td id="client{{$client->id}}name">{{$client->name}}</td>
                                                    <td id="client{{$client->id}}address">{{$client->address}}</td>
                                                    <td id="client{{$client->id}}city">{{$client->city}}</td>
                                                    <td id="client{{$client->id}}zipcode">{{$client->zipcode}}</td>
                                                    <td id="client{{$client->id}}state">{{$client->state}}</td>
                                                    <td id="client{{$client->id}}country">{{$client->country}}</td>
                                                    <td id="client{{$client->id}}phone">{{$client->phone}}</td>
                                                    <td id="client{{$client->id}}fax">{{$client->fax}}</td>
                                                    <td id="client{{$client->id}}web_url">{{$client->web_url}}</td>
                                                    <td id="client{{$client->id}}comment">{{$client->comment}}</td>
                                                </tr>

                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>

                                </div>
                                <div id="tr-actions">
                                    <button class="clientEdit btn btn-primary"><i class="fa fa-edit"></i></button>
                                    <button class="clientDelete btn btn-danger"><i class="fa fa-trash"></i></button>

                                </div>
                            </div>

                        </section>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#AnnulerClient').hide();
            addClientsListeners();


            $('#AjouterClient').click(function (e) {

                if ($('#clientsForm')[0].checkValidity()) {


                    e.preventDefault();
                    if ($('#AjouterClient').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('clients.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                name: $('#name').val(),
                                address: $('#address').val(),
                                city: $('#city').val(),
                                zipcode: $('#zipcode').val(),
                                state: $('#state').val(),
                                country: $('#country').val(),
                                phone: $('#phone').val(),
                                fax: $('#fax').val(),
                                web_url: $('#web_url').val(),
                                comment: $('#comment').val(),

                            },
                            success: function (result) {
                                $('#clients').append('<tr id="client' + result.client.id + '"  class="clientRow">\n' +
                                    '                                    <td id="client' + result.client.id + 'name">' + $('#name').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'address">' + $('#address').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'city">' + $('#city').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'zipcode">' + $('#zipcode').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'state">' + $('#state').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'country">' + $('#country').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'phone">' + $('#phone').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'fax">' + $('#fax').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'web_url">' + $('#web_url').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'comment">' + $('#comment').val() + '</td>\n' +
                                    '                                </tr>');
                                addClientsListeners();
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('Unique violation')) {
                                        alert("Le client " + $('#name').val() + " existe déjà");
                                        console.log(result);
                                    } else {
                                        alert(result.responseJSON.message);
                                        console.log(result);
                                    }
                                } else {
                                    console.log(result);

                                }
                            }
                        });
                    } else {
                        id = $('#ClientId').val();
                        $.ajax({
                            url: "{{ url('/clients/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                name: $('#name').val(),
                                address: $('#address').val(),
                                city: $('#city').val(),
                                zipcode: $('#zipcode').val(),
                                state: $('#state').val(),
                                country: $('#country').val(),
                                phone: $('#phone').val(),
                                fax: $('#fax').val(),
                                web_url: $('#web_url').val(),
                                comment: $('#comment').val(),
                            },
                            success: function (result) {
                                console.log(result);
                                $('#clients').find('#client' + id).replaceWith('<tr id="client' + result.client.id + '"  class="clientRow">\n' +
                                    '                                    <td id="client' + result.client.id + 'name">' + $('#name').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'address">' + $('#address').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'city">' + $('#city').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'zipcode">' + $('#zipcode').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'state">' + $('#state').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'country">' + $('#country').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'phone">' + $('#phone').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'fax">' + $('#fax').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'web_url">' + $('#web_url').val() + '</td>\n' +
                                    '                                    <td id="client' + result.client.id + 'comment">' + $('#comment').val() + '</td>\n' +
                                    '                                </tr>');
                                addClientsListeners();
                                $('#clientsForm').trigger('reset');
                                $('#AnnulerClient').hide();
                                $('#AjouterClient').html('<i class="fa fa-plus"></i>');
                            },
                            error: function (result) {

                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('Unique violation')) {
                                        alert("Le client " + $('#name').val() + " existe déjà");
                                    } else {
                                        alert(result.responseJSON.message);
                                        console.log(result);
                                    }
                                } else {
                                    console.log(result);

                                }
                            }
                        });


                    }

                } else {
                    alert('Remplire tous les champs svp!');
                }
            });

            function addClientsListeners() {
                $('.clientDelete').each(function (e) {
                    $(this).off('click');
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        tr = $(this).parent().parent().find('#client' + id);
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{url('/clients/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                e.preventDefault();
                                $('#clientsForm').trigger('reset');
                                $('#AnnulerClient').hide();
                                $('#AjouterClient').html('<i class="fa fa-plus"></i>');
                                $('#tr-actions').hide();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.clientEdit').each(function (e) {

                    $(this).off('click');
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $('#ClientId').val(id);
                        $('#name').val($('#client' + id + 'name').html());
                        $('#address').val($('#client' + id + 'address').html());
                        $('#city').val($('#client' + id + 'city').html());
                        $('#zipcode').val($('#client' + id + 'zipcode').html());
                        $('#state').val($('#client' + id + 'state').html());
                        $('#country').val($('#client' + id + 'country').html());
                        $('#phone').val($('#client' + id + 'phone').html());
                        $('#fax').val($('#client' + id + 'fax').html());
                        $('#web_url').val($('#client' + id + 'web_url').html());
                        $('#comment').val($('#client' + id + 'comment').html());
                        $('#AnnulerClient').show();
                        $('#AjouterClient').html('<i class="fa fa-check"></i>');
                    });
                });
                addActions();
            }

            $('#AnnulerClient').click(function (e) {
                e.preventDefault();
                $('#clientsForm').trigger('reset');
                $(this).hide();
                $('#AjouterClient').html('<i class="fa fa-plus"></i>');
            });
            clientId = 0;

            function addActions() {

                $(".clientRow").each(function () {
                    $(this).off('mouseover');
                    $(this).mouseover(function () {

                        $(this).css({
                            'color': '#858796',
                            'background-color': 'rgba(0,0,0,.075)'
                        });

                        var o = $(this);
                        var offset = o.offset();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        clientId = id;
                        $('#tr-actions .clientDelete').each(function () {
                            $(this).attr('id', 'client' + id + 'Delete');
                        });
                        $('#tr-actions .clientEdit').each(function () {
                            $(this).attr('id', 'client' + id + 'Edit');
                        });

                        var height = ($(this).height() - $('#tr-actions').height()) / 2;
                        var width = ($('#clientsForm').width() - $('#tr-actions').width()) / 2;
                        $('#tr-actions').css({
                            'top': (offset.top - $('.table').offset().top) + height,
                            'left': width,
                        }).show();

                    })
                        .mouseout(function () {
                            $('#client' + clientId).css({
                                'color': '#000',
                                'background-color': '#fff'
                            });
                            $('#tr-actions').hide();
                        });
                });

            }

            $('#tr-actions').mouseover(function () {
                $(this).show();
                $('#client' + clientId).css({
                    'color': '#858796',
                    'background-color': 'rgba(0,0,0,.075)'
                });
            });
            $('#tr-actions').mouseout(function () {
                $('#client' + clientId).css({
                    'color': '#000',
                    'background-color': '#fff'
                });
            });
        });
    </script>

@endsection