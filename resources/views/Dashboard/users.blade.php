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
            width: 100%;
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

    <title>Gestion des Utilisateurs</title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class=" offset-lg-1 col-lg-10  offset-sm-0 col-sm-12">
                <section >
                    <h4 class="text-center  text-info"><b>Gestion Des Utilisateurs</b></h4>
                    <hr>
                    <form id="UsersForm"  class="row text-center">
                        <input type="hidden" id="UserId" name="UserId" value="">
                        <div class="form-group col-md-4 col-7">
                            <label   for="username" > username : </label>
                            <input class="  form-control"  name="username" id="username" type="text"  required >
                        </div>
                        <div class="form-group col-md-3  col-5">
                            <label  for="password"  > Mot de passe : </label>
                            <input class=" form-control"  name="password" id="password" type="text" minlength="8" maxlength="20" required >
                        </div>
                        <div class="form-group col-md-3 col-6">
                            <label  for="role"  > Rôle : </label>
                            <select class=" form-control" name="role" id="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Directeur">Directeur</option>
                                <option value="Chef Controle">Chef Controle</option>
                                <option value="Chef Production">Chef Production</option>
                            </select>
                                  </div>
                        <div class="col-md-2 col-6 form-group  actions ">
                            <label class="col-12">&nbsp</label>
                            <button type="button" id="AnnulerUsers" class=" btn btn-danger" style="width:35px; height:35px; padding:0;" ><i class="fa fa-times"></i></button>
                            <button type="button" id="AjouterUsers" style="width:35px; height:35px; padding:0;" class=" btn btn-info"><i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                    <div class="table-container">
                        <table  class="table table-striped table-hover table-borderless ">
                            <thead class="bg-info text-white">
                            <tr>
                                <th>username</th>
                                <th>password</th>
                                <th>Rôle</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="users">
                            @if(isset($users))
                                @foreach($users as $item)
                                    <tr id="User{{$item->id}}">
                                        <td id="user{{$item->id}}username">{{$item->username}}</td>
                                        <td id="user{{$item->id}}password">********</td>
                                        <td id="user{{$item->id}}role">{{$item->role}}</td>
                                        <td  >
                                            <button id="User{{$item->id}}Edit" class="UserEdit text-primary" ><i class="fa fa-edit"></i></button>
                                            <button id="User{{$item->id}}Delete" class="UserDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>

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


@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#AnnulerUsers').hide();
            addUsersListeners();


            $('#AjouterUsers').click(function(e){

                if($('#UsersForm')[0].checkValidity()) {
                    e.preventDefault();
                    if ($('#AjouterUsers').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('users.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                username: $('#username').val(),
                                password: $('#password').val(),
                                role: $('#role').val(),

                            },
                            success: function (result) {
                                $('#users').append(' <tr id="User'+result.user.id+'">\n' +
                                    '                                            <td id="user'+result.user.id+'username">'+result.user.username+'</td>\n' +
                                    '                                            <td id="user'+result.user.id+'password">********</td>\n' +
                                    '                                            <td id="user'+result.user.id+'role">'+result.user.role+'</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="User'+result.user.id+'Edit" class="UserEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="User'+result.user.id+'Delete" class="UserDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                $('#UsersForm').trigger('reset');
                                $('#AnnulerUsers').hide();
                                $('#AjouterUsers').html('<i class="fa fa-plus"></i>');
                                addUsersListeners();
                                $('#code').prop('required',true);
                            },
                            error: function (result) {
                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le nom et prenoms ou le code sont déjà utilisés par un autre user");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{
                                    alert(result.responseJSON.message);console.log(result);
                                }

                            }
                        });
                    } else {
                        id=$('#UserId').val();
                        $.ajax({
                            url: "{{ url('/users/')}}/"+id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                username: $('#username').val(),
                                password: $('#password').val(),
                                role: $('#role').val(),

                            },
                            success: function (result) {
                                $('#users').find("#User"+id).replaceWith(' <tr id="User'+result.user.id+'">\n' +
                                    '                                            <td id="user'+result.user.id+'username">'+result.user.username+'</td>\n' +
                                    '                                            <td id="user'+result.user.id+'password">********</td>\n' +
                                    '                                            <td id="user'+result.user.id+'role">'+result.user.role+'</td>\n' +
                                    '                                            <td  >\n' +
                                    '                                                <button id="User'+result.user.id+'Edit" class="UserEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                                <button id="User'+result.user.id+'Delete" class="UserDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '\n' +
                                    '                                            </td>\n' +
                                    '                                        </tr>');
                                $('#UsersForm').trigger('reset');
                                $('#AnnulerUsers').hide();
                                $('#AjouterUsers').html('<i class="fa fa-plus"></i>');
                                $('#password').prop('required',true);
                                addUsersListeners();
                            },
                            error: function (result) {
                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("Le nom et prenoms ou le code sont déjà utilisés par un autre user");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{
                                    alert(result.responseJSON.message);console.log(result);
                                }
                            }
                        });


                    }
                }else{
                    alert('Remplire tous les champs svp!');
                }
            });
            function addUsersListeners(){
                $('.UserDelete').each(function(e){
                    $(this).off('click');$(this).click(function(e){
                        tr= $(this).parent().parent();
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url:  "{{url('/users/')}}/"+id,
                            method: 'post',
                            data: {
                                _method :'delete',
                                _token :'{{csrf_token()}}',
                                id :id,


                            },
                            success: function(result){
                                tr.remove();
                                $('#UsersForm').trigger('reset');
                                $('#AnnulerUsers').hide();
                                $('#AjouterUsers').html('<i class="fa fa-plus"></i>');
                                $('#password').prop('required',true);
                            },
                            error: function(result){
                                alert(result.responseJSON.message);console.log(result)
                            }
                        });
                    });
                });
                $('.UserEdit').each(function(e){
                    $(this).off('click');$(this).click(function(e){
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        tr= $(this).parent().parent();
                        $('#UserId').val(id);
                        $('#username').val(tr.find('#user'+id+'username').html());
                        $('#role').val(tr.find('#user'+id+'role').html());
                        $('#AnnulerUsers').show();
                        $('#AjouterUsers').html('<i class="fa fa-check"></i>');
                        $('#password').prop('required',false);
                    });
                });
            }
            $('#AnnulerUsers').click(function(e){
                e.preventDefault();
                $('#UsersForm').trigger('reset');
                $(this).hide();
                $('#AjouterUsers').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>

@endsection