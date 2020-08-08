<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{asset('img/Login.png')}}" />
  <title>Accès Non Autorisé</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('css/all.min.css')}}"  rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/bootstrap-select.css')}}" rel="stylesheet" type="text/css">
   <style>
       body{
       color:#000;
       }
       section{
         background-color: #fff;
         border-radius: 10px;
         padding: 20px;
         box-shadow: #ddd -2px -2px 2px;
         margin-top: 20px;
         border: 2px solid #ddd;
       }
     input[type=text]{
       padding: 0px 0px;
       text-align: center;
     }
   </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="container">

<div class="row">
  <div class=" col-12 text-center"  style="    top: 50%;
    position: absolute;
    left: 50%;
    transform: translate(-50%,-50%);">
    <h1 class="text-danger ">Accès Non Autorisé</h1>

  <a  href="{{route('home')}}" class=" col-12"><h2>Retour à la page d'accueil</h2></a>
  </div>
</div>

  </div>



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-select.min.js')}}"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{asset('js/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>


</body>

</html>
