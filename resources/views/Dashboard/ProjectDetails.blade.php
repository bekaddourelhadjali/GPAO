@extends('layouts.dashboardTemp')
@section('style')
    <style>
        section{
            padding-left: 10px;
            padding-right: 5px;
        }
        .actions{
            padding-right: 0;
        }
        .tab-pane h4{
            padding:10px 0;
        }
        .table{
            width:130%;
        }
        .table-container{
            overflow: auto;
            position:relative;
        }
        #cont{
            position: relative;
        }
        #tr-actions {
            display:none;
            position:absolute;
            z-index:10;
        }
        #tr-actions button
        ,#tr-actions i.fa{
            font-size: 17px;
            border:none;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link "   href="{{route('projects.index')}}"  ><b>Projets</b></a>
             <a class="nav-item nav-link   active " id="nav-detail_projects-tab" data-toggle="tab" href="#nav-detail_projects" role="tab" aria-controls="nav-detail_projects" aria-selected="true"><b>Details Projets</b></a>
            <a class="nav-item nav-link "   href="{{route('clients.index')}}"  ><b>Clients</b></a>

            {{--<a class="nav-item nav-link  @if(isset($target)&& $target=='detail_projects') active @endif" id="nav-detail_projects-tab" data-toggle="tab" href="#nav-detail_projects" role="tab" aria-controls="nav-detail_projects" aria-selected="false"><b>detail_projects</b></a>--}}

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade   show active"   id="nav-detail_projects" role="tabpanel" aria-labelledby="nav-detail_projects-tab">
            <div class="row">
                <div class="col-12">
                    <section >
                        <h4 class="text-center bg-gradient-info text-white"><b>Gestion Des Details des projets</b></h4>
                        <hr>
                        <form id="detail_projectsForm" class="row text-center">
                            <input type="hidden" id="DetailProjectId" name="id" value="">
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4">
                                <label   for="project" >  Projet  </label>
                                <select class="form-control col-12" name="project" id="project"  required>
                                    <option disabled value="0" selected></option>
                                    @if(isset($projects))
                                        @foreach($projects as $project)
                                            <option value="{{$project->Nom}}">{{$project->Nom}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="nuance"  > Nuance </label>
                                <input class=" form-control"  name="nuance" id="nuance" type="text" step="0.01"  required >
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="epaisseur"  > Epaisseur </label>
                                <input class=" form-control"  name="epaisseur" id="epaisseur" type="number" step="0.01"  required >
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="diametre"  > Diametre </label>
                                <input class=" form-control"  name="diametre" id="diametre" type="number" step="0.01" required  >
                            </div>
                            <div class="form-group  col-xl-1 col-lg-2 col-md-3 col-sm-4  ">
                                <label  for="psl"  > PSL </label>
                                <input class=" form-control"  name="psl" id="psl" type="number"    required >
                            </div>
                            <div class="form-group col-xl-1 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="qty"  > Quantité </label>
                                <input class=" form-control"  name="qty" id="qty" type="number"    required  >
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="mmTube"  > MM Tube </label>
                                <input class=" form-control"  name="mmTube" id="mmTube" type="number" step="0.01"  required  >
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4 ">
                                <label  for="mmBobine"  > MM Bobine </label>
                                <input class=" form-control"  name="mmBobine" id="mmBobine" type="number" step="0.01"  required  >
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4">
                                <label   for="poidsM" > Poids M </label>
                                <input class="  form-control"  name="poidsM" id="poidsM"  type="number" step="0.01" required>
                            </div>
                            <div class="form-group col-xl-2 col-lg-2 col-md-3 col-sm-4">
                                <label   for="largeur" > Largeur </label>
                                <input class="  form-control"  name="largeur" id="largeur" type="number" step="0.01"  required >
                            </div>
                            <div class="form-group col-xl-1 col-lg-2 col-md-3 col-sm-4">
                                <label   for="riveG" > Rive G </label>
                                <input class="  form-control"  name="riveG" id="riveG" type="number" step="0.01"  required >
                            </div>
                            <div class="form-group col-xl-1 col-lg-2 col-md-3 col-sm-4">
                                <label   for="riveD" > Rive D </label>
                                <input class="  form-control"  name="riveD" id="riveD" type="number" step="0.01" required  >
                            </div>
                            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4">
                                <label   for="libelle" > Libelle </label>
                                <input class="  form-control"  name="libelle" id="libelle" type="text" required  >
                            </div>
                            <div class="col-xl-2 col-sm-2 form-group  actions ">
                                <label class="col-12">&nbsp</label>
                                <button type="button" id="AnnulerDetail_project" class=" btn btn-danger" style="width:35px; height:35px; padding:0;" ><i class="fa fa-times"></i></button>
                                <button type="button" id="AjouterDetail_project" style="width:35px; height:35px; padding:0;" class=" btn btn-info"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>
                        <hr>
                        <div id="cont">
                        <div class="table-container">
                            <table  class="table  table-hover  ">
                                <thead class="bg-info text-white">
                                <tr id="detail_projectsTH">
                                    <th>Projet</th>
                                    <th>Nuance</th>
                                    <th>Epaisseur</th>
                                    <th>Diametre</th>
                                    <th>PSL</th>
                                    <th>Quantité</th>
                                    <th>MM Tube</th>
                                    <th>MM Bobine</th>
                                    <th>Poids M</th>
                                    <th>Largeur</th>
                                    <th>Rive G</th>
                                    <th>Rive D</th>
                                    <th>Libelle</th>
                                </tr>
                                </thead>
                                <tbody id="detail_projects">
                                @if(isset($detail_projects))
                                    @foreach($detail_projects as $detail_project)
                                <tr id="detail_project{{$detail_project->Did}}" class="detail_projectRow">
                                    <td id="detail_project{{$detail_project->Did}}project">{{$detail_project->project->Nom}}</td>
                                    <td id="detail_project{{$detail_project->Did}}nuance">{{$detail_project->Nuance}}</td>
                                    <td id="detail_project{{$detail_project->Did}}epaisseur">{{$detail_project->Epaisseur}}</td>
                                    <td id="detail_project{{$detail_project->Did}}diametre">{{$detail_project->Diametre}}</td>
                                    <td id="detail_project{{$detail_project->Did}}psl">{{$detail_project->Psl}}</td>
                                    <td id="detail_project{{$detail_project->Did}}qty">{{$detail_project->Qty}}</td>
                                    <td id="detail_project{{$detail_project->Did}}mmTube">{{$detail_project->MMtube}}</td>
                                    <td id="detail_project{{$detail_project->Did}}mmBobine">{{$detail_project->MMBobine}}</td>
                                    <td id="detail_project{{$detail_project->Did}}poidsM">{{$detail_project->PoidsM}}</td>
                                    <td id="detail_project{{$detail_project->Did}}largeur">{{$detail_project->Largeur}}</td>
                                    <td id="detail_project{{$detail_project->Did}}riveG">{{$detail_project->RiveG}}</td>
                                    <td id="detail_project{{$detail_project->Did}}riveD">{{$detail_project->RiveD}}</td>
                                    <td id="detail_project{{$detail_project->Did}}libelle">{{$detail_project->Libelle}}</td>
                                </tr>

                                    @endforeach
                                @endif
                                </tbody>

                            </table>

                        </div>
                            <div  id="tr-actions">
                                <button  class="detail_projectEdit btn btn-primary" ><i class="fa fa-edit"></i></button>
                                <button   class="detail_projectDelete btn btn-danger" ><i class="fa fa-trash"></i></button>

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
        $(document).ready(function(){
            $('#AnnulerDetail_project').hide();
            $('#project').val('');
            addDetail_projectsListeners();


            $('#AjouterDetail_project').click(function(e){

                if($('#detail_projectsForm')[0].checkValidity()) {


                    e.preventDefault();
                    if ($('#AjouterDetail_project').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('details_project.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Nom: $('#project').val(),
                                Nuance: $('#nuance').val(),
                                Epaisseur: $('#epaisseur').val(),
                                Diametre: $('#diametre').val(),
                                Psl: $('#psl').val(),
                                Qty: $('#qty').val(),
                                MMtube: $('#mmTube').val(),
                                MMBobine: $('#mmBobine').val(),
                                PoidsM: $('#poidsM').val(),
                                Largeur: $('#largeur').val(),
                                RiveG: $('#riveG').val(),
                                RiveD: $('#riveD').val(),
                                Libelle: $('#libelle').val(),

                            },
                            success: function (result) {
                                $('#detail_projects').append('<tr id="detail_project'+result.detail_project.Did+'" class="detail_projectRow">\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'project">'+result.detail_project.projectName+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'nuance">'+result.detail_project.Nuance+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'epaisseur">'+result.detail_project.Epaisseur+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'diametre">'+result.detail_project.Diametre+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'psl">'+result.detail_project.Psl+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'qty">'+result.detail_project.Qty+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'mmTube">'+result.detail_project.MMtube+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'mmBobine">'+result.detail_project.MMBobine+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'poidsM">'+result.detail_project.PoidsM+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'largeur">'+result.detail_project.Largeur+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'riveG">'+result.detail_project.RiveG+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'riveD">'+result.detail_project.RiveD+'</td>\n' +
                                    '                                    <td id="detail_project'+result.detail_project.Did+'libelle">'+result.detail_project.Libelle+'</td>\n' +
                                    '                                </tr>');
                                addDetail_projectsListeners();
                            },
                            error: function (result) {
                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le detail projet existe déjà");
                                        console.log(result);
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{
                                    console.log(result);

                                }
                            }
                        });
                    } else {
                        id=$('#DetailProjectId').val();
                        $.ajax({
                            url: "{{ url('/details_project/')}}/"+id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                Nom: $('#project').val(),
                                Nuance: $('#nuance').val(),
                                Epaisseur: $('#epaisseur').val(),
                                Diametre: $('#diametre').val(),
                                Psl: $('#psl').val(),
                                Qty: $('#qty').val(),
                                MMtube: $('#mmTube').val(),
                                MMBobine: $('#mmBobine').val(),
                                PoidsM: $('#poidsM').val(),
                                Largeur: $('#largeur').val(),
                                RiveG: $('#riveG').val(),
                                RiveD: $('#riveD').val(),
                                Libelle: $('#libelle').val(),

                            },
                            success: function (result) {
                                console.log(result);
                                $('#detail_projects').find('#detail_project'+id).replaceWith('<tr id="detail_project'+result.detail_project.Did+'" class="detail_projectRow">\n'  +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'project">'+result.detail_project.projectName+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'nuance">'+result.detail_project.Nuance+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'epaisseur">'+result.detail_project.Epaisseur+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'diametre">'+result.detail_project.Diametre+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'psl">'+result.detail_project.Psl+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'qty">'+result.detail_project.Qty+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'mmTube">'+result.detail_project.MMtube+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'mmBobine">'+result.detail_project.MMBobine+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'poidsM">'+result.detail_project.PoidsM+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'largeur">'+result.detail_project.Largeur+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'riveG">'+result.detail_project.RiveG+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'riveD">'+result.detail_project.RiveD+'</td>\n' +
                                    '                                    \'                                    <td id="detail_project'+result.detail_project.Did+'libelle">'+result.detail_project.Libelle+'</td>\n' +
                                    '                                    \'                                </tr>');
                                addDetail_projectsListeners();
                                $('#detail_projectsForm').trigger('reset');
                                $('#AnnulerDetail_project').hide();
                                $('#AjouterDetail_project').html('<i class="fa fa-plus"></i>');
                            },
                            error: function (result) {

                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le detail projet existe déjà");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{ console.log(result);

                                }
                            }
                        });


                    }

                    }else{
                        alert('Remplire tous les champs svp!');
                    }
            });
            function addDetail_projectsListeners(){
                $('.detail_projectDelete').each(function(e){
                    $(this).off('click');
                    $(this).off('click');$(this).click(function(e){
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        tr= $(this).parent().parent().find('#detail_project'+id);
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url:  "{{url('/details_project/')}}/"+id,
                            method: 'post',
                            data: {
                                _method :'delete',
                                _token :'{{csrf_token()}}',
                                id :id,


                            },
                            success: function(result){
                                tr.remove();
                                e.preventDefault();
                                $('#detail_projectsForm').trigger('reset');
                                $('#AnnulerDetail_project').hide();
                                $('#AjouterDetail_project').html('<i class="fa fa-plus"></i>');
                                $('#tr-actions').hide();
                            },
                            error: function(result){
                                alert(result.responseJSON.message);console.log(result)
                            }
                        });
                    });
                });
                $('.detail_projectEdit').each(function(e){

                    $(this).off('click');
                    $(this).off('click');$(this).click(function(e){
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        $('#DetailProjectId').val(id);
                        $('#project').val($('#detail_project'+id+'project').html());
                        $('#nuance').val($('#detail_project'+id+'nuance').html());
                        $('#epaisseur').val($('#detail_project'+id+'epaisseur').html());
                        $('#diametre').val($('#detail_project'+id+'diametre').html());
                        $('#psl').val($('#detail_project'+id+'psl').html());
                        $('#qty').val($('#detail_project'+id+'qty').html());
                        $('#mmTube').val($('#detail_project'+id+'mmTube').html());
                        $('#mmBobine').val($('#detail_project'+id+'mmBobine').html());
                        $('#poidsM').val($('#detail_project'+id+'poidsM').html());
                        $('#largeur').val($('#detail_project'+id+'largeur').html());
                        $('#riveG').val($('#detail_project'+id+'riveG').html());
                        $('#riveD').val($('#detail_project'+id+'riveD').html());
                        $('#libelle').val($('#detail_project'+id+'libelle').html());
                        $('#AnnulerDetail_project').show();
                        $('#AjouterDetail_project').html('<i class="fa fa-check"></i>');
                    });
                });
                addActions();
            }
            $('#AnnulerDetail_project').click(function(e){
                e.preventDefault();
                $('#detail_projectsForm').trigger('reset');
                $(this).hide();
                $('#project').val('');
                $('#AjouterDetail_project').html('<i class="fa fa-plus"></i>');
            });
            detail_projectId = 0;
            function addActions() {

                $(".detail_projectRow").each(function () {
                    $(this).off('mouseover');
                    $(this).mouseover(function () {

                        $(this).css({
                            'color': '#858796',
                            'background-color': 'rgba(0,0,0,.075)'
                        });

                        var o = $(this);
                        var offset = o.offset();
                        const id = $(this).attr("id").replace(/[^0-9]/g, '');
                        detail_projectId = id;
                        $('#tr-actions .detail_projectDelete').each(function () {
                            $(this).attr('id', 'detail_project' + id + 'Delete');
                        });
                        $('#tr-actions .detail_projectEdit').each(function () {
                            $(this).attr('id', 'detail_project' + id + 'Edit');
                        });

                        var height = ($(this).height() - $('#tr-actions').height()) / 2;
                        var width = ($('#detail_projectsForm').width() - $('#tr-actions').width()) / 2;
                        $('#tr-actions').css({
                            'top': (offset.top - $('.table').offset().top) + height,
                            'left': width,
                        }).show();

                    })
                        .mouseout(function () {
                            $('#detail_project' + detail_projectId).css({
                                'color': '#000',
                                'background-color': '#fff'
                            });
                            $('#tr-actions').hide();
                        });
                });

            }
            $('#tr-actions').mouseover(function () {
                $(this).show();
                $('#detail_project' + detail_projectId).css({
                    'color': '#858796',
                    'background-color': 'rgba(0,0,0,.075)'
                });
            });
            $('#tr-actions').mouseout(function () {
                $('#detail_project' + detail_projectId).css({
                    'color': '#000',
                    'background-color': '#fff'
                });
            });
        });
    </script>

@endsection