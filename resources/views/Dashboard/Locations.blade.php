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

    </style>
@endsection
@section('content')
<div class="container-fluid">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <a class="nav-item nav-link "   href="{{route('affectations.index')}}"  ><b>Affectations</b></a>
            <a class="nav-item nav-link  @if(isset($target)&& $target=='locations') active @endif" id="nav-locations-tab" data-toggle="tab" href="#nav-locations" role="tab" aria-controls="nav-locations" aria-selected="false"><b>Locations</b></a>
            <a class="nav-item nav-link @if(isset($target)&& $target=='agents') active @endif" id="nav-agents-tab" data-toggle="tab" href="#nav-agents" role="tab" aria-controls="nav-agents" aria-selected="true"><b>Agents et Machines</b></a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade @if(isset($target)&& $target=='locations') show active @endif" id="nav-locations" role="tabpanel" aria-labelledby="nav-locations-tab">  <div class="row">
                <div class="col-12">
                    <section style="">

                        <h4 class="text-center bg-gradient-info text-white"><b>Gestion Des Locations</b></h4>
                        <hr>
                        <div class="row">
                        <form id="LocationsForm" class="col-12">
                            <input type="hidden" id="locationId" name="id" value="">
                        <div class="row text-center">
                            <div class="form-group col-lg-3 offset-lg-2 col-md-5  col-sm-8">
                                <label   for="designation" > Designation : </label>
                                <input class="  form-control"  name="designation" id="designation" type="text"  required >
                            </div>
                            <div class="form-group col-lg-1 col-md-2 col-sm-4">
                                <label  for="zone"  > Zone : </label>
                                <input class=" form-control"  name="zone" id="zone" type="text"  required >
                            </div>
                            <div class="form-group col-lg-2 col-md-3 col-sm-6">
                                <label  for="ipaddress"  > Adresse IP : </label>
                                <input class=" form-control"  name="ipaddress" id="ipaddress" type="text"  required >
                            </div>
                            <div class="col-lg-1 form-group  col-md-2 col-sm-6 actions">
                                <label class="col-12">&nbsp</label>
                                <button type="button" id="AnnulerLocation" class=" btn btn-danger" style="width:35px; height:35px; padding:0;"  ><i class="fa fa-times"></i></button>
                                <button type="button" id="AjouterLocation" class=" btn btn-success" style="width:35px; height:35px; padding:0;" ><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        </form>

                        </div>
                        <hr>
                        <div class="row" id="locations" >
                            @if(isset($locations))
                                @foreach($locations as $location)
                            <div class=" col-lg-3  col-md-4 col-sm-6" >
                                <div class="card">
                                    <div class="card-body " id="location{{$location->id}}">
                                        <h5 class="card-title text-center "><b><span id="location{{$location->id}}Designation">{{$location->Designation}}</span></b></h5>
                                        <hr>
                                        <p class="card-text"><b><i class="fa fa-desktop text-warning"></i>&nbsp;&nbsp;Adresse IP : <span id="location{{$location->id}}AdresseIp">{{$location->AdresseIp}}</span> </b></p>
                                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;Zone : <span id="location{{$location->id}}Zone">{{$location->Zone}}</span>  </b></p>
                                        <div class="text-center">
                                        <button type="button" id="Edit{{$location->id}}Location" class="EditLocation btn btn-primary" style="width:35px; height:35px; padding:0;" data-dismiss="modal"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="Supprimer{{$location->id}}Location" style="width:35px; height:35px; padding:0;" class="SupprimerLocation btn btn-danger"><i class="fa fa-trash"></i></button>
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
        <div class="tab-pane fade @if(isset($target)&& $target=='agents') show active @endif " id="nav-agents" role="tabpanel" aria-labelledby="nav-agents-tab">
            <div class="row">
                <div class="col-lg-6  col-sm-12">
                    <section >
                        <h4 class="text-center bg-gradient-info text-white"><b>Gestion Des Agents</b></h4>
                        <hr>
                        <form id="AgentsForm" class="row text-center">
                            <input type="hidden" id="AgentId" name="id" value="">
                            <div class="form-group col-7">
                                <label   for="nomPrenom" > Nom et Prenoms : </label>
                                <input class="  form-control"  name="nomPrenom" id="nomPrenom" type="text"  required >
                            </div>
                            <div class="form-group col-2 ">
                                <label  for="code"  > Code : </label>
                                <input class=" form-control"  name="code" id="code" type="text"  required >
                            </div>
                            <div class="col-3 form-group  actions ">
                                <label class="col-12">&nbsp</label>
                                <button type="button" id="AnnulerAgent" class=" btn btn-danger" style="width:35px; height:35px; padding:0;" ><i class="fa fa-times"></i></button>
                                <button type="button" id="AjouterAgent" style="width:35px; height:35px; padding:0;" class=" btn btn-info"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>
                        <div class="table-container">
                            <table  class="table table-striped table-hover table-bordered ">
                                <thead class="bg-info text-white">
                                <tr>
                                    <th>Nom et Prenoms</th>
                                    <th>Code</th>
                                </tr>
                                </thead>
                                <tbody id="agents">
                                @if(isset($agents))
                                    @foreach($agents as $agent)
                                <tr id="Agent{{$agent->id}}">
                                    <td id="agent{{$agent->id}}nomPrenom">{{$agent->NomPrenom}}</td>
                                    <td id="agent{{$agent->id}}Code">{{$agent->Code}}</td>
                                    <td  >
                                        <button id="Agent{{$agent->id}}Edit" class="AgentEdit text-primary" ><i class="fa fa-edit"></i></button>
                                        <button id="Agent{{$agent->id}}Delete" class="AgentDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>

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
                    <section >
                        <h4 class="text-center bg-gradient-warning text-white"><b>Gestion Des Machines</b></h4>
                        <hr>
                        <form id="MachinesForm" class="row text-center">
                            <input type="hidden" id="MachineId" name="id" value="">
                            <div class="form-group col-3">
                                <label   for="machine" > Machine : </label>
                                <input class="  form-control"  name="machine" id="machine" type="text"  required >
                            </div>
                            <div class="form-group col-2 ">
                                <label  for="zoneMachine"  > Zone : </label>
                                <input class=" form-control"  name="zoneMachine" id="zoneMachine" type="text"  required >
                            </div>

                            <div class="form-group col-4 ">
                                <label  for="Description"  > Description : </label>
                                <input class=" form-control"  name="Description" id="Description" type="text"   >
                            </div>
                            <div class="col-3 form-group  actions ">
                                <label class="col-12">&nbsp</label>
                                <button type="button" id="AnnulerMachine" class=" btn btn-danger" style="width:35px; height:35px; padding:0;" ><i class="fa fa-times"></i></button>
                                <button type="button" id="AjouterMachine" style="width:35px; height:35px; padding:0;" class=" btn btn-warning"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>
                        <div class="table-container">
                            <table class="table table-striped table-hover table-bordered ">
                                <thead class="bg-warning text-white">
                                <tr>
                                    <th>Machine</th>
                                    <th>Zone</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody id="machines">
                                @if(isset($machines))
                                    @foreach($machines as $machine)
                                        <tr id="Machine{{$machine->id}}">
                                            <td id="machine{{$machine->id}}Machine">{{$machine->Machine}}</td>
                                            <td id="machine{{$machine->id}}Zone">{{$machine->Zone}}</td>
                                            <td id="machine{{$machine->id}}Description">{{$machine->Description}}</td>
                                            <td  >
                                                <button id="machine{{$machine->id}}Edit" class="machineEdit text-primary" ><i class="fa fa-edit"></i></button>
                                                <button id="machine{{$machine->id}}Delete" class="machineDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>

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
        $(document).ready(function(){
            $('#AnnulerLocation').hide();
            addLocationsListeners();


            $('#AjouterLocation').click(function(e){

                if($('#LocationsForm')[0].checkValidity()) {
                    if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test($('#ipaddress').val())) {


                    e.preventDefault();
                    if ($('#AjouterLocation').html() === '<i class="fa fa-plus"></i>') {

                        $.ajax({
                            url: "{{ route('Locations.store')}}",
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                Designation: $('#designation').val(),
                                Zone: $('#zone').val(),
                                IPAddress: $('#ipaddress').val(),

                            },
                            success: function (result) {
                                $('#locations').append('<div class="col-lg-3  col-md-4 col-sm-6" ><div class="card">\n' +
                                    '                                    <div class="card-body" id="location'+result.location.id+'">\n' +
                                    '                                        <h5 class="card-title text-center "><b><span id="location'+result.location.id+'Designation">'+result.location.Designation+'</span></b></h5>\n' +
                                    '                                        <hr>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-desktop text-warning"></i>&nbsp;&nbsp;Adresse IP : <span id="location'+result.location.id+'AdresseIp">'+result.location.AdresseIp+'</span> </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;Zone : <span id="location'+result.location.id+'Zone">'+result.location.Zone+'</span></b></p>\n' +
                                    '                                        <div class="text-center">\n' +
                                    '                                        <button type="button" id="Edit'+result.location.id+'Location" class="EditLocation btn btn-primary" style="width:35px; height:35px; padding:0;" ><i class="fa fa-edit"></i></button>\n' +
                                    '                                        <button type="button" id="Supprimer'+result.location.id+'Location" style="width:35px; height:35px; padding:0;" class="SupprimerLocation btn btn-danger"><i class="fa fa-trash"></i></button>\n' +
                                    '                                        </div>\n' +
                                    '                                    </div>\n' +
                                    '                                </div>'+
                                    '                                </div>');
                                addLocationsListeners();
                            },
                            error: function (result) {
                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("L'adresse IP : "+$('#ipaddress').val()+"est déjà utilisée dans une autre location");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{
                                    console.log(result);

                                }
                            }
                        });
                    } else {
                        id=$('#locationId').val();
                        $.ajax({
                            url: "{{ url('/Locations/')}}/"+id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                id: id,
                                Designation: $('#designation').val(),
                                Zone: $('#zone').val(),
                                IPAddress: $('#ipaddress').val(),
                            },
                            success: function (result) {
                                console.log(result);
                                $('#location'+id).html(
                                    '<h5 class="card-title text-center "><b><span id="location'+result.location.id+'Designation">'+result.location.Designation+'</span></b></h5>\n' +
                                    '                                        <hr>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-desktop text-warning"></i>&nbsp;&nbsp;Adresse IP : <span id="location'+result.location.id+'AdresseIp">'+result.location.AdresseIp+'</span> </b></p>\n' +
                                    '                                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;Zone : <span id="location'+result.location.id+'Zone">'+result.location.Zone+'</span></b></p>\n' +
                                    '                                        <div class="text-center">\n' +
                                    '                                        <button type="button" id="Edit'+result.location.id+'Location" class="EditLocation btn btn-primary" style="width:35px; height:35px; padding:0;"  ><i class="fa fa-edit"></i></button>\n' +
                                    '                                        <button type="button" id="Supprimer'+result.location.id+'Location" style="width:35px; height:35px; padding:0;" class="SupprimerLocation btn btn-danger"><i class="fa fa-trash"></i></button>\n' );
                                $('#LocationsForm').trigger('reset');
                                $('#AnnulerLocation').hide();
                                $('#AjouterLocation').html('<i class="fa fa-plus"></i>');
                                addLocationsListeners();
                            },
                            error: function (result) {

                                if(typeof result.responseJSON.message !='undefined'){
                                    if(result.responseJSON.message.includes('Unique violation')){
                                        alert("L'adresse IP : "+$('#ipaddress').val()+" est déjà utilisée dans une autre location");
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }
                                }else{ console.log(result);

                                }
                            }
                        });


                    }
                    } else{
                    alert("L'adresse IP : "+$('#ipaddress').val()+" n'est pas valide");
                }
                    }else{
                        alert('Remplire tous les champs svp!');
                    }
            });
            function addLocationsListeners(){
                $('.SupprimerLocation').each(function(e){
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
                            url:  "{{url('/Locations/')}}/"+id,
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
                $('.EditLocation').each(function(e){
                    $(this).off('click');$(this).click(function(e){
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        card= $(this).parent().parent();
                        $('#locationId').val(id);
                        $('#designation').val(card.find('#location'+id+'Designation').html());
                        $('#zone').val(card.find('#location'+id+'Zone').html());
                        $('#ipaddress').val(card.find('#location'+id+'AdresseIp').html());
                        $('#AnnulerLocation').show();
                        $('#AjouterLocation').html('<i class="fa fa-check"></i>');
                    });
                });
            }
            $('#AnnulerLocation').click(function(e){
                e.preventDefault();
                $('#LocationsForm').trigger('reset');
                $(this).hide();
                $('#AjouterLocation').html('<i class="fa fa-plus"></i>');
            });
        });
    </script>
    <script>
            $(document).ready(function(){
                $('#AnnulerAgent').hide();
                addAgentsListeners();


                $('#AjouterAgent').click(function(e){

                    if($('#AgentsForm')[0].checkValidity()) {
                        e.preventDefault();
                        if ($('#AjouterAgent').html() === '<i class="fa fa-plus"></i>') {

                            $.ajax({
                                url: "{{ route('agents.store')}}",
                                method: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    NomPrenom: $('#nomPrenom').val(),
                                    Code: $('#code').val(),

                                },
                                success: function (result) {
                                    $('#agents').append(' <tr id="Agent'+result.agent.id+'">\n' +
                                        '                                            <td id="agent'+result.agent.id+'nomPrenom">'+result.agent.NomPrenom+'</td>\n' +
                                        '                                            <td id="agent'+result.agent.id+'Code">'+result.agent.Code+'</td>\n' +
                                        '                                            <td  >\n' +
                                        '                                                <button id="Agent'+result.agent.id+'Edit" class="AgentEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                                                <button id="Agent'+result.agent.id+'Delete" class="AgentDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                        '\n' +
                                        '                                            </td>\n' +
                                        '                                        </tr>');
                                    addAgentsListeners();
                                },
                                error: function (result) {
                                    if(typeof result.responseJSON.message !='undefined'){
                                        if(result.responseJSON.message.includes('Unique violation')){
                                            alert("Le nom et prenoms ou le code sont déjà utilisés par un autre agent");
                                        }else{
                                            alert(result.responseJSON.message);console.log(result);
                                        }
                                    }else{
                                        alert(result.responseJSON.message);console.log(result);
                                    }

                                }
                            });
                        } else {
                            id=$('#AgentId').val();
                            $.ajax({
                                url: "{{ url('/agents/')}}/"+id,
                                method: 'post',
                                data: {
                                    _method: 'put',
                                    _token: '{{csrf_token()}}',
                                    id: id,
                                    NomPrenom: $('#nomPrenom').val(),
                                    Code: $('#code').val(),
                                },
                                success: function (result) {
                                    $('#agents').find("#Agent"+id).replaceWith(' <tr id="Agent'+result.agent.id+'">\n' +
                                        '                                            <td id="agent'+result.agent.id+'nomPrenom">'+result.agent.NomPrenom+'</td>\n' +
                                        '                                            <td id="agent'+result.agent.id+'Code">'+result.agent.Code+'</td>\n' +
                                        '                                            <td  >\n' +
                                        '                                                <button id="Agent'+result.agent.id+'Edit" class="AgentEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                        '                                                <button id="Agent'+result.agent.id+'Delete" class="AgentDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                        '\n' +
                                        '                                            </td>\n' +
                                        '                                        </tr>');
                                    $('#AgentsForm').trigger('reset');
                                    $('#AnnulerAgent').hide();
                                    $('#AjouterAgent').html('<i class="fa fa-plus"></i>');
                                    addAgentsListeners();
                                },
                                error: function (result) {
                                    if(typeof result.responseJSON.message !='undefined'){
                                        if(result.responseJSON.message.includes('Unique violation')){
                                            alert("Le nom et prenoms ou le code sont déjà utilisés par un autre agent");
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
                function addAgentsListeners(){
                    $('.AgentDelete').each(function(e){
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
                                url:  "{{url('/agents/')}}/"+id,
                                method: 'post',
                                data: {
                                    _method :'delete',
                                    _token :'{{csrf_token()}}',
                                    id :id,


                                },
                                success: function(result){
                                    tr.remove();
                                },
                                error: function(result){
                                    alert(result.responseJSON.message);console.log(result)
                                }
                            });
                        });
                    });
                    $('.AgentEdit').each(function(e){
                        $(this).off('click');$(this).click(function(e){
                            const id=$(this).attr("id").replace(/[^0-9]/g,'');
                            tr= $(this).parent().parent();
                            $('#AgentId').val(id);
                            $('#nomPrenom').val(tr.find('#agent'+id+'nomPrenom').html());
                            $('#code').val(tr.find('#agent'+id+'Code').html());
                            $('#AnnulerAgent').show();
                            $('#AjouterAgent').html('<i class="fa fa-check"></i>');
                        });
                    });
                }
                $('#AnnulerAgent').click(function(e){
                    e.preventDefault();
                    $('#AgentsForm').trigger('reset');
                    $(this).hide();
                    $('#AjouterAgent').html('<i class="fa fa-plus"></i>');
                });
            });
        </script>
    <script>
    $(document).ready(function(){
        $('#AnnulerMachine').hide();
        addMachinesListeners();
        $('#AjouterMachine').click(function(e){

            if($('#MachinesForm')[0].checkValidity()) {
                e.preventDefault();
                if ($('#AjouterMachine').html() === '<i class="fa fa-plus"></i>') {

                    $.ajax({
                        url: "{{ route('machines.store')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            Machine: $('#machine').val(),
                            Zone: $('#zoneMachine').val(),
                            Description: $('#Description').val(),

                        },
                        success: function (result) {
                            $('#machines').append(' <tr id="Machine'+result.machine.id+'">\n' +
                                '                                            <td id="machine'+result.machine.id+'Machine">'+result.machine.Machine+'</td>\n' +
                                '                                            <td id="machine'+result.machine.id+'Zone">'+result.machine.Zone+'</td>\n' +
                                '<td id="machine'+result.machine.id+'Description">'+result.machine.Description+'</td>\n' +
                                '                                            <td  >' +
                                '                                                <button id="machine'+result.machine.id+'Edit" class="machineEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                '                                                <button id="machine'+result.machine.id+'Delete" class="machineDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                '\n' +
                                '                                            </td>\n' +
                                '                                        </tr>');
                            addMachinesListeners();
                        },
                        error: function (result) {
                            if(typeof result.responseJSON.message !='undefined'){
                                if(result.responseJSON.message.includes('Unique violation')){
                                    alert("La machine "+$('#machine').val()+" Exist déjà dans la zone "+$('#zoneMachine').val());
                                }else{
                                    alert(result.responseJSON.message);console.log(result);
                                }
                            }else{
                                alert(result.responseJSON.message);console.log(result);
                            }

                        }
                    });
                } else {
                    id=$('#MachineId').val();
                    $.ajax({
                        url: "{{ url('/machines/')}}/"+id,
                        method: 'post',
                        data: {
                            _method: 'put',
                            _token: '{{csrf_token()}}',
                            id: id,
                            Machine: $('#machine').val(),
                            Zone: $('#zoneMachine').val(),
                            Description: $('#Description').val(),
                        },
                        success: function (result) {
                            $('#machines').find("#Machine"+id).replaceWith(' <tr id="Machine'+result.machine.id+'">\n' +
                                '                                            <td id="machine'+result.machine.id+'Machine">'+result.machine.Machine+'</td>\n' +
                                '                                            <td id="machine'+result.machine.id+'Zone">'+result.machine.Zone+'</td>\n' +
                                '                                            <td id="machine'+result.machine.id+'Description">'+result.machine.Description+'</td>\n' +
                                '                                            <td  >\n' +
                                '                                                <button id="machine'+result.machine.id+'Edit" class="machineEdit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                '                                                <button id="machine'+result.machine.id+'Delete" class="machineDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                '\n' +
                                '                                            </td>\n' +
                                '                                        </tr>');
                            $('#MachinesForm').trigger('reset');
                            $('#AnnulerMachine').hide();
                            $('#AjouterMachine').html('<i class="fa fa-plus"></i>');
                            addMachinesListeners();
                        },
                        error: function (result) {
                            if(typeof result.responseJSON.message !='undefined'){
                                if(result.responseJSON.message.includes('Unique violation')){
                                    alert("La machine "+$('#machine').val()+" Exist déjà dans la zone "+$('#zoneMachine').val());
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
        function addMachinesListeners(){
            $('.machineDelete').each(function(e){
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
                        url:  "{{url('/machines/')}}/"+id,
                        method: 'post',
                        data: {
                            _method :'delete',
                            _token :'{{csrf_token()}}',
                            id :id,


                        },
                        success: function(result){
                            tr.remove();
                        },
                        error: function(result){
                            alert(result.responseJSON.message);console.log(result)
                        }
                    });
                });
            });
            $('.machineEdit').each(function(e){
                $(this).off('click');$(this).click(function(e){
                    const id=$(this).attr("id").replace(/[^0-9]/g,'');
                    tr= $(this).parent().parent();
                    $('#MachineId').val(id);
                    $('#machine').val(tr.find('#machine'+id+'Machine').html());
                    $('#zoneMachine').val(tr.find('#machine'+id+'Zone').html());
                    $('#Description').val(tr.find('#machine'+id+'Description').html());
                    $('#AnnulerMachine').show();
                    $('#AjouterMachine').html('<i class="fa fa-check"></i>');
                });
            });
        }
        $('#AnnulerMachine').click(function(e){
            e.preventDefault();
            $('#MachinesForm').trigger('reset');
            $(this).hide();
            $('#AjouterMachine').html('<i class="fa fa-plus"></i>');
        });
    });
</script>
@endsection