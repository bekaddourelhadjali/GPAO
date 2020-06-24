@extends('layouts.app')
@section('style')
    <style type="text/css" href="{{asset('css/Rapport.css')}}"></style>
    <style>
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

        footer{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div id="rapportPage" class="container-fluid" style="margin-top: 50px;">
        <div class="row ">
            <img id="top-image" class="col-1"  src="{{asset('img/Login.png')}}"  height="100">
            <h4  class="col-2" style="margin-top: 20px; padding: 0;" > <b>ALFAPIPE TUS GHARDAIA</b></h4>
            <div class="col-7" >
                <h4 class="col-12" style="text-align:center"><b>RAPPORT DE CONTROLE VISUEL MACHINE</b></h4>
                <h4 style="text-align:center"><b>{{$projet->Nom}}</b></h4>
                <h5 class="col-12" style="text-align:center; color:#000;"> API 5LX70 Diam : {{$rapport->details->Diametre}}mm Epais: {{$rapport->details->Epaisseur}} mm </h5>
            </div>
            <div class="col-2  " style="border:2px solid #000; padding:10px;">
                <div class="row"> <div class="col-4" > Code:</div>     <div class="col-6" >  12.427</div></div>
                <div class="row"><div class="col-6" > Révision:</div>     <div class="col-6" > 00</div></div>
                <div class="row"><div class="col-4" > Date:</div>     <div class="col-6" > 24/04/2018</div></div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-2">
                <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
                <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
            </div>
            <div class="col-2">
                <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
                <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span> </div>

            </div>
            <div class="col-1"></div>
            <div class="col-4">
                <div class="row">
                    <div class="col-10">Agent1: &nbsp; <span class="valeur"> {{explode('/',$rapport->NomAgents)[0]}} </span></div>
                    <div class="col-2"> <span class="valeur"> {{explode('/',$rapport->CodeAgent)[0]}}</span></div>
                </div>
                <div class="row">
                    <div class="col-10">Agent2: &nbsp; <span class="valeur"> {{explode('/',$rapport->NomAgents)[1]}} </span></div>
                    <div class="col-2"> <span class="valeur"> {{explode('/',$rapport->CodeAgent)[1]}}</span></div>
                </div>
            </div>

        </div>
        <hr>
        <br>
        <h4  class="text-center">Liste des defauts</h4>
        <table id="visuelsTable"  class="table   rapprods " style="color:#000;" border="1">
            <thead class="thead-light" >
            <tr style="border-color:#000;">
                <th style="border-color:#000;">Tube</th>
                <th style="border-color:#000;">Bis</th>
                <th style="border-color:#000;">Longueur</th>
                <th style="border-color:#000;">DiamD</th>
                <th style="border-color:#000;">DiamF</th>
                <th style="border-color:#000;">Observation Sur Soudure</th>
                <th style="border-color:#000;">Observation Sur Metal</th>

            </tr>
            </thead>
            <tbody>
            @if(isset($visuels))
                @foreach($visuels as $visuel)
                    <tr id="visuel{{$visuel->Numero}}" style="border-color:#000;">
                        <td style="border-color:#000;" id="tube{{$visuel->Numero}}">{{$visuel->Tube}}</td>
                        <td style="border-color:#000;" id="bis{{$visuel->Numero}}">@if($visuel->Bis) <input type="checkbox" checked  onclick="return false;">
                            @elseif(!$visuel->Bis)<input type="checkbox"  onclick="return false;"> @endif</td>
                        <td style="border-color:#000;" id="longueur{{$visuel->Numero}}">{{$visuel->Longueur}}</td>
                        <td style="border-color:#000;" id="diam_d{{$visuel->Numero}}">{{$visuel->DiamD}}</td>
                        <td style="border-color:#000;" id="diam_f{{$visuel->Numero}}">{{$visuel->DiamF}}</td>
                        <td style="border-color:#000;" id="obsSoudure{{$visuel->Numero}}">{{$visuel->ObsSoudure}}</td>
                        <td style="border-color:#000;" id="obsMetal{{$visuel->Numero}}">{{$visuel->ObsMetal}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <hr>
        <br>
        <h4 class="text-center">Liste des arrêts machines</h4>
        <div class="table-container">
            <table class="table " id="ArretTable" style="color:#000;" border="1">
                <thead class="">
                <tr style="border-color:#000;">
                    <th style="border-color:#000;">Type Arret</th>
                    <th style="border-color:#000;">Du</th>
                    <th style="border-color:#000;">Au</th>
                    <th style="border-color:#000;">Duree</th>
                    <th style="border-color:#000;">Cause</th>
                    <th style="border-color:#000;">N°DI</th>
                    <th style="border-color:#000;">Obs</th>
                    <th style="border-color:#000;">Relv_Compt</th>

                </tr>
                </thead>
                <tbody>
                @if(isset($arrets))
                    @foreach($arrets as $arret)
                        <tr style="border-color:#000;" id="arret{{$arret->id}}">
                            <td style="border-color:#000;" id="type{{$arret->id}}">{{$arret->TypeArret}}</td>
                            <td style="border-color:#000;" id="du{{$arret->id}}">{{$arret->Du}}</td>
                            <td style="border-color:#000;" id="au{{$arret->id}}">{{$arret->Au}}</td>
                            <td style="border-color:#000;" id="duree{{$arret->id}}">{{$arret->Durée}}</td>
                            <td style="border-color:#000;" id="cause{{$arret->id}}">{{$arret->Cause}}</td>
                            <td style="border-color:#000;" id="ndi{{$arret->id}}"> {{$arret->NDI}}</td>
                            <td style="border-color:#000;" id="obs{{$arret->id}}">{{$arret->Obs}}</td>
                            <td style="border-color:#000;" id="relv{{$arret->id}}">{{$arret->Relv_Compt}}</td>
                             </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/printThis.js')}}"></script>
    <script>
     $(document).ready(function(){
         $('')
         $('#rapportPage').printThis({
             importCSS: true,
             loadCSS:'{{asset('css/Rapport.css')}}',
         });
     });



    </script>
@endsection
