@extends('layouts.app')
@section('style')
    <style>
        @media (min-width: 576px) {
            #ListModal {
                max-width: 1000px;
            }
        }

        .table-container {
            width: 100%;
            overflow: auto;
            max-height: 400px;
        }
        #bobinesTab th {
            position: sticky;
            top: 0;
            background-color:#0275d8 ;
        }
        #NvBobinesTab th {
            position: sticky;
            top: 0;
            background-color:#5cb85c ;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <section>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab"   href="{{route("RecBob.show",["id"=>$rapport->Numero])}}"   aria-selected="false">Rapport De Réception</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active  text-dark " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bobines Non Réceptionnées</a>
                        </li>

                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6 col-6" style="margin-top: 10px">
                            <h5 class="btn-danger btn" style="width:100%"><b>Bobines Non Réceptionnées : <span id="nbBobs">@if(isset($bobines)){{count ($bobines)}}@endif</span> </b></h5>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="margin-top: 10px">
                            <button  type="button" class="form-control btn btn-success text-white" data-toggle="modal"
                                     data-target="#ListBackdrop"><b><i class="fa fa-plus"></i> Liste Colisage</b>
                            </button>

                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6" style="margin-top: 10px">
                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#BobineBackdrop" id="NvBobine"><b>
                                    Nouvelle Bobine</b>
                            </button>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <table id="bobinesTab" class="table  table-hover table-borderless table-striped">
                                    <thead class=" btn-primary">
                                    <tr>
                                        <th>Arrivage</th>
                                        <th>Coulee</th>
                                        <th>Bobine</th>
                                        <th>Poids Net</th>
                                        <th>Poids Brut</th>
                                        <th>Epaisseur</th>
                                        <th>Largeur Bande</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="bobines">

                                    @if(isset($bobines))
                                        @foreach($bobines as $item)
                                            <tr id="bobine{{$item->Id}}">
                                                <td id="Arrivage{{$item->Id}}">{{$item->Arrivage}}</td>
                                                <td id="Coulee{{$item->Id}}">{{$item->Coulee}}</td>
                                                <td id="Bobine{{$item->Id}}">{{$item->Bobine}}</td>
                                                <td id="Poids{{$item->Id}}">{{$item->Poids}}</td>
                                                <td id="Poids_b{{$item->Id}}">{{$item->Poids_b}}</td>
                                                <td id="Epaisseur{{$item->Id}}">{{$item->Epaisseur}}</td>
                                                <td id="LargeurBande{{$item->Id}}">{{$item->LargeurBande}}</td>
                                                <td>
                                                    <button id="ContBob{{$item->Id}}Edit" class="ContBobEdit text-primary"><i
                                                                class="fa fa-edit"></i></button>
                                                    <button id="ContBob{{$item->Id}}Delete" class="ContBobDelete text-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
            <!--List Colisage Modal-->
            <div class="modal fade" id="ListBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                 style="padding-right: 0"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog  " role="document" id="ListModal">
                    <div class="modal-content " style="overflow: auto;   ">
                        <div class="modal-header  ">
                            <div class="col-10 modal-title">
                                <div class="input-group mb-3">

                                    <label class="col-6 col-sm-6 text-success "
                                           style="margin-bottom:0; font-size: 25px; font-weight: bolder">Liste Colisage : <span
                                                id="tubeTop"></span></label>
                                    <form id="ListForm" class="col-sm-6 col-6">
                                        <input name="Pid" type="hidden" id="Pid" value="{{$rapport->Pid}}">
                                        <input name="Did" type="hidden" id="Did" value="{{$rapport->Did}}">
                                        @csrf()
                                        <button class=" col-12 form-control btn btn-primary " id="importerBtn" type="button"><i
                                                    class="fa fa-file-import"></i>&nbsp; IMPORTER
                                        </button>
                                        <input class=" col-4 col-sm-4" type="file" accept=".xls,.xlsx"
                                               id="ListeColisage" name="ListeColisage" style="display: none" required>
                                    </form>
                                </div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"
                                                              onclick="location.reload();"
                                                              class="btn btn-danger"><b>X</b></button></span>
                            </button>
                        </div>
                        <div class="modal-body  ">
                            <h5 class="text-center">Liste des bobines insérées</h5>
                            <div class="table-container">
                                <table id="NvBobinesTab" class="table table-hover table-bordered table-light">
                                    <thead >
                                    <tr class="btn-success"  >
                                        <th>Arrivage</th>
                                        <th>Coulée</th>
                                        <th>Bobine</th>
                                        <th>Poids Net</th>
                                        <th>Poids Brut</th>
                                        <th>Epaisseur</th>
                                        <th>Largeur Bande</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bobinesNv">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nouvelle Bobine Modal -->
            <div class="modal fade" id="BobineBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" id="BobineModal">
                    <form id="BobineForm" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Ajout Bobine</h5>
                            <button onclick="$('#AnnulerBobine').trigger('click')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="BId" name="BId" value="">
                            <input name="Pid" type="hidden" id="Pid" value="{{$rapport->Pid}}">
                            <input name="Did" type="hidden" id="Did" value="{{$rapport->Did}}">
                            <div class="form-group row">
                                <label class="col-4" for="BArrivage">Arrivage</label>
                                <input class="col-6 form-control" name="BArrivage" id="BArrivage" type="number" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-4" for="Bcoulee">Coulee</label>
                                <input class="col-6 form-control" name="Bcoulee" id="Bcoulee" type="number" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-4" for="Bbobine">Bobine</label>
                                <input class="col-6 form-control" name="Bbobine" id="Bbobine" type="number" required>
                            </div>
                            <div class="input-group form-group row">
                                <label class="col-4" for="Bpoids">Poids Net</label>
                                <input name="Bpoids" id="Bpoids" type="number" class="col-5 form-control" min="1"
                                       aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">KG</span>
                                </div>
                            </div>
                            <div class="input-group form-group row">
                                <label class="col-4" for="Bpoids_b">Poids Brut</label>
                                <input name="Bpoids_b" id="Bpoids_b" type="number" class="col-5 form-control" min="1"
                                       aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">KG</span>
                                </div>
                            </div>
                            <div class="input-group form-group row">
                                <label class="col-4" for="BEpaisseur">Epaisseur</label>
                                <input name="BEpaisseur" id="BEpaisseur" type="number" class="col-5 form-control" min="1" step="0.01"
                                       aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">MM</span>
                                </div>
                            </div>
                            <div class="input-group form-group row">
                                <label class="col-4" for="BLargeurBande">Largeur Bande</label>
                                <input name="BLargeurBande" id="BLargeurBande" type="number" class="col-5 form-control" min="500"  max="2500"
                                       aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">MM</span>
                                </div>
                            </div>
                            <br>

                            <div class="modal-footer">
                                <button id="AnnulerBobine" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button id="AjouterBobine" type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>





@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $('#AnnulerBobine').click(function () {
                $("#BArrivage").val("");
                $("#Bbobine").val("");
                $("#Bcoulee").val("");
                $("#Bpoids").val("");
                $("#Bpoids_b").val("");
                $("#BEpaisseur").val("");
                $("#BLargeurBande").val("");
                $("#BId").val("");
                $("#AjouterBobine").html("Ajouter");
            });
            AddContBobsListeners();
            $('#importerBtn').click(function () {
                $('#ListeColisage').trigger("click");
            });
            $('#ListeColisage').change(function () {
                $('#bobinesNv').html('');
                var fileName = $(this).val();
                pieces = fileName.split(".");
                if (pieces[pieces.length - 1] == "xlsx" || pieces[pieces.length - 1] == "xls") {
                    var formData = new FormData(document.getElementById("ListForm"));
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{route('ContBobine.store')}}",
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            alert('la liste est importée avec succès');
                            console.log(result);
                            result.data.forEach(function (item, index) {
                                $('#bobinesNv').append('<tr>' +
                                    '<td>' + item.Arrivage + '</td>' +
                                    '<td>' + item.Coulee + '</td>' +
                                    '<td>' + item.Bobine + '</td>' +
                                    '<td>' + item.Poids + '</td>' +
                                    '<td>' + item.Poids_b + '</td>' +
                                    '<td>' + item.Epaisseur + '</td>' +
                                    '<td>' + item.LargeurBande + '</td>' +
                                    '</tr>');
                                $('#bobines').prepend('<tr id="bobine'+item.Id+'">\n' +
                                    '                                        <td id="Arrivage'+item.Id+'">'+item.Arrivage+'</td>\n' +
                                    '                                        <td id="Coulee'+item.Id+'">'+item.Coulee+'</td>\n' +
                                    '                                        <td id="Bobine'+item.Id+'">'+item.Bobine+'</td>\n' +
                                    '                                        <td id="Poids'+item.Id+'">'+item.Poids+'</td>\n' +
                                    '                                        <td id="Poids_b'+item.Id+'">'+item.Poids_b+'</td>\n' +
                                    '                                        <td id="Epaisseur'+item.Id+'">'+item.Epaisseur+'</td>\n' +
                                    '                                        <td id="LargeurBande'+item.Id+'">'+item.LargeurBande+'</td>\n' +
                                    '                                        <td>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Edit" class="ContBobEdit text-primary"><i\n' +
                                    '                                                        class="fa fa-edit"></i></button>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Delete" class="ContBobDelete text-danger"><i\n' +
                                    '                                                        class="fa fa-trash"></i></button>\n' +
                                    '                                        </td>\n' +
                                    '                                    </tr>');
                                $('#nbBobs').html(result.Count);
                                AddContBobsListeners();
                            });
                        },
                        error: function (result) {
                            if (result.responseJSON.message.includes('bobine_coulee_bobine_unique')) {
                                alert('Une des bobines est déjà insérée dans la liste des bobines'
                                    + result.responseJSON.message.split('DETAIL:')[1].split('already')[0]);
                            }
                            console.log(result);

                        }
                    });
                } else {
                    alert('Le format de fichier doit être en EXCEL .xlsx .xls');
                }
                $(this).val('');
            });

            $('#AjouterBobine').click(function (e) {

                if ($('#BobineForm')[0].checkValidity()) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if ($('#AjouterBobine').html() === "Ajouter") {
                        $.ajax({
                            url: "{{route('bobine')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                bobine: $('#Bbobine').val(),
                                coulee: $('#Bcoulee').val(),
                                poids: $('#Bpoids').val(),
                                poids_b: $('#Bpoids_b').val(),
                                epaisseur: $('#BEpaisseur').val(),
                                arrivage: $('#BArrivage').val(),
                                largeur_bande: $('#BLargeurBande').val(),
                                Did: $('#Did').val(),
                                Pid: $('#Pid').val(),
                            },
                            success: function (result) {
                               var item=result.bobine;
                                $('#bobines').prepend('<tr id="bobine'+item.Id+'">\n' +
                                    '                                        <td id="Arrivage'+item.Id+'">'+item.Arrivage+'</td>\n' +
                                    '                                        <td id="Coulee'+item.Id+'">'+item.Coulee+'</td>\n' +
                                    '                                        <td id="Bobine'+item.Id+'">'+item.Bobine+'</td>\n' +
                                    '                                        <td id="Poids'+item.Id+'">'+item.Poids+'</td>\n' +
                                    '                                        <td id="Poids_b'+item.Id+'">'+item.Poids_b+'</td>\n' +
                                    '                                        <td id="Epaisseur'+item.Id+'">'+item.Epaisseur+'</td>\n' +
                                    '                                        <td id="LargeurBande'+item.Id+'">'+item.LargeurBande+'</td>\n' +
                                    '                                        <td>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Edit" class="ContBobEdit text-primary"><i\n' +
                                    '                                                        class="fa fa-edit"></i></button>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Delete" class="ContBobDelete text-danger"><i\n' +
                                    '                                                        class="fa fa-trash"></i></button>\n' +
                                    '                                        </td>\n' +
                                    '                                    </tr>');
                                $('.modal').modal('hide');
                                $('.modal').on('hidden.bs.modal', function (e) {
                                    $(this).removeData();

                                });
                                $('#nbBobs').html(result.Count);
                                $("#BArrivage").val("");
                                $("#Bbobine").val("");
                                $("#Bcoulee").val("");
                                $("#Bpoids").val("");
                                $("#Bpoids_b").val("");
                                $("#BEpaisseur").val("");
                                $("#BLargeurBande").val("");
                                $("#BId").val("");
                                $("#AjouterBobine").html("Ajouter");
                                AddContBobsListeners();
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('bobine_coulee_bobine_unique')) {
                                        alert('La bobine ' + $('#Bbobine').val() + ' existe déjà');
                                    } else {

                                        alert(result.responseJSON.message);
                                        console.log(result);

                                    }
                                }
                            }
                        });
                    } else {
                        const id = $('#BId').val();
                        $.ajax({
                            url: "{{url('/ContBobine/')}}/" + id,
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                _method: 'put',
                                bobine: $('#Bbobine').val(),
                                coulee: $('#Bcoulee').val(),
                                poids: $('#Bpoids').val(),
                                poids_b: $('#Bpoids_b').val(),
                                epaisseur: $('#BEpaisseur').val(),
                                arrivage: $('#BArrivage').val(),
                                largeur_bande: $('#BLargeurBande').val(),
                                Did: $('#Did').val(),
                                Pid: $('#Pid').val(),
                            },
                            success: function (result) {
                                var item= result.bobine;
                                $('#bobine'+id).replaceWith('<tr id="bobine'+item.Id+'">\n' +
                                    '                                        <td id="Arrivage'+item.Id+'">'+item.Arrivage+'</td>\n' +
                                    '                                        <td id="Coulee'+item.Id+'">'+item.Coulee+'</td>\n' +
                                    '                                        <td id="Bobine'+item.Id+'">'+item.Bobine+'</td>\n' +
                                    '                                        <td id="Poids'+item.Id+'">'+item.Poids+'</td>\n' +
                                    '                                        <td id="Poids_b'+item.Id+'">'+item.Poids_b+'</td>\n' +
                                    '                                        <td id="Epaisseur'+item.Id+'">'+item.Epaisseur+'</td>\n' +
                                    '                                        <td id="LargeurBande'+item.Id+'">'+item.LargeurBande+'</td>\n' +
                                    '                                        <td>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Edit" class="ContBobEdit text-primary"><i\n' +
                                    '                                                        class="fa fa-edit"></i></button>\n' +
                                    '                                            <button id="ContBob'+item.Id+'Delete" class="ContBobDelete text-danger"><i\n' +
                                    '                                                        class="fa fa-trash"></i></button>\n' +
                                    '                                        </td>\n' +
                                    '                                    </tr>');
                                $('.modal').modal('hide');
                                $('.modal').on('hidden.bs.modal', function (e) {
                                    $(this).removeData();
                                });


                                $("#BArrivage").val("");
                                $("#Bbobine").val("");
                                $("#Bcoulee").val("");
                                $("#Bpoids").val("");
                                $("#Bpoids_b").val("");
                                $("#BEpaisseur").val("");
                                $("#BLargeurBande").val("");
                                $("#BId").val("");
                                $("#AjouterBobine").html("Ajouter");
                                AddContBobsListeners();
                            },
                            error: function (result) {
                                if (typeof result.responseJSON.message != 'undefined') {
                                    if (result.responseJSON.message.includes('bobine_coulee_bobine_unique')) {
                                        alert('La bobine ' + $('#Bbobine').val() + ' existe déjà');
                                    } else {

                                        alert(result.responseJSON.message);
                                        console.log(result);

                                    }
                                }
                            }
                        });
                    }
                } else {
                    alert('Remplir tous les champs qui sont obligatoires svp!');
                }
            });

            function AddContBobsListeners() {
                $('.ContBobDelete').each(function (e) {
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
                            url: "{{url('/ContBobine/')}}/" + id,
                            method: 'post',
                            data: {
                                _method: 'delete',
                                _token: '{{csrf_token()}}',
                                id: id,


                            },
                            success: function (result) {
                                tr.remove();
                                $('#nbBobs').html(result.Count);
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);
                                console.log(result)
                            }
                        });
                    });
                });
                $('.ContBobEdit').each(function (e) {
                    $(this).off('click');
                    $(this).click(function (e) {
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        $("#BArrivage").val($("#Arrivage" + id).html());
                        $("#Bbobine").val($("#Bobine" + id).html());
                        $("#Bcoulee").val($("#Coulee" + id).html());
                        $("#Bpoids").val($("#Poids" + id).html());
                        $("#Bpoids_b").val($("#Poids_b" + id).html());
                        $("#BEpaisseur").val($("#Epaisseur" + id).html());
                        $("#BLargeurBande").val($("#LargeurBande" + id).html());
                        $("#BId").val(id);
                        $("#AjouterBobine").html("Modifier");
                        $("#NvBobine").trigger("click");
                    });

                });
            }


        });
    </script>
@endsection