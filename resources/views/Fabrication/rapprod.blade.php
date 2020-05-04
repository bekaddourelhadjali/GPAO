@extends('layouts.app')

@section('style')
    <style>

        button{
            margin: 10px 0;
        }
        span.valeur{
            color:red;
        }
         div.col-xl-3{
            text-align: center;
        }
        .small-td{
            padding-left:25px;

        }
        .small-td input{
            width: 18px;
            height: 18px;
            margin-top: -10px;
        }

         td{
                width: 20%;
                vertical-align: middle !important;
                text-align: center;

        }
        .table{
            color : #000;
        }

        .large-td{
            width: 40%;
            vertical-align: super;
        }
        .btn{
            width:100%;
        }
        .rapprods {
            table-layout: auto;
            width: 100%;
        }
        .rapprods td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        table button[type=submit]
        ,table i.fa{
            font-size: 20px;
            border:none;
            background-color: rgba(0,0,0,0);
        }
        #annuler{
            margin:10px 0;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
@section('content')
<div class="container">
    <section>
    <div class="row ">
        <div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">
            <div class="row ">
            <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
            <div class="col-10">
                <h1>Project : {{$projet->Nom}}</h1>
                <h5>Client: {{$projet->Customer}}</h5>
            </div>
            </div>
        </div>
    </div>
        <hr>
    <div class="row">
        <div class="col-sm-12 col-md-8 col-xl-4 col-lg-4">
            <div class="col-12">Information projet:</div>
            <div class="col-12"><span class="valeur">   <span class="valeur"> Epais: {{$rapport->details->Epaisseur}} mm -Diam : {{$rapport->details->Diametre}}mm</span></span></div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-3 col-lg-3">
            <div class="row">Nº Rapport: &nbsp; <span class="valeur">{{$rapport->Numero}}</span></div>
            <div class="row">Date: &nbsp; <span class="valeur">{{$rapport->DateRapport}} </span></div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-2 col-lg-2">
            <div class="row">Equipe: &nbsp; <span class="valeur"> {{$rapport->Equipe}}</span> </div>
            <div class="row">Poste: &nbsp; <span class="valeur"> {{$rapport->Poste}}</span></div>
        </div>
        <div class="col-sm-12 col-md-8 col-xl-3 col-lg-3">
            <div class="row">Agent: &nbsp; <span class="valeur"> {{$rapport->NomAgents}}</span></div>
            <div class="row">Machine: &nbsp; <span class="valeur">{{$rapport->Machine}}</span></div>
        </div>

    </div>
    </section>
    <section>
    <form method="post" @if(isset($selectedRapprod))action="{{route('rapprod.update',['id'=>$selectedRapprod->Numero])}}"
                            @else action="{{route('rapprod.store')}}"   @endif>
        @csrf()
        <div class="row">
            @if(isset($selectedRapprod)) <input type="hidden" name="_method" value="put"> @endif
                @if(isset($selectedRapprod)) <input name="Numero" type="hidden" id="Numero" value="{{$selectedRapprod->Numero}}">  @endif
            <input name="NumeroRap" type="hidden" id="NumeroRap" value="{{$rapport->Numero}}">
            <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
            <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
        <div class="col-xl-2 col-sm-6">
            <label class="form-label" for="bobine">Bobine</label>
            <select class="form-control" id="bobine" name="bobine" required>
                @foreach($bobines as $bobine)
                    <option value="{{$bobine->Bobine}}" @if(isset($selectedRapprod)&& $selectedRapprod->Bobine==$bobine->Bobine) selected @endif>{{$bobine->Bobine}}</option>
                @endforeach
            </select>
            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Ajouter Bobine
                </button>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6">
            <label class="form-label" for="coulee">Coulee</label>
            <select class="form-control" id="coulee" name="coulee" required>

                @foreach($bobines as $bobine)
                    <option value="{{$bobine->Coulee}}" @if(isset($selectedRapprod)&& $selectedRapprod->Coulee==$bobine->Coulee) selected @endif>{{$bobine->Coulee}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xl-1 col-sm-6"><label class="form-label" for="machine" >Machine</label>
            <input class="form-control" type="text" @if(isset($selectedRapprod) )) value="{{$selectedRapprod->Machine}}" @else value="{{$rapport->Machine}}" @endif  id="machine" name="machine" required></div>
        <div class="col-xl-1 col-sm-6"><label class="form-label" for="ntube">N°Tube</label>
            <input class="form-control" type="text" @if(isset($selectedRapprod) )) value="{{$selectedRapprod->Ntube}}" @else value="002" @endif id="ntube" name="ntube" required></div>
        <div class="col-xl-2 col-sm-6">
        <table  >
            <tr>
                <td > <label for="bis">Bis</label>

                </td>
                <td class="large-td"> <label for="longueur"> Longueur </label>

                </td>
                <td ><label for="rb">R B</label>

                </td>
            </tr>
            <tr>
                <td class="small-td"><input class="form-check-input"  type="checkbox"  id="bis" name="bis" @if(isset($selectedRapprod) && $selectedRapprod->Bis ) ) checked    @endif></td>
                <td class="large-td"><input class="form-control" type="text" @if(isset($selectedRapprod) )) value="{{$selectedRapprod->Longueur}}"  @endif id="longueur" required name="longueur"></td>
                <td class="small-td"><input class="form-check-input" type="checkbox"  id="rb" name="rb" @if(isset($selectedRapprod) && $selectedRapprod->RB ) ) checked  @endif></td>

            </tr>
        </table>


             </div>
        <div class="col-xl-1 col-sm-6"><label class="form-label" for="macrd">MACRD</label>
            <input class="form-control" type="text"  id="macrd" @if(isset($selectedRapprod) )) value="{{$selectedRapprod->Macrd}}"  @endif  name="macrd" required></div>
        <div class="col-xl-3 col-sm-6"><label class="form-label" for="agent">Observation</label>
            <table  >
                <tr>
                    <td >
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  id="sur_mas" name="sur_mas" @if(isset($selectedRapprod) && strpos($selectedRapprod->Observation, 'Sur Mas') !== false ))checked @endif >
                            <label class="form-check-label" for="sur_mas" >Sur Mas</label>
                        </div>
                    </td>
                    <td >
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="test_1" name="test_1" @if(isset($selectedRapprod) && strpos($selectedRapprod->Observation, 'Test (1)') !== false )checked @endif >
                            <label for="test_1">Test (1)</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td > <div class="form-check">
                            <input class="form-check-input" type="checkbox"  id="test_2" name="test_2" @if(isset($selectedRapprod)  && strpos($selectedRapprod->Observation, 'Test (2)') !== false )checked @endif >
                            <label for="test_2">Test (2)</label>

                        </div>
                    </td>
                    <td > <div class="form-check">
                        <input class="form-check-input" type="checkbox"  id="test_3" name="test_3" @if(isset($selectedRapprod) && strpos($selectedRapprod->Observation, 'Test (3)') !== false ) checked @endif >
                         <label for="test_3">Test (3)</label>

                        </div>
                    </td>
                </tr>

            </table>
        </div>
        </div>
        <hr>
        <div class="row">
            @if(isset($selectedRapprod))
                <div class="col-xl-2 col-sm-6 offset-xl-7  "> <a href="{{route('rapprod.show',['id'=>$rapport->Numero])}}" role="button" id="annuler" class="btn btn-secondary">Annuler</a></div>
                <div class="col-xl-3 col-sm-6  "> <button type="submit" class="btn btn-success">Modifier tube </button></div>
            @else
                <div class="col-xl-3 col-sm-6 offset-xl-9 "> <button type="submit" class="btn btn-success">Ajouter tube </button></div>
            @endif

        </div>




    </form>
        <br>

        <table  class="table table-striped table-hover table-bordered rapprods">
            <thead class="">
            <tr>
                <th>Coulee</th>
                <th>Bobine</th>
                <th>Tube</th>
                <th>Bis</th>
                <th>Longueur</th>
                <th>Macrd</th>
                <th>RB</th>
                <th>Observation</th>

            </tr>
            </thead>
            <tbody>
            @if(isset($rapprods))
                @foreach($rapprods as $rapprod)
                    <tr>
                        <td>{{$rapprod->Coulee}}</td>
                        <td>{{$rapprod->Bobine}}</td>
                        <td>{{$rapprod->Tube}}</td>
                        <td>@if($rapprod->Bis) <input type="checkbox" checked  onclick="return false;">
                            @elseif(!$rapprod->Bis)<input type="checkbox"  onclick="return false;"> @endif</td>
                        <td>{{$rapprod->Longueur}}</td>
                        <td>{{$rapprod->Macrd}}</td>
                        <td>@if($rapprod->RB) <input type="checkbox" checked  onclick="return false;">
                            @elseif(!$rapprod->R)<input type="checkbox"  onclick="return false;"> @endif</td>
                        <td>{{$rapprod->Observation}}</td>
                        <td>
                            <a class=" text-primary  my-2  my-sm-0 " href="{{route('rapprod.edit',['id'=>$rapprod->Numero])}}" style="display: inline-block"> <i class="fa fa-edit"></i></a>

                            <form style="display: inline-block" action="{{route('rapprod.destroy',[$rapprod->Numero])}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button  type="submit"  class=" text-danger" ><i class="fa fa-trash"></i></button>
                            </form></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </section>
    <section>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4"> <a href="{{route('arret_machine.show', ['id'=>$rapport->Numero])}}" role="button" > <button class="btn btn-danger">Arrêt machine</button> </a></div>
        <div class="col-xl-2 offset-xl-6 col-lg-3 offset-lg-3 col-md-4 col-sm-4"><button class="btn btn-warning">Quitter le rapport</button></div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4"><button class="btn btn-success">Clôturer Rapport</button></div>
    </div>
    </section>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout Bobine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('bobine')}}" >
                @csrf
                    <div class="form-group row">
                        <input type="hidden" id="RapportNum" name="RapportNum" value="{{$rapport->Numero}}">
                        <input type="hidden" id="Pid" name="Pid" value="{{$rapport->Pid}}">
                        <input type="hidden" id="Did" name="Did" value="{{$rapport->Did}}">
                        <label class="col-4" for="coulee" >Coulee</label>
                        <input class="col-6 form-control"  name="coulee" id="coulee" type="text"  required>
                    </div> <div class="form-group row">
                        <label class="col-4" for="bobine" >Bobine</label>
                        <input class="col-6 form-control"  name="bobine" id="bobine" type="text"  required >
                    </div> <div class="form-group row">
                        <label class="col-4" for="poids" >Poids</label>
                        <input class="col-6 form-control"  name="poids" id="poids" type="text" required  >
                    </div> <div class="form-group row">
                        <label class="col-4" for="fournisseur" >Fournisseur</label>
                        <select class="form-control col-6" id="fournisseur" name="fournisseur" required>
                            <option value="1">ARCELOR</option>
                            <option value="2">THYSSEN</option>
                            <option value="3">SEVERSTAL</option>
                        </select>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="Submit" id="Submit"  class="btn btn-primary">Ajouter</button>

            </div>
            </form>
            </div>
        </div>
    </div>
</div>

    @endsection
@section('script')

    <script>

        {{--jQuery(document).ready(function(){--}}
            {{--jQuery('#ajaxSubmit').click(function(e){--}}
                {{--e.preventDefault();--}}
                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--}--}}
                {{--});--}}
                {{--jQuery.ajax({--}}
                    {{--url: "{{ url('/bobine')}}",--}}
                    {{--method: 'post',--}}
                    {{--data: {--}}
                        {{--coulee: jQuery('#coulee').val(),--}}
                        {{--bobine: jQuery('#bobine').val(),--}}
                        {{--Pid: jQuery('#Pid').val(),--}}
                        {{--Did: jQuery('#Did').val(),--}}
                        {{--poids: jQuery('#poids').val(),--}}
                        {{--fournisseur: jQuery('#fournisseur').val()--}}
                    {{--},--}}
                    {{--success: function(result){--}}
                        {{--console.log(result);--}}
                    {{--}});--}}
            {{--});--}}
        {{--});--}}


    </script>
    @endsection
