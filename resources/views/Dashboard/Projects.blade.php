@extends('layouts.dashboardTemp')
@section('style')
    <title>Gestion Des Projets</title>
    <style>
        section{
            padding-left: 10px;
            padding-right: 5px;
        }
        .actions{
            padding-right: 0;
        }
        .table-container{
            max-height: 350px;
        }
        .card{
            margin-top:25px;
            border-color: #aaa;
            background-color: #eef;
        }
        .tab-pane h4{
            padding:10px 0;
        }
        .table-container-small{
            max-height:175px;
            overflow: auto;
        }
        .small-section{
            box-shadow: none;
        }
        input[type="date"]{
            padding-right: 2px;
            padding-left: 2px;
        }

    </style>
@endsection
@section('content')
<div class="container-fluid">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <a class="nav-item nav-link    active  " id="nav-projects-tab" data-toggle="tab" href="#nav-projects" role="tab" aria-controls="nav-projects" aria-selected="false"><b>Projets</b></a>
            <a class="nav-item nav-link "   href="{{route('details_project.index')}}"  ><b>Details Projets</b></a>
            <a class="nav-item nav-link "   href="{{route('clients.index')}}"  ><b>Clients</b></a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade  show active  " id="nav-projects" role="tabpanel" aria-labelledby="nav-projects-tab">  <div class="row">
                <div class="col-12">
                    <section style="">

                        <h4 class="text-center  text-primary"><b>Gestion Des Projets</b></h4>
                        <hr>
                        <div class="row">
                        <form id="ProjectsForm" class="col-12">
                            <input type="hidden" id="ProjectId" name="id" value="">
                        <div class="row text-center">
                            <div class="form-group col-xl-2 col-lg-3  col-sm-4">
                                <label   for="nom" > Nom  </label>
                                <input class="  form-control"  name="nom" id="nom" type="text"  required >
                            </div>
                            <div class="form-group col-xl-2 col-lg-3 col-sm-4">
                                <label  for="startDate"  > Date de début  </label>
                                <input class=" form-control"  name="startDate" id="startDate" type="date" value="{{date("Y-m-d") }}" required >
                            </div>
                            <div class="form-group col-xl-2 col-sm-4">
                                <label  for="endDate"  > Date de fin  </label>
                                <input class=" form-control"  name="endDate" id="endDate" type="date" value="{{date("Y-m-d") }}" required >
                            </div>
                            <div class="form-group  col-lg-3 col-sm-6">
                                <label   for="etat" >  Etat   </label>
                                <select class="form-control col-12" name="etat" id="etat"  required>
                                    <option   value="E" selected>En cours</option>
                                    <option   value="C" >Fini</option>
                                    <option   value="A" >Arreté</option>
                                </select>
                            </div>
                            <div class="form-group   col-lg-3 col-sm-6 ">
                                <label   for="name" >  Client   </label>
                                <select class="form-control col-12" name="customer" id="customer"  required>
                                    <option disabled value="0" selected></option>
                                    @if(isset($clients))
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group  col-sm-6">
                                <label  for="comments"  > Commentaires  </label>
                                <input class=" form-control"  name="comments" id="comments" type="text"   >
                            </div>
                            <div class="col-xl-1 form-group  col-md-2 col-sm-4 actions">
                                <label class="col-12">&nbsp</label>
                                <button type="button" id="AnnulerProject" class=" btn btn-danger" style="width:35px; height:35px; padding:0;"  ><i class="fa fa-times"></i></button>
                                <button type="button" id="AjouterProject" class=" btn btn-success" style="width:35px; height:35px; padding:0;" ><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        </form>

                        </div>
                        <hr>
                        <div class="row" id="Projects" >
                            @if(isset($projects))
                                @foreach($projects as $project)
                            <div class="   col-md-4 col-sm-6" >
                                <div class="card bg-light  ">
                                    <div class="card-body text-center " id="Project{{$project->Pid}}">
                                        <h5 class="card-title text-center "><b><i class="fa fa-tasks text-primary"></i>&nbsp;&nbsp;&nbsp;<span id="project{{$project->Pid}}Nom">{{$project->Nom}}</span></b></h5>
                                        <hr>
                                        <p class="card-text"><b><i class="fa fa-clock text-warning"></i>&nbsp;&nbsp;Date de début : <span id="project{{$project->Pid}}StartDate">{{$project->StartDate}}</span> </b></p>
                                        <p class="card-text"><b><i class="fa fa-clock text-success"></i>&nbsp;&nbsp;&nbsp;Date de fin : <span id="project{{$project->Pid}}EndDate">{{$project->EndDate}}</span>  </b></p>
                                        <p class="card-text"><b><i class="fa fa-question text-success"></i>&nbsp;&nbsp;&nbsp;Etat : <span id="project{{$project->Pid}}EndDate">
                                                    @if($project->Etat=="E") En cours @elseif($project->Etat=="A")Arreté @else Fini @endif</span>  </b></p>
                                        <div class="text-center">
                                        <button type="button" id="Edit{{$project->Pid}}Project" class="EditProject btn btn-primary" style="width:35px; height:35px; padding:0;" data-dismiss="modal"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="Supprimer{{$project->Pid}}Project" style="width:35px; height:35px; padding:0;" class="SupprimerProject btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
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
            $('#customer').val('');
            $('#AnnulerProject').hide();
            addProjectsListeners();


            $('#AjouterProject').click(function(e){

                if($('#ProjectsForm')[0].checkValidity()) {
                    e.preventDefault();
                    if ($('#AjouterProject').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('projects.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                nom: $('#nom').val(),
                                startDate: $('#startDate').val(),
                                endDate: $('#endDate').val(),
                                comments: $('#comments').val(),
                                customer: $('#customer').val(),
                                etat: $('#etat').val(),

                            },
                            success: function (result) {
                                $('#Projects').append('<div class="   col-md-4 col-sm-6" >\n' +
                                    '                                <div class="card bg-light  ">\n' +
                                    '                                    <div class="card-body text-center " id="Project'+result.project.Pid+'">\n' +
                                    '                                        <h5 class="card-title text-center "><b><i class="fa fa-tasks text-primary"></i>&nbsp;&nbsp;&nbsp;<span id="project'+result.project.Pid+'Nom">'+result.project.Nom+'</span></b></h5>\n' +
                                    '                                        <hr>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-clock text-warning"></i>&nbsp;&nbsp;Date de début : <span id="project'+result.project.Pid+'StartDate">'+result.project.StartDate+'</span> </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-clock text-success"></i>&nbsp;&nbsp;&nbsp;Date de fin : <span id="project'+result.project.Pid+'EndDate">'+result.project.EndDate+'</span>  </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-question text-success"></i>&nbsp;&nbsp;&nbsp;Etat: <span id="project'+result.project.Pid+'EndDate">'+result.project.Etat+'</span>  </b></p>\n' +
                                    '                                        <div class="text-center">\n' +
                                    '                                        <button type="button" id="Edit'+result.project.Pid+'Project" class="EditProject btn btn-primary" style="width:35px; height:35px; padding:0;" data-dismiss="modal"><i class="fa fa-edit"></i></button>\n' +
                                    '                                        <button type="button" id="Supprimer'+result.project.Pid+'Project" style="width:35px; height:35px; padding:0;" class="SupprimerProject btn btn-danger"><i class="fa fa-trash"></i></button>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>\n' +
                                    '                            </div>');
                                addProjectsListeners();
                            },
                            error: function (result) {
                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le projet: "+$('#nom').val()+"est déjà utilisé par un autre projet");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{
                                    console.log(result);

                                }
                            }
                        });
                    } else {
                        id=$('#ProjectId').val();
                        $.ajax({
                            url: "{{ url('/projects/')}}/"+id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                nom: $('#nom').val(),
                                startDate: $('#startDate').val(),
                                endDate: $('#endDate').val(),
                                comments: $('#comments').val(),
                                customer: $('#customer').val(),
                                etat: $('#etat').val(),
                            },
                            success: function (result) {
                                console.log(result);
                                $('#Project'+id).html(
                                    '                                        <h5 class="card-title text-center "><b><i class="fa fa-tasks text-primary"></i>&nbsp;&nbsp;&nbsp;<span id="project'+result.project.Pid+'Nom">'+result.project.Nom+'</span></b></h5>\n' +
                                    '                                        <hr>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-clock text-warning"></i>&nbsp;&nbsp;Date de début : <span id="project'+result.project.Pid+'StartDate">'+result.project.StartDate+'</span> </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-clock text-success"></i>&nbsp;&nbsp;&nbsp;Date de fin : <span id="project'+result.project.Pid+'EndDate">'+result.project.EndDate+'</span>  </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-question text-success"></i>&nbsp;&nbsp;&nbsp;Etat: <span id="project'+result.project.Pid+'EndDate">'+result.project.Etat+'</span>  </b></p>\n' +
                                    '                                        <div class="text-center">\n' +
                                    '                                        <button type="button" id="Edit'+result.project.Pid+'Project" class="EditProject btn btn-primary" style="width:35px; height:35px; padding:0;" data-dismiss="modal"><i class="fa fa-edit"></i></button>\n' +
                                    '                                        <button type="button" id="Supprimer'+result.project.Pid+'Project" style="width:35px; height:35px; padding:0;" class="SupprimerProject btn btn-danger"><i class="fa fa-trash"></i></button>\n'  );
                                $('#ProjectsForm').trigger('reset');
                                $('#customer').val('');
                                $('#AnnulerProject').hide();
                                $('#AjouterProject').html('<i class="fa fa-plus"></i>');
                                addProjectsListeners();
                            },
                            error: function (result) {

                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le projet: "+$('#nom').val()+"est déjà utilisé par un autre projet");
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
            function addProjectsListeners(){
                $('.SupprimerProject').each(function(e){
                    $(this).off('click');$(this).click(function(e){
                        card= $(this).parent().parent().parent().parent();
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url:  "{{url('/projects/')}}/"+id,
                            method: 'post',
                            data: {
                                _method :'delete',
                                _token :'{{csrf_token()}}',
                                id :id,


                            },
                            success: function(result){
                                card.remove();
                            },
                            error: function(result){
                                alert(result.responseJSON.message);console.log(result)
                            }
                        });
                    });
                });
                $('.EditProject').each(function(e){
                    $(this).off('click');$(this).click(function(e){
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        card= $(this).parent().parent();
                        $.ajax({
                            url: "{{ url('/projects/')}}/"+id,
                            method: 'get',
                            data: {
                                id: id,
                            },
                            success: function (result) {

                                console.log(result);
                                 $('#nom').val(result.project.Nom);
                                 $('#ProjectId').val(result.project.Pid);
                                 $('#startDate').val(result.project.StartDate);
                                 $('#endDate').val(result.project.EndDate);
                                 $('#comments').val(result.project.Comments);
                                 $('#customer').val(result.project.Customer);
                                 if(result.project.Etat.substring(0,1)=="F"){

                                     $('#etat').val("C");
                                 }else{
                                     $('#etat').val(result.project.Etat.substring(0,1));
                                 }
                                 $('#AnnulerProject').show();
                                $('#AjouterProject').html('<i class="fa fa-check"></i>');
                            },
                            error: function (result) {

                                if(typeof result.responseJSON.message !='undefined'){

                                        alert(result.responseJSON.message);console.log(result);
                                }else{ console.log(result);

                                }
                            }
                        });



                    });
                });
            }
            $('#AnnulerProject').click(function(e){
                e.preventDefault();
                $('#ProjectsForm').trigger('reset');
                $('#customer').val('');
                $(this).hide();
                $('#AjouterProject').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>

@endsection