@extends('layouts.app')

@section('style')
    <title>Rapports De Réparation Et De Chutage  </title>
    <style>

        @keyframes rotating {
            from {
                -ms-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform:  rotate(0deg);
                transform-origin:  center center;
            }
            to {
                -ms-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform:  rotate(360deg) ;
                transform-origin: center center;
            }
        }
        @keyframes switch {
            from {
                background-image: url("{{asset('img/img-hover2.png')}}");
            }
            to {
                background-image: url("{{asset('img/img-hover.png')}}");
            }
        }
        #settings{

            font-size: 14.9vw;
            padding:   50px 0;
            width:100%;
        }

         .rot{
              -webkit-animation: rotating 2s linear infinite;
              -moz-animation: rotating 2s linear infinite;
              -ms-animation: rotating 2s linear infinite;
              -o-animation: rotating 2s linear infinite;
              animation: rotating 2s linear infinite;
        }

        #img-div{
            background-image: url("{{asset('img/img-out2.png')}}");
            height: 100%;
            width: auto;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        .img-switch{
            -webkit-animation: switch 1s ease infinite;
            -moz-animation: switch 1s ease infinite;
            -ms-animation: switch 1s ease infinite;
            -o-animation: switch 1s ease infinite;
            animation: switch 1s ease infinite;
        }
        .pane{
            font-size: 3vw;
            height: 80%;
            cursor: pointer;
        }
        #settings-section{
            background-color: rgba(255,255,255,0.6);
            margin-right: 20px;
            padding: 0;
            color:orangered;
        }
        #settings-section:hover{
            color:#fff;
            background-color: orangered;
        }

        #M17-section{
            background-color: rgba(255,255,255,0.6);
            padding: 0;
            color:#00f;
        }
        #M17-section:hover{
            color:#fff;
            background-color: #00f;

        }
         body{
             background-image: url("{{asset('img/Rep_M17.jpg')}}");
             background-repeat: no-repeat;
             background-size: 100% 100%;
         }
        #footer{
            background-color: rgba(255,255,255,0.2);
            color:#fff;

        }
        section{
            border: 0;
            box-shadow: none;
            backdrop-filter: blur(5px);
        }
        #div-center{
            margin:100px 0;
        }
    </style>

    @endsection

@section('content')

<div class="container">
<div class="row text-center" id="div-center">

    <section class="col-4 offset-2" id="settings-section" onclick="window.location.href='{{route("rapports_Rep.index")}}';">

        <div class="  pane " >
            <i class="fa fa-cog " id="settings" ></i>
            <p class=" "><b>REPARATION</b></p>
        </div>
    </section>

<section class="col-4 " id="M17-section" onclick="window.location.href='{{route("rapports_M17.index")}}';">
        <div class="  pane"  id="M17" >
            <div id="img-div"></div>
             <p class=""><b>RAPPORT M17</b></p>
        </div>

</section>
</div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#img-out').show();
            $('#img-hover').hide();
       $('#settings-section').mouseover(function(){
           $('#settings').addClass('rot');
       });
            $('#settings-section').mouseout(function(){
             $('#settings').removeClass('rot');
            });


            $('#M17-section').mouseover(function(e) {
                $('#img-div').addClass('img-switch');
            });

            $('#M17-section').mouseout(function(){
                $('#img-div').removeClass('img-switch');
            });
        });
    </script>
    @endsection