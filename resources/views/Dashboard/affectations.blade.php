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

            <a class="nav-item nav-link active " id="nav-affectations-tab" data-toggle="tab" href="#nav-affectations" role="tab" aria-controls="nav-affectations" aria-selected="true"><b>Affectations</b></a>
            <a class="nav-item nav-link  " id="nav-locations-tab"  href="{{route('Locations.index')}}"><b>Locations</b></a>
            <a class="nav-item nav-link " id="nav-agents-tab" href="{{route('agents.index')}}"><b>Agents </b></a>
            <a class="nav-item nav-link " href="{{route('Defauts.index')}}"><b>Defauts & Operations</b></a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-affectations" role="tabpanel" aria-labelledby="nav-affectations-tab">
            <div class="col-12">
                <section style="">
                    @if(isset($locations))

                        <div class="row">
                        @foreach($locations as $location)
                            <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card bg-gradient-light ">
                        <div class="card-body " id="locationAff{{$location->id}}">
                            <h5 class="card-title text-center text-primary"><b><span id="location{{$location->id}}Designation">{{$location->Designation}}</span></b></h5>
                            <hr>
                            <div class="row">
                                <div class=" col-sm-12   text-center"  >
                                    <div  >
                                        <p class="card-text"><b><i class="fa fa-desktop text-danger"></i>&nbsp;&nbsp;Adresse IP : <span class=" text-danger" id="location{{$location->id}}AdresseIp">{{$location->AdresseIp}}</span> </b></p>
                                        <p class="card-text"><b><i class="fa fa-map-marker-alt text-success"></i>&nbsp;&nbsp;&nbsp;Zone : <span  class=" text-success" id="location{{$location->id}}Zone">{{$location->Zone}}</span>  </b></p>
                                    </div>
                                </div>
                                <section class="col-12 small-section bg-white">
                                    <h6 class="text-center text-primary"><b><i class="fa fa-chalkboard-teacher"></i> &nbsp;&nbsp;Agents</b></h6>
                                    <form id="Location{{$location->AdresseIp}}AffForm" class="row form-inline">
                                        <input type="hidden" name="adresseIP" val="{{$location->AdresseIp}}">
                                        <div class="input-group mb-3 col-12">
                                            <select class="form-control col-12" name="agentSelect" id="agent{{$location->id}}Select"  >
                                                @if(isset($agents))
                                                    @foreach($agents as $agent)
                                                        <option value="{{$agent->id}}">{{$agent->NomPrenom}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button"  id="agentAff{{$location->AdresseIp}}Ajouter" class="agentAffAjouter btn btn-primary"  ><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-container-small">
                                         <table id="agents{{$location->AdresseIp}}Table" class="table ">
                                             <tbody>
                                            @foreach($location->agents() as $agent)
                                                        <tr id="agentAff{{$agent->id}}" locationId="{{$location->id}}"> <td>{{$agent->NomPrenom}}</td>
                                                            <td><button id="agentAff{{$agent->id}}Delete" class="agentAffDelete text-danger" ><i class="fa fa-trash"></i></button></td>
                                                        </tr>
                                            @endforeach
                                             </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                            </div>
                        @endforeach

                            </div>
                    @endif
                    <div class="justify-content-center row" style="margin-top: 20px">
                        @if(isset($locations))
                            {{ $locations->links() }}
                        @endif
                    </div>
                </section>
            </div>

        </div>


    </div>

</div>


@endsection
@section('script')


<script>
    $(document).ready(function(){
        addAgentAffListeners();
        $('.agentAffAjouter').each(function(){
            $(this).off('click');$(this).click(function(e){

                adresseIp=$(this).attr("id").replace('agentAff','').replace('Ajouter','');
                form=$(this).parent().parent().parent();
                card_body=form.parent().parent().parent();
                const locationId=card_body.attr("id").replace(/[^0-9]/g,'');
                tbody=form.next().find('tbody');
                e.preventDefault();
                $.ajax({
                    url: "{{ route('affectations.store')}}",
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        AdresseIp: adresseIp,
                        idAgent: $('#agent'+locationId+'Select').val(),
                        Zone: $('#location'+locationId+'Zone').html(),
                    },
                    success: function (result) {

                        tbody.append(' <tr id="agentAff'+result.agent.id+'" locationId="'+locationId+'"> <td>'+result.agent.NomPrenom+'</td>\n' +
                            '                                                        <td><button  id="agentAff'+result.agent.id+'Delete" class="agentAffDelete text-danger" ><i class="fa fa-trash"></i></button></td>\n' +
                            '                                                    </tr>');
                        addAgentAffListeners();
                    },
                    error: function (result) {
                        if(typeof result.responseJSON.message !='undefined'){
                            if(result.responseJSON.message.includes('Unique violation')){
                                alert("L'agent est déjà affecté à cette location");
                            }else{
                                alert(result.responseJSON.message);console.log(result);
                            }
                        }else{
                            console.log(result);

                        }

                    }
                });
            });
        });
        function addAgentAffListeners(){
        $('.agentAffDelete').each(function(){
        $(this).off('click');
            $(this).off('click');$(this).click(function(e){
                tr= $(this).parent().parent();
                locationId=tr.attr('locationId');
                const id=$(this).attr("id").replace(/[^0-9]/g,'');
                adresseIp=tr.parent().parent().attr("id").replace('agents','').replace('Table','');
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:  "{{url('/affectations/')}}/"+id,
                    method: 'post',
                    data: {
                        _method :'delete',
                        _token :'{{csrf_token()}}',
                        idAgent :id,
                        AdresseIp:adresseIp,
                        Zone: $('#location'+locationId+'Zone').html(),

                    },
                    success: function(result){
                        tr.remove();
                    },
                    error: function(result){
                        alert(result.responseJSON.message); console.log(result)
                    }
                });
            });
        });
        }
    });
</script>
@endsection