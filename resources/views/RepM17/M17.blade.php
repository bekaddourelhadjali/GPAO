@extends('layouts.app')

@section('style')
    <style>
        @media (min-width: 576px){
            .modal-dialog {
                max-width: 1000px;
            }
        }
        .obsM,.obsS{
            width: 25% !important;
        }
        #rapportPage .valeur{
            font-weight: bolder;
            color:#000;
        }
        section.top-actions{


        }
        .actions .col-1{
            margin-right: 4px;

        }
        #arretForm button{
            margin-top: 0;
        }

        .rx1Edit,.rx1Delete{
            margin: 0;
        }
        .actions .btn{
            padding: 0;
            width:35px;
            font-size: 20px;
            font-weight: bolder;
        }
        button{
            margin: 10px 0;
        }
        span.valeur{
            color:red;
        }

        h5{
            color:#0e8ce4;
            text-align: center;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }

        .small-td{
          width:8%
        }
        .medium-td{
            width:12%
        }
         input[type=checkbox]{
            min-width: 18px;
             min-height: 18px;
            margin-top:  5px;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

         td,th{
               padding: 2px;
               vertical-align: middle !important;
               text-align: center;
           }
        .table {
            min-width: 800px;
            table-layout: auto;
            width: 100%;
            word-wrap: break-word;
            white-space: nowrap;
        }
        .table-container{
            overflow: auto;
        }
        .table td {
            overflow: hidden;
            word-break: break-all;
            white-space: normal;
            text-overflow: ellipsis;
            color : #000;
        }
        .large-td{
            width: 17%;
            vertical-align: super;
        }
        .form-group label{
            font-weight: bold;
        }

        table button
        ,table i.fa{
            font-size: 20px;
            border:none;
            background-color: rgba(0,0,0,0);
        }

        .form-control{
            padding: 0;
            text-align: center;
        }
        #du,#au{
            padding: .375rem .50rem;
        }
        input{
            padding:0;
        }
        span.valeur{
            color:red;
        }
        #operatuersTable td{
            text-align: left ;
        }

        .small-td input{
            width: 18px;
            height: 18px;
        }
        td{
            vertical-align: middle !important;
            text-align: center;
        }

        table button
        ,table i.fa{
            font-size: 20px;
            border:none;
            background-color: rgba(0,0,0,0);
        }


    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
@section('content')

 <div class="container-fluid">

     <section id="head-section">
         <div class="row">
             <div class="col-6 col-sm-4 col-lg-2">
                 <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                 <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
             </div>
             <div class="col-6 col-sm-2  col-lg-2">
                 <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span> </div>
                 <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
             </div>
             <div class="col-6 col-sm-6  col-lg-3">
                 <div class="row">Agent1: &nbsp; <span class="valeur"> {{$rapport->NomAgents}} / {{$rapport->CodeAgent}}</span></div>
                 <div class="row">Agent2: &nbsp; <span class="valeur">{{$rapport->NomAgents1}} / {{$rapport->CodeAgent1}}</span></div>
             </div>
             <div class="col-6 col-sm-6  col-lg-2">
                 <div class="row">TENSION: &nbsp; <span class="valeur"> {{$rapport->Tension}}  </span></div>
                 <div class="row">INTENSITE: &nbsp; <span class="valeur">{{$rapport->Intensite}}  </span></div>
             </div>
             <div class="col-6 col-sm-6  col-lg-3">
                 <div class="row">TEMPS DE POSE: &nbsp; <span class="valeur"> {{$rapport->TmpPose}}  </span></div>
                 <div class="row">DISTANCE DU BRAS: &nbsp; <span class="valeur">{{$rapport->DisBras}}  </span></div>
             </div>

         </div>
     </section>
     <div class="row">
         <div class="col-xl-5 col-lg-6 col-md-8 offset-md-2 offset-lg-0 col-sm-12 ">

             <section class="top-actions">
                 <h5>Info Tube</h5>
                 <form id="rx1Form">
                     <input name="Numero" type="hidden" id="Numero" value="">
                     <input name="NumRap" type="hidden" id="NumRap" value="{{$rapport->Numero}}">
                     <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                     <input type="hidden" id="machine" name="machine" value="{{$rapport->Machine}}">
                     <div class="row">
                         <div class=" col-lg-9 col-sm-12">
                             <div class="form-group ">
                                 <label class="col-lg-12"  style="padding-left: 0">Detail Projet</label>
                                 <select class="form-control col-12" id="detail_project" name="detail_project">
                                     @foreach($details as $detail)
                                         <option value="{{$detail->Did}}">Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class=" col-lg-2 col-sm-4 col-4">
                             <div class="form-group ">
                                 <label class="col-12" for="ntube" style="padding-left: 0">N°Tube</label>
                                 <input class=" col-12 form-control" pattern="[A-Z]\d{4}" type="text" id="ntube" pattern="[A-Z]\d{4}" name="ntube"  value=""   maxlength="5" minlength="5"   required>
                             </div>
                         </div>
                         <div class=" col-1">
                             <div class="form-group ">
                                 <label class="col-12" for="bis" style="padding-left: 0">Bis</label>
                                 <input class=" col-12" type="checkbox" id="bis" name="bis"         >
                             </div>
                         </div>
                         <div class="form-group col-2 ">
                             <label for="" class="col-12"></label>
                         <button type="reset" class="  btn btn-secondary" type="button" id="annulerButton" >Annuler</button>
                         </div>
                         <div class="form-group col-4  " >
                             <label for=""   class="col-12"></label>
                             <button type="submit" class="    btn btn-success" type="button" id="Ajouter" >Ajouter</button>
                         </div>
                     </div>

                 <br>
                 <div class="row ">

                      </div>
                 </form>
             </section>
         </div>

         <div class="col-xl-7 col-lg-6 col-sm-12">
             <section class="top-actions">
                 <h5>Désignation des anomalies</h5>
                 <form  id="Form">
                     <div class="row">
                         <div class=" col-sm-2">
                             <div class="form-group ">
                                 <label class="col-12" for="nbr">Nbr</label>
                                 <input class="  form-control" type="number"  id="nbr" name="nbr"     >
                             </div>
                         </div>
                         <div class="   col-sm-4">
                             <div class="form-group ">
                                 <label class="col-12" for="defaut">Defaut</label>
                                 <select class="form-control" id="defaut" name="defaut"    >
                                 <option hidden disabled selected value> </option>
                                 @if(isset($defauts ))
                                 @foreach($defauts as $defaut )
                                 <option defautId="{{$defaut->id}}" value="{{$defaut->Defaut}}" class="my-select">{{$defaut->Defaut}}</option>
                                 @endforeach
                                 @endif
                                 </select>
                             </div>
                         </div>
                         <div class=" col-sm-2">
                             <div class="form-group ">
                                 <label class="col-12" for="valeur">Valeur</label>
                                 <input class=" form-control" type="number" id="valeur" name="valeur"       >
                             </div>
                         </div>
                         <div class=" col-sm-4">
                             <div class="form-group ">
                                 <label class="col-12" for="operation">Operation</label>
                                 <select class="form-control" id="operation" name="operation"   required>
                                 <option hidden disabled selected value> </option>
                                 @if(isset($operations))
                                 @foreach($operations as $operation)
                                 <option operationId="{{$operation->id}}"  value="{{$operation->Operation}}" class="my-select" >{{$operation->Operation}}</option>
                                 @endforeach
                                 @endif
                                 </select>
                         </div>

                     </div>

                     </div>
                     <div class="row actions">
                         <div class=" col-xl-4 col-lg-6  col-sm-5"  >
                             <div class=" form-group bg-danger text-white text-center" style="padding: 5px 0 ; "  >
                                 <label class="col-12  " for="defautRx">Defaut Signalé par RX </label>
                             <input  class=" "type="checkbox"  id="defautRx" name="defautRx"  >
                             </div>
                         </div >
                         <div class="col-xl-5 col-lg-6 col-sm-6 ">
                             <div class="form-group  ">
                                 <label class="col-12" for="observation">Observation</label>
                                 <input class=" form-control" type="text" id="observation" name="observation"       >
                             </div>
                         </div>
                     <div class="col-1">   <label class="col-12" for=""> </label><button id="addDefaut" class="btn btn-success"><b>+</b></button> </div>
                     <div class="col-1">   <label class="col-12" for=""> </label><button id="removeDefaut" class="btn btn-danger"><b>-</b></button> </div>
                     </div>
                     <div class="row">
                         <input type="text" id="defauts" class=" form-control col-12" readonly>

                     </div>
                 </form>

             </section>

         </div>
     </div>
     <section class="col-12">
         <div class="table-container">
         <table id="rx1sTable"  class="table table-striped table-hover table-bordered rapprods ">
             <thead class="bg-primary text-white">
             <tr>
                 <th>Tube</th>
                 <th>Bis</th>
                 <th>Defauts</th>
                 <th>Observation</th>

             </tr>
             </thead>
             <tbody id="rxs">
             @if(isset($rx1))
                 @foreach($rx1 as $item)
                     <tr id="rx{{$item->Id}}">
                         <td id="tube{{$item->Id}}">{{$item->Tube}}</td>
                         <td id="bis{{$item->Id}}">@if($item->Bis) <input type="checkbox" checked  onclick="return false;">
                             @elseif(!$item->Bis)<input type="checkbox"  onclick="return false;"> @endif</td>
                         <td   class="obsS" id="Defaut{{$item->Id}}">{{$item->Defauts}}</td>
                         <td   class="obsS" id="Observation{{$item->Id}}">{{$item->Observation}}</td>
                         <td>
                             <button id="rx{{$item->Id}}Edit" class="rx1Edit text-primary" ><i class="fa fa-edit"></i></button>
                             <button id="rx{{$item->Id}}Delete" class="rx1Delete text-danger" ><i class="fa fa-trash"></i></button>
                         </td>
                     </tr>
                 @endforeach
             @endif
             </tbody>
         </table>
         </div>
     </section>
     <section>
         <div class="row">
             <div class=" col-lg-3 col-md-6 col-sm-12">  <button  type="button" class="btn btn-outline-danger col-12"  data-toggle="modal" data-target="#staticBackdrop">
                     <b><i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i> &nbsp;&nbsp;Arrets Machine</b>
                 </button></div>
             <div class=" col-lg-3 col-md-6 col-sm-12">  <button   type="button" id="imprimer" class="btn btn-outline-primary col-12"   >
                     <b><i class="fa fa-print" style="font-size: 20px;"></i> &nbsp;&nbsp;Imprimer</b>
                 </button></div>
             <div class="  col-lg-3  col-md-6 col-sm-12">
                 <form method="post" action="{{route('rapports_RX1.destroy',["id"=>$rapport->Numero])}}">
                     @csrf
                     <input type="hidden" name="_method" value="delete">
                     <button class="btn btn-secondary col-12"><b> <i class="fa fa-times-circle" style="font-size: 20px;"></i> &nbsp;&nbsp;Quitter le rapport</b></button>
                 </form>
             </div>
             <div class=" col-lg-3 col-md-6 col-sm-12"><button id="cloturer" class="btn btn-success col-12">
                     <b> <i class="fa fa-check-circle" style="font-size: 20px;"></i> &nbsp;&nbsp; Clôturer Rapport</b></button></div>
         </div>
     </section>
 </div>
 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog  " role="document" id="BobineModal">
         <section>
         <div class="modal-content">
             <div class="modal-header"  >
                 <h5 class="modal-title" id="staticBackdropLabel" >Arrets Machine</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" > <button data-dismiss="modal" onclick="$('#arretForm').trigger('reset')" class="btn btn-danger"><b>X</b></button></span>
                 </button>
             </div>
             <div class="modal-body">
                     <form id="arretForm">
                         <input name="idArret" type="hidden" id="idArret" value="">
                         <input type="hidden" name="Pid" id="Pid" value="{{$rapport->Pid}}">
                         <input type="hidden" name="Did" id="Did" value="{{$rapport->Did}}">
                         <input type="hidden" name="NumRap" id="NumRap" value="{{$rapport->Numero}}">
                         <input type="hidden" name="Machine" id="Machine" value="{{$rapport->Machine}}">
                         <div class="row">
                             <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                                 <div class="form-group row">
                                     <label class="col-12" for="type_arret">Type Arret</label>
                                     <select class="form-control col-10" id="type_arret" name="type_arret">
                                         <option value="panne" >Panne</option>
                                         <option value="arret"  selected >Arret</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                 <div class="row">
                                     <div class="col-6">
                                         <div class="form-group  ">
                                             <label class="col-12" for="du" >Du</label>
                                             <input class="col-12 form-control" type="time" id="du" name="du"   value="00:00"   required >
                                         </div></div>
                                     <div class="col-6">
                                         <div class="form-group  ">
                                             <label class="col-12" for="au">Au</label>
                                             <input class="col-12 form-control" type="time" id="au" name="au"      value="00:00"    required>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-1 col-lg-1 col-md-2 col-sm-4">
                                 <div class="form-group row">
                                     <label class="col-12" for="duree">Durée(m)</label>
                                     <input class="col-12 form-control" type="number" id="duree" name="duree"  value=""      required>
                                 </div>
                             </div>
                             <div class="col-xl-6 col-lg-6 col-md-12 col-sm-8">
                                 <div class="form-group row">
                                     <label class="col-11 offset-1" for="cause">Cause</label>
                                     <input class="col-11 offset-1 form-control" type="text" id="cause" name="cause"  value=""  required>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                                 <div class="form-group row">
                                     <label class="col-12" for="ndi">N°DI</label>
                                     <input class="col-10 form-control" type="text" id="ndi" name="ndi"   value="" >
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8">
                                 <div class="form-group row">
                                     <label class="col-12" for="obs">Obs</label>
                                     <input class="col-11 form-control" type="text" id="obs" name="obs" value=""   >
                                 </div>
                             </div>
                             <div class="col-xl-2 col-lg-2 col-md-4 col-sm-3">
                                 <div class="form-group row">
                                     <label class="col-12" for="relv">Relv_Compt</label>
                                     <input class="col-12 form-control" type="text" id="relv" name="relv"   value="" >
                                 </div>
                             </div>
                             <div class="col-xl-1 col-lg-1 col-md-2 col-sm-3 " id="annulerButton">
                                 <div class="col-10">
                                     <label class="col-10"  > &nbsp;</label>
                                     <button type="reset" id="annulerPanne"   class="btn btn-secondary" > Annuler  </button></div>
                             </div>
                             <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6"  >
                                 <div class="col-10"> <label class="col-12"  > &nbsp;</label>
                                 </div> <button class="col-10 btn btn-success offset-2" type="button" type="submit" id="ajouterPanne"  > Ajouter panne </button></div>
                         </div>



                     </form>
                     <hr>
                    <div class="table-container">
                     <table class="table table-striped table-hover table-bordered" id="ArretTable">
                         <thead class="bg-primary text-white">
                         <tr>
                             <th>Type Arret</th>
                             <th>Du</th>
                             <th>Au</th>
                             <th>Duree</th>
                             <th>Cause</th>
                             <th>N°DI</th>
                             <th>Obs</th>
                             <th>Relv_Compt</th>

                         </tr>
                         </thead>
                         <tbody>
                         @if(isset($arrets))
                             @foreach($arrets as $arret)
                                 <tr id="arret{{$arret->id}}">
                                     <td id="type{{$arret->id}}">{{$arret->TypeArret}}</td>
                                     <td id="du{{$arret->id}}">{{$arret->Du}}</td>
                                     <td id="au{{$arret->id}}">{{$arret->Au}}</td>
                                     <td id="duree{{$arret->id}}">{{$arret->Durée}}</td>
                                     <td id="cause{{$arret->id}}">{{$arret->Cause}}</td>
                                     <td id="ndi{{$arret->id}}"> {{$arret->NDI}}</td>
                                     <td id="obs{{$arret->id}}">{{$arret->Obs}}</td>
                                     <td id="relv{{$arret->id}}">{{$arret->Relv_Compt}}</td>
                                     <td class="actions">
                                         <button id="arret{{$arret->id}}Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>
                                         <button id="arret{{$arret->id}}Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td></td>
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
 </div>


    @endsection
@section('script')

    <script>

        $(document).ready(function(){
            rxdef=0;
            Defauts=[];
            $('#annulerButton').hide();
            $('#annulerPanne').hide();
            addRapprodsListeners();

            $('#addDefaut').click(function(e){
                e.preventDefault();
                if($('#defaut').val()!==null && $('#operation').val()!==null) {
                    if($('#operation').val()!=='R.A.S') {
                        Opr = $('#operation').val();
                        IdDef = $('#defaut').find("option:selected").attr("defautId");
                        if( $('#defautRx:checked').length > 0){
                            ++rxdef;
                        Defaut = 'U'+rxdef+'. '+$('#defaut').val();}
                        else     {Defaut = $('#defaut').val();}

                        Valeur = $('#valeur').val();
                        NbOpr = $('#operation').find("option:selected").attr("operationId");
                        Nombre = $('#nbr').val();
                        if (Valeur === '' || Valeur === 0) {
                            Valeur = null;
                        }
                        if (Nombre === '' || Nombre === 0) {
                            Nombre = null;
                        }
                        Defauts.push([Opr, IdDef, Defaut, Valeur, NbOpr, Nombre]);
                        SetDefauts();
                    }else{
                        alert('Sélectionner une opération autre que R.A.S');
                    }
                }else{
                    alert('Sélectionner un defaut et une opération svp!');
                }
            });

            $('#removeDefaut').click(function(e){
                e.preventDefault();
                latDefaut=Defauts.pop(); 
                if(latDefaut[2].includes('. '))
                    --rxdef;
                if(Defauts.length>0){
                    SetDefauts();
                }else{
                    $('#defauts').val('');
                }
            });
            $('#Ajouter').click(function(e){
                e.preventDefault();
                if($('#rx1Form')[0].checkValidity()){



                    const id = $('#Numero').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    ntube=$('#ntube').val().replace(/[^0-9]/g,'');
                    machine=$('#ntube').val().replace(ntube,'');
                    if(Defauts.length>0 || $('#operation').val()==='R.A.S' ) {
                        if (Defauts.length > 0) {

                            obs = $('#defauts').val() + '|' + Defauts[Defauts.length - 1][0] + '|';
                        } else if ($('#operation').val() === 'R.A.S') {
                            obs = $('#operation').val();
                            Defauts.push([
                                Opr = $('#operation').val(), null, null, null, $('#operation').find("option:selected").attr("operationId"), null]);
                        }
                    }else{
                        alert("Choisir soit l'opération R.A.S ou signaler un défaut et choisir une opération correspendante");
                    }
                    if ($('#Ajouter').html() !== ' Modifier ') {

                       $.ajax({
                           url: "{{ route('RX1.store')}}",
                           method: 'post',
                           data: {
                               _token: '{{csrf_token()}}',
                               machine: machine,
                               Pid: $('#Pid').val(),
                               Did: $('#detail_project').val(),
                               NumeroRap: $('#NumRap').val(),
                               ntube: ntube,
                               Tube: $('#ntube').val(),
                               bis: $('#bis:checked').length > 0,
                               Obs: obs,
                               Observation: $('#observation').val(),
                               Defauts: Defauts,
                           },
                           success: function (result) {
                               var bis = "";
                               var item=result.rx1;
                               if (item.Bis) {
                                   bis = "checked"
                               }
                               $('#rxs').append('<tr id="rx'+item.Id+'">\n' +
                                   '                         <td id="tube'+item.Id+'">'+item.Tube+'</td>\n' +
                                   '                         <td id="bis'+item.Id+'"> <input type="checkbox" '+bis+'  onclick="return false;">\n'+
                                   '                         <td   class="obsS" id="Defaut'+item.Id+'">'+item.Defauts+'</td>\n' +
                                   '                         <td   class="obsS" id="Observation'+item.Id+'">'+$('#observation').val()+'</td>\n' +
                                   '                         <td>\n' +
                                   '                             <button id="rx'+item.Id+'Edit" class="rx1Edit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                   '                             <button id="rx'+item.Id+'Delete" class="rx1Delete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                   '                         </td>\n' +
                                   '                     </tr> ');
                               $('#rx1Form').trigger("reset");
                               $('#Form').trigger("reset");
                               $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                               $('#Defauts').val('');  
                               Defauts = [];

                               addRapprodsListeners();
                           },
                           error: function (result) {
                               alert(result.responseJSON.message);
                               console.log(result);
                           }
                       });

                    } else {

                        $.ajax({
                            url:  "{{url('/RX1/')}}/"+id,
                            method: 'post',
                            data: {
                                _method: 'put',
                                _token: '{{csrf_token()}}',
                                machine: machine,
                                Pid: $('#Pid').val(),
                                Did: $('#detail_project').val(),
                                NumeroRap: $('#NumRap').val(),
                                ntube: ntube,
                                Tube: $('#ntube').val(),
                                bis: $('#bis:checked').length > 0,
                                Obs: obs,
                                Observation: $('#observation').val(),
                                Defauts: Defauts,
                                id:id
                            },
                            success: function (result) {
                                console.log(result.rx1);
                                var bis = "";
                                var item=result.rx1;
                                if (item.Bis) {
                                    bis = "checked"
                                }
                                $('#rx'+id).replaceWith('<tr id="rx'+item.Id+'">\n' +
                                    '                         <td id="tube'+item.Id+'">'+item.Tube+'</td>\n' +
                                    '                         <td id="bis'+item.Id+'"> <input type="checkbox" '+bis+'  onclick="return false;">\n'+
                                    '                         <td   class="obsS" id="Defaut'+item.Id+'">'+item.Defauts+'</td>\n' +
                                    '                         <td   class="obsS" id="Observation'+item.Id+'">'+$('#observation').val()+'</td>\n' +
                                    '                         <td>\n' +
                                    '                             <button id="rx'+item.Id+'Edit" class="rx1Edit text-primary" ><i class="fa fa-edit"></i></button>\n' +
                                    '                             <button id="rx'+item.Id+'Delete" class="rx1Delete text-danger" ><i class="fa fa-trash"></i></button></td></td>\n' +
                                    '                         </td>\n' +
                                    '                     </tr> ');
                                $('#rx1Form').trigger("reset");
                                $('#Ajouter').html(' Ajouter ');
                                $('#annulerButton').hide();
                                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                                $('#defauts').val('');
                                $('#ntube').prop('disabled', false);
                                Defauts=[];

                                addRapprodsListeners();
                                $('#ntube').prop('disabled', false);
                            },
                            error: function (result) {
                                alert(result.responseJSON.message);console.log(result);
                                
                            }
                        });

                    }
                }else{
                    alert("Remplir tous les champs qui sont obligatoires svp !");
                }
            });
            $('#annulerButton').click(function () {
                $('#rx1Form').trigger("reset");
                $('#Ajouter').html(' Ajouter ');
                $('#annulerButton').hide();
                $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                $('#defauts').val('');
                $('#ntube').prop('disabled', false);
                Defauts=[];
            });
            function addRapprodsListeners(){

                $('#ntube').removeAttr("readonly");
                $('.rx1Delete').each(function(e){
                    $(this).click(function(e){
                        tr= $(this).parent().parent();
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url:  "{{url('/RX1/')}}/"+id,
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
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                    });

                    $('#rx1Form').trigger("reset");
                    $('#Ajouter').html(' Ajouter ');
                    $('#annulerButton').hide();
                    $('#bis').replaceWith('<input class=" " type="checkbox" id="bis" name="bis"    >');
                    $('#defauts').val('');
                    $('#ntube').prop('disabled', false);
                    Defauts=[];
                });
                $('.rx1Edit').each(function(e){
                    $(this).click(function(e){
                        tr= $(this).parent().parent();
                        const id=$(this).attr("id").replace(/[^0-9]/g,'');
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url:  "{{url('/RX1/')}}/"+id+ '/edit',
                            method: 'get',
                            data: {
                                id :id,


                            },
                            success: function(result){
                                $('#Numero').val(id);
                                rxdef=0;
                                rx1=result.rx1;
                                $('#detail_project').val(rx1.Did);
                                $('#ntube').val(rx1.Tube);
                                Defauts=[];
                                rx1.defs.forEach(function(item,index){
                                    if(item.Defaut.includes('. ')) ++rxdef;
                                    Defauts.push([item.Opr, item.IdDef, item.Defaut, item.Valeur, item.NbOpr, item.Nombre]);
                                });
                                if(rx1.Bis)
                                $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"   checked      >' );
                                else{
                                    $('#bis').replaceWith('<input class=" col-12" type="checkbox" id="bis" name="bis"          >' );
                                }
                               SetDefauts();
                                $('#operation').val(Defauts[Defauts.length-1][0]);
                                $('#Ajouter').html(' Modifier ');
                                $('#annulerButton').show();
                                $('#ntube').prop('disabled', true);

                            },
                            error: function(result){
                                console.log(result);
                                alert(result.responseJSON.message);
                            }
                        });
                });
                });
            }
            $('#cloturer').click(function(e){
                const Numero= $('#NumRap').val();
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:  "{{url('/cloturer')}}/"+Numero,
                    method: 'post',
                    data: {
                        _token :'{{csrf_token()}}'
                    },
                    success: function(result){
                        if(result.rapportState.Etat==='C'){
                            alert('Rapport n°= ' + result.rapportState.Numero + ' est Cloturé avec succès');
                            window.location.href='{{route("rapports_RX1.index")}}';

                        }


                    },
                    error: function(result){

                            alert(result.responseJSON.message);

                    }
                });
            });



            function SetDefauts(){
                $('#defauts').val('');
                Defauts.forEach(function(item,index){
                    if(typeof item[2] !=='undefined') {
                        obs = item[2];
                        if (item[5] > 0) {
                            obs = item[5] + ' ' + obs;
                        }
                        if (item[3] > 0) {
                            obs = obs + '(' + item[3] + ')';
                        }
                        if (Defauts.length > index + 1) {
                            NextOp = Defauts[index + 1][0];
                        } else {
                            NextOp = item[0];
                        }
                        if (NextOp === item[0]) {
                            $('#defauts').val($('#defauts').val() + '+' + obs);
                        } else {
                            $('#defauts').val($('#defauts').val() + '+' + obs + '|' + item[0] + '|');
                        }
                        ObsMetal = $('#defauts').val();
                        if (ObsMetal.charAt(0) === '+')
                            $('#defauts').val(ObsMetal.substr(1));
                    }
                });

            }
        });
        $('#imprimer').click(function(e){
            e.preventDefault();

            window.open('{{route("printRX1Rap",["id"=>$rapport->Numero])}}', '_blank');});

    </script>
    <script>
        $(document).ready(function(){

            addArretsListeners();
            $('#annulerPanne').click(function () {
            $('#ajouterPanne').html(' Ajouter ');
            $('#annulerPanne').hide();
            $('#rx1Form').trigger('reset');
        });
        function addArretsListeners(){
            $('.arretDelete').each(function(e){
                $(this).click(function(e){

                    tr= $(this).parent().parent();
                    const id=$(this).attr("id").replace(/[^0-9]/g,'');

                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:  "{{url('/arret_machine/')}}/"+id,
                        method: 'post',
                        data: {
                            _token :'{{csrf_token()}}',
                            id :id,
                            _method :'delete'

                        },
                        success: function(result){
                            tr.remove();
                        },
                        error: function(result){
                            alert(result.responseJSON.message);
                        }
                    });
                });
            });
            $('.arretEdit').each(function(e){
                $(this).click(function(e){
                    e.preventDefault();
                    tr= $(this).parent().parent();
                    const id=$(this).attr("id").replace(/[^0-9]/g,'');
                    $('#cause').val(tr.find('#cause'+id).html());
                    $('#du').val(tr.find('#du'+id).html());
                    $('#au').val(tr.find('#au'+id).html());
                    $('#duree').val(tr.find('#duree'+id).html());
                    $('#ndi').val(tr.find('#ndi'+id).html());
                    $('#obs').val(tr.find('#obs'+id).html());
                    $('#relv').val(tr.find('#relv'+id).html());
                    $('#idArret').val(id);

                    if($('#type'+id).html()==='panne'){
                        $('#type_arret').find('option[value=panne]').attr('selected','selected');
                        $('#type_arret').find('option[value=arret]').removeAttr('selected');

                    }else{
                        $('#type_arret').find('option[value=panne]').removeAttr('selected');
                        $('#type_arret').find('option[value=arret]').attr('selected','selected');
                    }
                    $('#ajouterPanne').html(' Modifier panne ');
                    $('#annulerPanne').show();

                });
            });
        }
        $('#ajouterPanne').click(function(e){
            if($('#arretForm')[0].checkValidity()) {
                const id = $('#idArret').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if ($('#ajouterPanne').html() !== ' Modifier panne ') {

                    $.ajax({
                        url: "{{ route('arret_machine.store')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            Machine: $('#Machine').val(),
                            Pid: $('#Pid').val(),
                            Did: $('#Did').val(),
                            NumRap: $('#NumRap').val(),
                            type_arret: $('#type_arret').val(),
                            du: $('#du').val(),
                            au: $('#au').val(),
                            duree: $('#duree').val(),
                            cause: $('#cause').val(),
                            ndi: $('#ndi').val(),
                            obs: $('#obs').val(),
                            relv: $('#relv').val(),
                        },
                        success: function (result) {


                            $('#ArretTable').append('<tr id="arret' + result.arret.id + '">' +
                                '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                '<td id="du'+ result.arret.id + '">' + result.arret.Du + '</td>' +
                                '<td id="au'+ result.arret.id + '">' + result.arret.Au + '</td>' +
                                '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt + '</td>' +
                                '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td></tr>');

                            addArretsListeners();
                        },
                        error: function (result) {
                            console.log(result.responseJSON);
                            alert(result.responseJSON.message);
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{url('/arret_machine/')}}/" + id,
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id,
                            _method: 'put',
                            Machine: $('#Machine').val(),
                            Pid: $('#Pid').val(),
                            Did: $('#Did').val(),
                            NumRap: $('#NumRap').val(),
                            type_arret: $('#type_arret').val(),
                            du: $('#du').val(),
                            au: $('#au').val(),
                            duree: $('#duree').val(),
                            cause: $('#cause').val(),
                            ndi: $('#ndi').val(),
                            obs: $('#obs').val(),
                            relv: $('#relv').val(),
                        },
                        success: function (result) {

                            $('#ArretTable').find('#arret' + result.arret.id).html(
                                '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt +'</td>' +
                                '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td>');
                            $('#ajouterPanne').html(' Ajouter panne ');
                            $('#annulerPanne').hide();
                            $('#arretForm').trigger("reset");
                            addArretsListeners();
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                        }
                    });


                }
            }else{
                alert('Remplir tous les champs qui sont obligatoires svp!');
            }
        });
        $("#au , #du").click(function(event){


            if ($("#du").val() != "" && $("#au").val() != "" ) {
                var du = parseTime($("#du").val())/60000;
                var au = parseTime($("#au").val())/60000;
                if(du>au){
                    au=au+(24*60);
                }
                $('#duree').val((au - du) );
            }
        });
        function parseTime(cTime)
        {
            if (cTime == '') return null;
            var d = new Date();
            var time = cTime.match(/(\d+)(:(\d\d))?\s*(p?)/);
            d.setHours( parseInt(time[1]) + ( ( parseInt(time[1]) < 12 && time[4] ) ? 12 : 0) );
            d.setMinutes( parseInt(time[3]) || 0 );
            d.setSeconds(0, 0);
            return d;
        }
        });
    </script>

    @endsection
