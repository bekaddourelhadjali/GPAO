<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{asset('img/Login.png')}}" />
  <title>GPAO</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('css/all.min.css')}}"  rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/bootstrap-select.css')}}" rel="stylesheet" type="text/css">
   <style>
       body{
           color:#000;
           background-color: #e9ebee;
           font-family: Arial, Helvetica, sans-serif;
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
       input:invalid,select:invalid{
           border: 1px solid red;
       }
       legend{
           border-bottom:1px solid #ddd;
           width:80% !important;
       }
       footer.sticky-footer{
           padding-bottom: 0;
       }
   </style>
  @yield('style')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">


    @yield('content')


  </div>
  <!-- End of Page Wrapper -->

      <!-- Footer -->
      <div class="container-fluid">
      <footer class="sticky-footer  ">
          <div class="copyright  my-auto">
          <section id="footer">
            <div class="row ">
              <div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">
                <div class="row ">
                  <img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">
                  <div class="col-10">
                    <h2>Projet : <b>{{$projet->Nom}}</b></h2>
                    <h4 style="text-align: inherit; ">Client : <b>{{$projet->client->name}}</b></h4>
                    <b  >Copyright © GPAO {{date('Y')}}</b>
                  </div>
                </div>
                <br>

              </div>
            </div>
          </section>
          </div>
      </footer>
          <!-- End of Page Wrapper -->
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

 @yield('script')
 

</body>

</html>
