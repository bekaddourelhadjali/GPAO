@extends('layouts.app')

@section('style')
    <style>
        label{
            margin-bottom: 0;
            padding-top: 5px;
        }
        .row .col-3 {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .body-content{
            border-radius: 10px;
            padding:10px;
        }
        fieldset{
            padding: 20px;
        }
        fieldset fieldset  {
            padding: 10px;
            margin-top: 30px;
        }
        fieldset legend {
            color : #2e59d9;
            width: auto;
        }
        fieldset >.row {
        }
        .dernier-tube{
            background-color: #20c997;
            padding: 10px;
            border-radius: 10px;
        }
        span.valeur{
            color:red;
        }
    </style>

@endsection
@section('content')
    <div class="container">

        <section class="col-xl-8 col-lg-8 col-sm-12 col-md-12 offset-xl-2 offset-lg-2 ">
            <div class="row ">
                <div class="top-content col-12 offset-xl-2 offset-lg-2 offset-md-1 offset-">
                    <div class="row ">
                        <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                        <div class="col-10">
                            <h1>Project : {{$projet->Nom}}</h1>
                            <h5>Client:  {{$projet->client->name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-xl-8 col-lg-8 col-sm-12 col-md-12 offset-xl-2 offset-lg-2 ">
            <div class="body-content ">
                <form method="post" action="{{route('rapports.store')}}">
                    @csrf
                    <fieldset>
                        <legend><h3>Information du rapport</h3> </legend>
                        <div class="form-group  row">
                            <label class="col-3" for="detail_project ">Detail Projet</label>
                            <select class="form-control col-6" id="detail_project " name="detail_project">
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}">Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                @endforeach
                            </select>
                        </div>
                        <input name="Pid" type="hidden" id="Pid" value="{{$projet->Pid}}">
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-6" for="date" >Date de rapport</label>
                                    <input class="col-6 form-control"  name="date" id="date" type="text" value="{{date("Y-m-d") }}" >
                                </div>

                                <div class="form-group row">
                                    <label class="col-6" for="equipe ">Equipe</label>
                                    <select class="form-control col-4" id="equipe" name="equipe">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6" for="poste ">Poste</label>
                                    <select class="form-control col-4" id="poste" name="poste">
                                        @if(isset($postes))
                                        @foreach($postes as $poste)
                                            <option value="{{$poste->Poste}}">{{$poste->Poste}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-6" for="machine">Machine</label>
                                    <select class="form-control col-4" id="machine" name="machine">
                                        @if(isset($machines))
                                        @foreach($machines as $machine)
                                            <option value="{{$machine->Machine}}">{{$machine->Machine}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-1"></div>

                            <div class="col-4 dernier-tube">
                                <h6>Dernier tube : &nbsp; <span class="valeur"  id="dtTube"> </span></h6>
                                <h6>Observation : &nbsp;<span class="valeur" id="dtObservation"> </span> </h6>
                                <hr>
                                <h6>Rapp Nº: &nbsp; <span class="valeur" id="dtNumero"> </span> </h6>
                                <h6>Date:    &nbsp; <span class="valeur" id="dtDate"> </span></h6>
                                <h6>Equipe: &nbsp; <span class="valeur" id="dtEquipe"> </span></h6>
                                <h6>Poste:  &nbsp; <span class="valeur" id="dtPoste"></span></h6>
                            </div>

                        </div>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-3" for="agent">Nom de l'agent</label>
                                <select class="form-control col-6" id="agent" name="agent">
                                    @if(isset($operateurs))
                                    @foreach($operateurs as $operateur)
                                        <option value="{{$operateur->nom}}">{{$operateur->nom}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="button" class="col-4 btn btn-warning" data-toggle="modal" id=""  data-target="#exampleModal">
                                    Reprendre un rapport
                                </button>

                                <button id="" type="submit" class=" col-3 offset-4 btn btn-success"> Valider</button>
                            </div>

                        </fieldset>
                    </fieldset>
                </form>

            </div>
        </section>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reprendre un rapport</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row"></div>
                    <div class="form-group  form-inline">
                        <label class="col-2" for="tube" ><h5>Tube :</h5></label>
                        <input class="col-3 form-control"  name="tube" id="tube" type="text"  required >
                        <button type="button" id="reprendreButton" class="col-3 offset-1 btn btn-primary">Entrer</button>
                        <button type="button" class="col-2 offset-1 btn btn-outline-secondary" data-dismiss="modal">Annuler</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        getLatestTube( $('#machine').val());
        $('#machine').on('change',function(){
            getLatestTube($('#machine').val());
        });
        function getLatestTube(machine){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:  "{{url('/dernierTube/')}}/"+machine,
                method: 'get',
                data: {
                },
                success: function(result){
                    $('#dtTube').html(result.dernierTubetab.Tube);
                    $('#dtObservation').html(result.dernierTubetab.Observation);
                    $('#dtNumero').html(result.dernierTubetab.Numero);
                    $('#dtDate').html(result.dernierTubetab.Date);
                    $('#dtEquipe').html(result.dernierTubetab.Equipe);
                    $('#dtPoste').html(result.dernierTubetab.Poste);
                },
                error: function(result){
                    if(result.responseJSON.message.includes('Undefined offset: 0')){
                        $('#dtObservation').html('');
                        $('#dtTube').html('');
                        $('#dtNumero').html('');
                        $('#dtDate').html('');
                        $('#dtEquipe').html('');
                        $('#dtPoste').html('');
                    }else{
                        alert(result.responseJSON.message);
                    }
                }
            });

        }
        $('#reprendreButton').click(function(e){
            const tube= $('#tube').val();
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:  "{{url('/reprendreTube')}}/"+tube,
                method: 'get',
                data: {
                },
                success: function(result){
                    if(result.rapportState.Etat==='C'){
                        alert('Rapport n°= '+result.rapportState.Numero+' est Cloturé');

                    }else
                        if(result.rapportState.Etat==='N'){
                            window.location.href='{{url("/rapprod/")}}/'+result.rapportState.Numero;
                    }
                },
                error: function(result){
                    if(result.responseJSON.message.includes('Undefined offset: 0')){
                        alert("Tube n°= "+tube+" n'existe pas");
                    }else{
                        alert(result.responseJSON.message);
                    }
                }
            });
        });
    });
</script>

@endsection
