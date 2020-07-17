@extends('layouts.app')

@section('style')
    <style>
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
            margin:0;
        }
        @media (min-width: 576px){
            .modal-dialog {
                max-width:800px;
            }
        }
        .table {
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }

        .table td {
            overflow: hidden;
            word-break: break-all;
            white-space: normal;
            text-overflow: ellipsis;
            color : #000;
        }
        .table-container{
              overflow: auto;
          }
        .top-content img{
            height: 100px;
        }

        label{
            margin-bottom: 0;
            padding-top: 5px;
        }
        .row .col-3 {
            margin-bottom: 0;
            vertical-align: middle;

        }
        .table{
            color : #000;
        }
        .table {
            table-layout: auto;
            width: 100%;
        }
        .table td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        h4{
            text-align: center;
            color : #2e59d9;
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
            text-align: center;
        }
        fieldset >.row {
        }

        span{
            color:red;
        }
        @media only screen and (min-width:1366px) and (max-width:769px) {

           .top-content{
               margin-left:0;
           }

        }
    </style>

@endsection
@section('content')
    <div class="container-fluid">


        <div class="row">
            <div class="body-content col-xl-5 col-lg-6 col-md-8 offset-xl-0 offset-lg-0 offset-md-2 col-sm-12 " >
                <section class="col-12">
                <form method="post" action="{{route('rapports_visuels.store')}}">
                    @csrf
                    <fieldset>
                        <legend><h4>Information du rapport</h4> </legend>
                        <div class="form-group  row">
                            <label class="col-4" for="detail_project ">Detail Projet</label>
                            <select class="form-control col-xl-8 col-lg-12   col-md-8 col-sm-8" id="detail_project" name="detail_project">
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}">{{$detail->Nom}} -- Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-4" for="date" >Date du rapport</label>
                                    <input class="col-4 form-control"  name="date" id="date" type="date" value="{{date("Y-m-d") }}" >
                                </div>

                                <div class="form-group row">
                                    <label class="col-4" for="equipe ">Equipe</label>
                                    <select class="form-control col-4" id="equipe" name="equipe">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4" for="poste ">Poste</label>
                                    <select class="form-control col-4" id="poste" name="poste">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                    </select>
                                </div>
                            </div>



                        </div>

                            <div class="form-group row">
                                <label class="col-3" for="agent">Agent 01</label>
                                <select class="form-control col-6" id="agent" name="agent">
                                    @if(isset($agents))
                                        @php
                                            $i=0;
                                        @endphp
                                    @foreach($agents as $agent)
                                        <option order="{{$i++}}" value="{{$agent->NomPrenom}}">{{$agent->NomPrenom}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <input type="text" id="codeAgent" name="codeAgent" class="col-3 form-control" placeholder="Code" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-3" for="agent2">Agent 02</label>
                                <select class="form-control col-6" id="agent2" name="agent2">
                                    @if(isset($agents))
                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach($agents as $agent)
                                            <option order="{{$i++}}" value="{{$agent->NomPrenom}}">{{$agent->NomPrenom}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="text" id="codeAgent2" name="codeAgent2" class="col-3 form-control" placeholder="Code"  required>
                            </div>

                        <hr>
                        <div class="form-group row">
                            <button type="button" class="col-5  btn btn-warning" data-toggle="modal"    data-target="#exampleModal">
                                Reprendre un rapport
                            </button>

                            <button   type="submit" class=" col-4 offset-3 btn btn-success"> Valider</button>
                        </div>
                    </fieldset>

                </form>
                </section>
            </div>
        <div class=" col-xl-7 col-lg-6 col-md-12  col-sm-12">
           <section>
           <h4>
               Liste des derniers rapports
           </h4>
               <br>
               <div class="row">
                   <div class="  table-container ">
               <table class=" table table-striped table-hover table-bordered">
                   <thead class="bg-primary text-white">
                   <tr>
                       <th>Date</th>
                       <th>Poste</th>
                       <th>Agent 1</th>
                       <th>Agent 2</th>
                       <th>Clôturé</th>
                   </tr>
                   </thead>
                   <tbody>
                   @if(isset($rapports))
                       @foreach($rapports as $rapport)
                   <tr id="rapport{{$rapport->Numero}}" @if($rapport->Etat=='C')class="Clot bg-success text-white" @else class="NotClot " @endif >
                   <td>{{$rapport->DateRapport}}</td>
                   <td>{{$rapport->Poste}}</td>
                       <td>{{$rapport->NomAgents}} / {{$rapport->CodeAgent}}</td>
                       <td>{{$rapport->NomAgents1}} / {{$rapport->CodeAgent1}}</td>
                           @if($rapport->Etat=='C')<td>Oui</td>   @else <td>Non</td>  @endif
                   </tr>
                    @endforeach
                   @endif
                   </tbody>
               </table>
                   </div>
               </div>
           </section>
        </div>
        </div>

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
                    <table class=" col-12 table table-striped table-hover table-bordered">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th>Date</th>
                            <th>Poste</th>
                            <th>Agent 1</th>
                            <th>Agent 2</th>
                            <th>Clôturé</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyReprendre">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){

        $('#codeAgent').val($('#code').val());
        $('#codeAgent2').val($('#code2').val());
        AddListeners();
        $('#reprendreButton').click(function(e){
            const tube= $('#tube').val();
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:  "{{url('/rapports_visuels/')}}/" + tube + '/edit',
                method: 'get',
                success: function(result){
                    $('#tbodyReprendre').html('');
                    result.rapports.forEach(function(rapport,index){

                        if(rapport.Etat==='C'){
                            $('#tbodyReprendre').append('<tr id="rapport'+rapport.Numero+'" class="Clot bg-success text-white">' +
                            '                   <td>'+rapport.DateRapport+'</td>\n' +
                            '                   <td>'+rapport.Poste+'</td>\n' +
                            '                   <td>'+rapport.NomAgents+' / '+rapport.CodeAgent+'</td>\n' +
                            '                   <td>'+rapport.NomAgents1+' / '+rapport.CodeAgent1+'</td>\n' +
                            '                            <td>Oui</td>   ;');
                        }else{
                            $('#tbodyReprendre').append('<tr id="rapport'+rapport.Numero+'"  class="NotClot "> ' +
                                '                   <td>'+rapport.DateRapport+'</td>\n' +
                                '                   <td>'+rapport.Poste+'</td>\n' +
                                '                   <td>'+rapport.NomAgents+' / '+rapport.CodeAgent+'</td>\n' +
                                '                   <td>'+rapport.NomAgents1+' / '+rapport.CodeAgent1+'</td>\n' +
                            '                             <td>Non</td>   ;');
                        }

                    });
                    AddListeners();
                },
                error: function(result){
                    console.log(result);
                    if(typeof(result)!=='undefined' )
                    if(result.responseJSON.message.includes('Undefined offset: 0')){
                        alert("Tube n°= "+tube+" n'existe pas dans les rapports visuels");
                    }else{
                        alert("Tube n°= "+tube+" n'existe pas dans les rapports visuels");
                    }
                }
            });
        });
        function AddListeners(){
        $('.Clot').each(function(){

            id=$(this).attr('id').replace(/[^0-9]/g,'');
            $(this).dblclick(function(){
                alert('Rapport N°='+id+' est CLoturé');
            });
        });
        $('.NotClot').each(function(){
            $(this).dblclick(function(){
                id=$(this).attr('id').replace(/[^0-9]/g,'');
                window.location.href='{{url("/visuels/")}}/'+id;
            });
        });
        }
        $('#agent').on('change',function(){
            order=$(this).children("option:selected").attr('order');
            val=$('#code').find('option[order='+order+']').val();
            $('#code').val(val);
            $('#codeAgent').val(val);

        });
        $('#agent2').on('change',function(){
            order=$(this).children("option:selected").attr('order');
            val=$('#code2').find('option[order='+order+']').val();
            $('#code2').val(val);
            $('#codeAgent2').val(val);
        });

    });
</script>

@endsection
