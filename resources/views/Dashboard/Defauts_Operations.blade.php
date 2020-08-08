@extends('layouts.dashboardTemp')
@section('style')
    <title>Gestion Des Defauts et Opérations </title>
    <style>
        section {
            padding-left: 10px;
            padding-right: 5px;
        }

        .actions {
            padding-right: 0;
        }

        .table-container {
            max-height: 350px;
        }

        .card {
            margin-top: 25px;
            border-color: #aaa;
            background-color: #eef;
        }

        .tab-pane h4 {
            padding: 10px 0;
        }

        .table-container-small {
            max-height: 175px;
            overflow: auto;
        }

        .small-section {
            box-shadow: none;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-item nav-link " href="{{route('affectations.index')}}"><b>Affectations</b></a>
                <a class="nav-item nav-link  " href="{{route('Locations.index')}}"><b>Locations</b></a>
                <a class="nav-item nav-link " href="{{route('agents.index')}}"><b>Agents</b></a>
                <a class="nav-item nav-link active " id="nav-Defauts-tab" data-toggle="tab" href="#nav-Defauts"
                   role="tab" aria-controls="nav-Defauts" aria-selected="true"><b>Defauts & Operations</b></a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade   show active  " id="nav-Defauts" role="tabpanel"
                 aria-labelledby="nav-Defauts-tab">
                <div class="row">
                    <div class="col-lg-6  col-sm-12">
                        <section>
                            <h4 class="text-center     text-info"><b>Gestion Des Defauts</b></h4>
                            <hr>
                            <form id="DefautsForm" class="row text-center">
                                <input type="hidden" id="DefautId" name="id" value="">
                                <div class="form-group col-md-3 col-6">
                                    <label for="Defaut"> Defaut : </label>
                                    <input class="  form-control" name="Defaut" id="Defaut" type="text" required>
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label for="Zone"> Zone : </label>
                                    <select class=" form-control" name="Zone" id="Zone" type="text" required>
                                        <option value="Z02">Contrôle Visuel</option>
                                        <option value="Z03">RX1</option>
                                        <option value="Z04">Réparation</option>
                                        <option value="Z05">Chutage</option>
                                        <option value="Z09">RX2</option>
                                        <option value="Z10">Visuel Final</option>
                                        <option value="Z11">Revêtement Interieur</option>
                                        <option value="Z12">Revêtement Exterieur</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label for="Type"> Type : </label>
                                    <select class=" form-control" name="Type" id="Type" type="text"  >
                                        <option value="Soudure">Soudure</option>
                                        <option value="Metal">Metal</option>
                                    </select>
                                </div>

                                <div class="col-3 form-group  actions ">
                                    <label class="col-12">&nbsp</label>
                                    <button type="reset" id="AnnulerDefaut" class=" btn btn-danger"
                                            style="width:35px; height:35px; padding:0;"><i class="fa fa-times"></i>
                                    </button>
                                    <button type="submit" id="AjouterDefaut" style="width:35px; height:35px; padding:0;"
                                            class=" btn btn-info"><i class="fa fa-plus"></i></button>
                                </div>
                            </form>
                            <div class="table-container">
                                <table class="table table-striped table-hover table-borderless ">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th>Defaut</th>
                                        <th>Zone</th>
                                        <th>Type</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="defauts">
                                    @if(isset($defauts))
                                        @foreach($defauts as $item)
                                            <tr id="Defaut{{$item->id}}">
                                                <td id="Defaut{{$item->id}}Defaut">{{$item->Defaut}}</td>
                                                <td id="Defaut{{$item->id}}Zone">{{$item->Zone}}</td>
                                                <td id="Defaut{{$item->id}}Type">{{$item->Type}}</td>
                                                <td>
                                                    <button id="Defaut{{$item->id}}Edit"
                                                            class="DefautEdit text-primary"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <button id="Defaut{{$item->id}}Delete"
                                                            class="DefautDelete text-danger"><i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                </td>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                            </div>


                        </section>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <section>
                            <h4 class="text-center text-warning"><b>Gestion Des Opérations</b></h4>
                            <hr>
                            <form id="OperationsForm" class="row text-center">
                                <input type="hidden" id="OperationId" name="id" value="">
                                <div class="form-group col-md-3 col-6">
                                    <label for="Operation"> Operation : </label>
                                    <input class="  form-control" name="Operation" id="Operation" type="text" required>
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label for="Zone2"> Zone : </label>
                                    <select class=" form-control" name="Zone2" id="Zone2" type="text" required>
                                        <option value="Z02">Contrôle Visuel</option>
                                        <option value="Z03">RX1</option>
                                        <option value="Z04">Réparation</option>
                                        <option value="Z09">RX2</option>
                                        <option value="Z10">Visuel Final</option>
                                        <option value="Z11">Revêtement Interieur</option>
                                        <option value="Z12">Revêtement Exterieur</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-6">
                                    <label for="Type2"> Type : </label>
                                    <select class=" form-control" name="Type2" id="Type2" type="text" required>
                                        <option value="Soudure">Soudure</option>
                                        <option value="Metal">Metal</option>
                                    </select>
                                </div>

                                <div class="col-3 form-group  actions ">
                                    <label class="col-12">&nbsp</label>
                                    <button type="reset" id="AnnulerOperation" class=" btn btn-danger"
                                            style="width:35px; height:35px; padding:0;"><i class="fa fa-times"></i>
                                    </button>
                                    <button type="submit" id="AjouterOperation"
                                            style="width:35px; height:35px; padding:0;" class=" btn btn-warning"><i
                                                class="fa fa-plus"></i></button>
                                </div>
                            </form>
                            <div class="table-container">
                                <table class="table table-striped table-hover table-borderless ">
                                    <thead class="bg-warning text-white">
                                    <tr>
                                        <th style="background-color: #f6c23e">Operation</th>
                                        <th style="background-color: #f6c23e">Zone</th>
                                        <th style="background-color: #f6c23e">Type</th>
                                        <th style="background-color: #f6c23e"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="operations">
                                    @if(isset($operations))
                                        @foreach($operations as $item)
                                            <tr id="Operation{{$item->id}}">
                                                <td id="Operation{{$item->id}}Operation">{{$item->Operation}}</td>
                                                <td id="Operation{{$item->id}}Zone">{{$item->Zone}}</td>
                                                <td id="Operation{{$item->id}}Type">{{$item->Type}}</td>
                                                <td>
                                                    <button id="Operation{{$item->id}}Edit"
                                                            class="OperationEdit text-primary"><i
                                                                class="fa fa-edit"></i></button>
                                                    <button id="Operation{{$item->id}}Delete"
                                                            class="OperationDelete text-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                </td>
                                                </td>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
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
            $('#AnnulerDefaut').hide();
            addDefautsListeners();


            $('#AjouterDefaut').click(function (e) {

                if ($('#DefautsForm')[0].checkValidity()) {
                    e.preventDefault();
                    if ($('#AjouterDefaut').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('Defauts.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Defaut: $('#Defaut').val(),
                                Zone: $('#Zone').val(),
                                Type: $('#Type').val(),

                            },
                            success: function (result) {
                                $('#defauts').prepend(' <tr id="Defaut' + result.defaut.id + '">\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Defaut">' + result.defaut.Defaut + '</td>\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Zone">' + result.defaut.Zone + '</td>\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Type">' + result.defaut.Type + '</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="Defaut' + result.defaut.id + 'Edit" class="DefautEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="Defaut' + result.defaut.id + 'Delete" class="DefautDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                addDefautsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });
                    } else {
                        id = $('#DefautId').val();
                        $.ajax({
                            url: "{{ url('/Defauts/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                Defaut: $('#Defaut').val(),
                                Zone: $('#Zone').val(),
                                Type: $('#Type').val(),
                            },
                            success: function (result) {
                                $("#Defaut" + id).replaceWith(' <tr id="Defaut' + result.defaut.id + '">\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Defaut">' + result.defaut.Defaut + '</td>\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Zone">' + result.defaut.Zone + '</td>\n' +
                                    '                                            <td id="Defaut' + result.defaut.id + 'Type">' + result.defaut.Type + '</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="Defaut' + result.defaut.id + 'Edit" class="DefautEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="Defaut' + result.defaut.id + 'Delete" class="DefautDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                $('#DefautsForm').trigger('reset');
                                $('#AnnulerDefaut').hide();
                                $('#AjouterDefaut').html('<i class="fa fa-plus"></i>');
                                addDefautsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });


                    }
                } else {
                    alert('Remplire tous les champs svp!');
                }
            });

            function addDefautsListeners() {
                $('.DefautDelete').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/Defauts/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                e.preventDefault();
                                $('#DefautsForm').trigger('reset');
                                $("#AnnulerDefaut").hide();
                                $('#AjouterDefaut').html('<i class="fa fa-plus"></i>');
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.DefautEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        tr = $(this).parent().parent();
                        $('#DefautId').val(id);
                        $('#Defaut').val(tr.find('#Defaut' + id + 'Defaut').html());
                        $('#Zone').val(tr.find('#Defaut' + id + 'Zone').html());
                        $('#Type').val(tr.find('#Defaut' + id + 'Type').html());
                        $('#AnnulerDefaut').show();
                        $('#AjouterDefaut').html('<i class="fa fa-check"></i>');
                    });
                });
            }

            $('#AnnulerDefaut').click(function (e) {
                e.preventDefault();
                $('#DefautsForm').trigger('reset');
                $(this).hide();
                $('#AjouterDefaut').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#AnnulerOperation').hide();
            addOperationsListeners();


            $('#AjouterOperation').click(function (e) {

                if ($('#OperationsForm')[0].checkValidity()) {
                    e.preventDefault();
                    if ($('#AjouterOperation').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('Operations.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Operation: $('#Operation').val(),
                                Zone: $('#Zone2').val(),
                                Type: $('#Type2').val(),

                            },
                            success: function (result) {
                                $('#operations').prepend(' <tr id="Operation' + result.operation.id + '">\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Operation">' + result.operation.Operation + '</td>\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Zone">' + result.operation.Zone + '</td>\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Type">' + result.operation.Type + '</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="Operation' + result.operation.id + 'Edit" class="OperationEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="Operation' + result.operation.id + 'Delete" class="OperationDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                addOperationsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);

                            }
                        });
                    } else {
                        id = $('#OperationId').val();
                        $.ajax({
                            url: "{{ url('/Operations/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                Operation: $('#Operation').val(),
                                Zone: $('#Zone2').val(),
                                Type: $('#Type2').val(),
                            },
                            success: function (result) {
                                $('#agents').find("#Operation" + id).replaceWith(' <tr id="Operation' + result.operation.id + '">\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Operation">' + result.operation.Operation + '</td>\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Zone">' + result.operation.Zone + '</td>\n' +
                                    '                                            <td id="Operation' + result.operation.id + 'Type">' + result.operation.Type + '</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="Operation' + result.operation.id + 'Edit" class="OperationEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="Operation' + result.operation.id + 'Delete" class="OperationDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                $('#OperationsForm').trigger('reset');
                                $('#AnnulerOperation').hide();
                                $('#AjouterOperation').html('<i class="fa fa-plus"></i>');
                                addOperationsListeners();
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result);
                            }
                        });


                    }
                } else {
                    alert('Remplire tous les champs svp!');
                }
            });

            function addOperationsListeners() {
                $('.OperationDelete').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        tr = $(this).parent().parent();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{url('/Operations/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                e.preventDefault();
                                $('#OperationsForm').trigger('reset');
                                $("#AnnulerOperation").hide();
                                $('#AjouterOperation').html('<i class="fa fa-plus"></i>');
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.OperationEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        tr = $(this).parent().parent();
                        $('#OperationId').val(id);
                        $('#Operation').val(tr.find('#Operation' + id + 'Operation').html());
                        $('#Zone2').val(tr.find('#Operation' + id + 'Zone').html());
                        $('#Type2').val(tr.find('#Operation' + id + 'Type').html());
                        $('#AnnulerOperation').show();
                        $('#AjouterOperation').html('<i class="fa fa-check"></i>');
                    });
                });
            }

            $('#AnnulerOperation').click(function (e) {
                e.preventDefault();
                $('#OperationsForm').trigger('reset');
                $(this).hide();
                $('#AjouterOperation').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>
@endsection